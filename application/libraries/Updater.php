<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2022, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

use Desarrolla2\Cache\File;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use VisualAppeal\AutoUpdate;

class Updater
{
    /**
     * Reference to the CodeIgniter instance
     *
     * @var object
     */
    private $CI;

    /**
     * URL for check updates
     *
     * @var string
     */
    private $updateUrl = 'https://wow-cms.com/api/updates';

    /**
     * Filename for get versions from server
     *
     * @var string
     */
    private $updateFile = 'blizzcms.json';

    /**
     * Current version
     *
     * @var string
     */
    private $version;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->version = $this->CI->config->item('cms_version');

        log_message('info', 'Updater Class Initialized');
    }

    /**
     * Get the current version
     *
     * @return string
     */
    public function current_version()
    {
        return $this->version;
    }

    /**
     * Get the latest version
     *
     * @return string
     */
    public function latest_version()
    {
        $latest = $this->init_autoupdate()
            ->getLatestVersion();

        if (version_compare($latest, $this->version, '<=')) {
            return $this->version;
        }

        return $latest;
    }

    /**
     * Update to the latest version
     *
     * @return array
     */
    public function update()
    {
        $autoupdate = $this->init_autoupdate();

        if ($autoupdate->checkUpdate() === false) {
            return [
                'alert'   => 'warning',
                'message' => lang('cms_updater_not_connected')
            ];
        }

        if (! $autoupdate->newVersionAvailable()) {
            return [
                'alert'   => 'info',
                'message' => lang('cms_updater_version_not_found')
            ];
        }

        // Run update
        if ($autoupdate->update(false) === true) {
            $latest = $autoupdate->getLatestVersion();

            return [
                'alert'   => 'success',
                'message' => lang_vars('cms_updater_success', [$latest])
            ];
        }

        return [
            'alert'   => 'error',
            'message' => lang('cms_updater_failed')
        ];
    }

    /**
     * Init AutoUpdate
     *
     * @return object
     */
    private function init_autoupdate()
    {
        $update = new AutoUpdate(FCPATH . 'uploads/temp', FCPATH . '', 60);

        $update->setCurrentVersion($this->version);
        $update->setUpdateUrl($this->updateUrl);
        $update->setUpdateFile($this->updateFile);

        // Set logger
        $logger = new Logger('updater');

        $logger->pushHandler(new StreamHandler(APPPATH . 'logs/updater.log'));
        $update->setLogger($logger);

        // Set cache
        $cache = new File(APPPATH . 'cache');

        $update->setCache($cache, 3600);

        return $update;
    }
}
