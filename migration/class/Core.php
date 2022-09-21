<?php

class Core {

    private
        $appPath,
        $reConfig,
        $reDatabase,
        $input,
        $error = array();

    public function init($config)
    {
        $this->appPath = $config['application'];
        $this->reConfig = [$config['language']];
        $this->reDatabase = [$config['hostname'], $config['username'], $config['password'], $config['database'], $config['hostname2'], $config['username2'], $config['password2'], $config['database2']];

        if (!is_dir($this->appPath))
            $this->error[] = "Incorrect application folder";

        return $this->error;
    }

    public function setInput($input)
    {
        $this->input = (object)$input;
    }

    public function reWrite()
    {
        $reWriteFile = ['config', 'database'];

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

    public function getError()
    {
        return $this->error;
    }

    public function PHPVersion()
    {
        if ((version_compare(PHP_VERSION, '7.1') >= 0 ) && (version_compare(PHP_VERSION, '8.1.10') <= 0 ))
        {
            return true;
        }
    }

    public function checkExtension()
    {
        if (extension_loaded('curl') &&
            extension_loaded('gd') &&
            extension_loaded('mbstring') &&
            extension_loaded('mysqli') &&
            extension_loaded('openssl') &&
            extension_loaded('soap') &&
            extension_loaded('gmp'))
        {
            return true;
        }
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
