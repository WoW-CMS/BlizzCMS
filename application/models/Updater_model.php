<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Desarrolla2\Cache\Adapter\File;
use Monolog\Handler\StreamHandler;
use VisualAppeal\AutoUpdate;

class Updater_model extends CI_Model
{
    /**
     * Returns the current version of CMS
     *
     * @return string
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
        $update = new AutoUpdate(FCPATH . 'temp', FCPATH . '', 60);

        // Set current version of app
        $update->setCurrentVersion($this->current_version());

        // Set server update url
        $update->setUpdateUrl('https://wow-cms.com');

        $update->addLogHandler(new StreamHandler(APPPATH . 'logs/updater.log'));
        // $update->setCache(new File(APPPATH . 'cache'), 3600);

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
