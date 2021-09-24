<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Desarrolla2\Cache\File;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use VisualAppeal\AutoUpdate;

class Updater_model extends CI_Model
{
    /**
     * Returns the current version of CMS
     *
     * @return mixed
     */
    public function current_version()
    {
        return $this->settings->saved_value('app_version');
    }

    /**
     * Find new updates
     *
     * @return mixed
     */
    public function find_updates()
    {
        $update = new AutoUpdate(FCPATH . 'temp', FCPATH . '', 60);

        // Set current version of app
        $update->setCurrentVersion($this->current_version());

        // Set server update url
        $update->setUpdateUrl('https://wow-cms.com');

        // Set logger (optional)
        $logger = new Logger('default');
        $logger->pushHandler(new StreamHandler(APPPATH . 'logs/update.log'));
        $update->setLogger($logger);

        // Set cache (optional)
        // $cache = new File(APPPATH . 'cache');
        // $update->setCache($cache, 3600);

        // Check for a new update
        if ($update->checkUpdate() === false)
        {
            show_error('Could not check for updates! See log file for details.');
        }

        // Check if new update is available
        if ($update->newVersionAvailable())
        {
            if ($update->update(false) === true)
            {
                $this->settings->update([
                    'value' => end($update->getVersionsToUpdate())
                ], ['key' => 'app_version']);

                return true;
            }

            show_error('UpdErr');
        }

        return false;
    }
}
