<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model {

    /**
     * Forum_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __setLogs($userid, $type, $idtopic, $function, $annotation)
    {
      $data = array(
        'userid' => $userid,
        'type' => $type,
        'idtopic' => $idtopic,
        'function' => $function,
        'annotation' => $annotation,
        'datetime' => $this->wowgeneral->getTimestamp(),
      );
      $this->db->insert('mod_logs', $data);
    }


    public function __setActions()
    {

    }

    public function __setBans()
    {

    }
}
