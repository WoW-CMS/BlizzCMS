<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Install extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Installation active
     * --------------------------------------------------------------------------
     *
     * Config directly related to the status of the CMS installation.
     */
    public bool $active = true;
}
