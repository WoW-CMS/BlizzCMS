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
	* Current version
	*
	* @var string
	*/
	private $version = '1.1.0';

	/**
	* URL to check for updates
	*
	* @var string
	*/
	private $updateUrl = 'https://wow-cms.com';

	/**
	* Version filename on the server.
	*
	* @var string
	*/
	protected $updateFile = 'update.json';

	/**
	* AutoUpdate instance
	*
	* @var object
	*/
	private $autoUpdate;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->version = $this->CI->config->item('cms_version');

		$update = new AutoUpdate(FCPATH . 'temp', FCPATH . '', 60);

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

		$this->autoUpdate = $update;

		log_message('info', 'Updater Class Initialized');
	}

	/**
	* Get the latest version
	*
	* @return string
	*/
	public function latest_version()
	{
		$latest = $this->autoUpdate->getLatestVersion();

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
		if ($this->autoUpdate->checkUpdate() === false) {
			return [
				'alert'   => 'warning',
				'message' => lang('cms_updater_not_connected')
			];
		}


		// Run update
		if ($this->autoUpdate->update(false) === true) {
			$latest = $this->autoUpdate->getLatestVersion();

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
}