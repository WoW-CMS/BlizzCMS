<?php

class Core {
    private
        $appPath,
        $dbFile,
        $reConfig,
        $reDatabase,
        $reBlizzcms,
        $db,
        $input,
        $error = [];

    public function init($config)
    {
        $this->appPath = $config['application'];
        $this->dbFile = $config['db_file'];
        $this->reConfig = [$config['base_url'], $config['language']];
        $this->reDatabase = [$config['hostname'], $config['username'], $config['password'], $config['database'], $config['hostname2'], $config['username2'], $config['password2'], $config['database2']];
        $this->reBlizzcms = [$config['ProjectName'], $config['discord_inv'], $config['realmlist'], $config['expansion_id']];

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
        $reWriteFile = ['config', 'database', 'blizzcms'];

        foreach ($reWriteFile as $fileName):
            $filePath = "$this->appPath/config/$fileName.php";

            if (is_writeable($filePath)):
                switch ($fileName):
                    case 'config':
                        $find = $this->reConfig;
                        $replace = [$this->input->base_url, $this->input->language];
                        break;
                    case 'database':
                        $find = $this->reDatabase;
                        $replace = [$this->input->hostname, $this->input->username, $this->input->password, $this->input->database, $this->input->hostname2, $this->input->username2, $this->input->password2, $this->input->database2];
                        break;
                    case 'blizzcms':
                        $find = $this->reBlizzcms;
                        $replace = [$this->input->ProjectName, $this->input->discord_inv, $this->input->realmlist, $this->input->expansion_id];
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
}
