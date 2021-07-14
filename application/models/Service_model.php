<?php 


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

/**
 * [Description LogsService]
 */
class LogsService extends CI_Model
{
    /**
     * @param int $author
     * @param int $type
     * @param int $topicid
     * @param string $body
     * @param string $reply
     * 
     * @return [type]
     */
    public function send(int $author, int $type, int $topicid, string $body, string $reply)
    {
        $data = [
            'userid' => $author,
            'type' => $type,
            'idtopic' => $topicid,
            'function' => $body,
            'annotation' => $reply,
            'datetime' => $this->wowgeneral->getTimestamp()
        ];
        
		$this->db->insert('mod_logs', $data);
    }
}

/**
 * [Description ModService]
 */
class ModService extends CI_Model
{
    /**
     * @param mixed $userId
     * 
     * @return [type]
     */
    public function checkAccBan($userId)
    {
        
    }    
}