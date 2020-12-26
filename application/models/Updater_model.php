<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// API Container
use VisualAppeal\AutoUpdate;
use Monolog\Handler\StreamHandler;

class Updater_model extends CI_Model
{
	/**
	 * Returns the current version of CMS
	 *
	 * @return mixed
	 */
	public function current_version()
	{
		return config_item('app_version');
	}

	/**
	 * Find new updates
	 *
	 * @return mixed
	 */
	public function find_updates()
	{
		$update = new AutoUpdate(FCPATH.'temp', FCPATH.'', 60);
		$update->setCurrentVersion($this->current_version()); // Current version of your application. This value should be from a database or another file which will be updated with the installation of a new version
		$update->setUpdateUrl('https://wow-cms.com'); //Replace the url with your server update url

		// The following two lines are optional
		$update->addLogHandler(new StreamHandler(APPPATH . 'logs/updater.log'));
		// $update->setCache(new Desarrolla2\Cache\Adapter\File(APPPATH.'/cache'), 3600);

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
				$this->db->set('value', end($update->getVersionsToUpdate()))->where('key', 'app_version')->update('settings');

				return true;
			}

			show_error('UpdErr');
		}

		return false;
	}
}
