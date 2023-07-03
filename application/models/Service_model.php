<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model
{
    /**
     * Forum_model constructor.
    */
    public function __construct()
    {
        parent::__construct();

        $this->logsService = new LogsService();
        $this->modService = new ModService();
    }
}

class LogsService extends CI_Model
{
    /**
     * @param int $author
     * @param int $type
     * @param int $topicid
     * @param string $body
     * @param string $reply
     * @return mixed
     */
    public function send(int $author, int $type, int $topicid, string $body, string $reply)
    {
        $this->db->insert('mod_logs', [
            'userid'     => $author,
            'type'       => $type,
            'idtopic'    => $topicid,
            'function'   => $body,
            'annotation' => $reply,
            'datetime'   => $this->wowgeneral->getTimestamp()
        ]);
    }
}

class ModService extends CI_Model
{
    /**
     * @param mixed $userId
     * @return [type]
     */
    public function checkAccBan($userId)
    {

    }
}
