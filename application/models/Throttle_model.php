<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Throttle_model extends BS_Model
{
    protected $table = 'throttle';

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
