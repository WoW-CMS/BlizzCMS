<?php

class Core {
    private
        $appPath,
        $dbFile,
        $reConfig,
        $reDatabase,
        $reBlizzCMS,
        $rePlus,
        $db,
        $input,
        $error = [];

    public function init($config)
    {
        $this->appPath = $config['application'];
        $this->dbFile = $config['db_file'];
        $this->reConfig = [$config['language']];
        $this->reDatabase = [$config['hostname'], $config['username'], $config['password'], $config['database'], $config['hostname2'], $config['username2'], $config['password2'], $config['database2']];
        $this->reBlizzCMS = [$config['website_name'], $config['discord_invitation'], $config['realmlist'], $config['expansion_id'], $config['social_facebook'], $config['social_twitter']];
        $this->rePlus = [$config['license_plus']];

        if (!is_dir($this->appPath))
            $this->error[] = "Incorrect application folder";
        if (!file_exists($this->dbFile))
            $this->error[] = "SQL file not found";

        return $this->error;
    }

    public function setInput($input)
    {
        $this->input = (object)$input;
    }

    public function reWrite()
    {
        $reWriteFile = ['config', 'database', 'blizzcms', 'plus'];

        foreach ($reWriteFile as $fileName):
            $filePath = "$this->appPath/config/$fileName.php";

            if (is_writeable($filePath)):
                switch ($fileName):
                    case 'config':
                        $find = $this->reConfig;
                        $replace = [$this->input->language];
                        break;
                    case 'database':
                        $find = $this->reDatabase;
                        $replace = [$this->input->hostname, $this->input->username, $this->input->password, $this->input->database, $this->input->hostname2, $this->input->username2, $this->input->password2, $this->input->database2];
                        break;
                    case 'blizzcms':
                        $find = $this->reBlizzCMS;
                        $replace = [$this->input->website_name, $this->input->discord_invitation, $this->input->realmlist, $this->input->expansion_id, $this->input->social_facebook, $this->input->social_twitter];
                        break;
                    case 'plus':
                        $find = $this->rePlus;
                        $replace = [$this->input->license_plus];
                        break;
                    default:
                        break;
                endswitch;
                $file = file_get_contents($filePath);
                $file = str_replace($find, $replace, $file);
                $reWrite = file_put_contents($filePath, $file);
            else:
                $this->error[] = "File $fileName.php can not be changed";
            endif;
        endforeach;

        return $this->error ? FALSE : TRUE;
    }

    public function checkDB()
    {
        $db = @new mysqli($this->input->hostname, $this->input->username, $this->input->password, $this->input->database);

        if ($db->connect_errno)
            $this->error[] = $db->connect_error;

        @$db->close();

        return $this->error ? FALSE : TRUE;
    }

    public function createTables()
    {
        $queries = file_get_contents($this->dbFile);
        $db = new mysqli($this->input->hostname, $this->input->username, $this->input->password, $this->input->database);
        $db->multi_query($queries);
        $db->close();
    }

    public function getError()
    {
        return $this->error;
    }

    public function removeFiles($target)
    {
        $host = $_SERVER['HTTP_HOST'];
        if(is_writeable($target)):
            if (is_dir($target)):
                $files = glob($target . '*', GLOB_MARK);

                foreach($files as $file):
                    $this->removeFiles($file);
                endforeach;
                rmdir($target);
            elseif (is_file($target)):
                unlink($target);
            endif;
            header('Location: http://'.$host);
        else:
            $this->error[] = "Folder is not writable, please enable mod_rewrite and set permissions";
        endif;
    }
}
