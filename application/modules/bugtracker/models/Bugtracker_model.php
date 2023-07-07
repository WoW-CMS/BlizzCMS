<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bugtracker_model extends CI_Model
{
    private $_limit,
            $_pageNumber,
            $_offset;
    /**
     * Bugtracker_model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getBugtracker()
    {
        return $this->db->where('close', 0)
            ->get('bugtracker');
    }

    /**
     * @param int $id
     * @param int $priority
     * @return mixed
     */
    public function changePriority($id, $priority)
    {
        return $this->db->set('priority', $priority)
            ->where('id', $id)
            ->update('bugtracker');

        redirect(site_url('bugtracker/report/' . $id));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function closeIssue($id)
    {
        return $this->db->set('close', 1)
            ->where('id', $id)
            ->update('bugtracker');

        redirect(site_url('bugtracker/report/' . $id));
    }

    /**
     * @param int $id
     * @param int $type
     * @return mixed
     */
    public function changeType($id, $type)
    {
        return $this->db->set('type', $type)
            ->where('id', $id)
            ->update('bugtracker');

        redirect(site_url('bugtracker/report/' . $id));
    }

    /**
     * @param int $id
     * @param int $status
     * @return mixed
     */
    public function changeStatus($id, $status)
    {
        return $this->db->set('status', $status)
            ->where('id', $id)
            ->update('bugtracker');

        redirect(site_url('bugtracker/report/' . $id));
    }

    public function setLimit($limit)
    {
        $this->_limit = $limit;
    }

    public function setPageNumber($pageNumber)
    {
        $this->_pageNumber = $pageNumber;
    }

    public function setOffset($offset)
    {
        $this->_offset = $offset;
    }

    /**
     * @return int
     */
    public function getAllBugs()
    {
        return $this->db->where('close', 0)
            ->get('bugtracker')
            ->num_rows();
    }

    /**
     * @return object
     */
    public function bugtrackerList()
    {
        return $this->db->where('close', 0)
            ->order_by('id', 'DESC')
            ->limit($this->_pageNumber, $this->_offset)
            ->get('bugtracker')
            ->result();
    }

    /**
     * @param string $title
     * @param string $description
     * @param int $type
     * @param int $priority
     * @return bool
     */
    public function insertIssue($title, $description, $type, $priority)
    {
        $this->db->insert('bugtracker', [
            'title'       => $title,
            'description' => $description,
            'status'      => 1,
            'type'        => $type,
            'priority'    => $priority,
            'date'        => $this->wowgeneral->getTimestamp(),
            'author'      => $this->session->userdata('wow_sess_id'),
            'close'       => 0
        ]);

        return true;
    }

    /**
     * @param int $date
     * @return mixed
     */
    public function getIDPostPerDate($date)
    {
        return $this->db->where('date', $date)
            ->get('bugtracker')
            ->row('id');
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->db->get('bugtracker_type');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getType($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker_type')
            ->row('title');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTitleIssue($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->row('title');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDescIssue($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->row('description');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getStatus($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker_status')
            ->row('title');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getStatusID($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->row('status');
    }

    /**
     * @return mixed
     */
    public function getPriorities()
    {
        return $this->db->get('bugtracker_priority');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPriority($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker_priority')
            ->row('title');
    }

    /**
     * @return mixed
     */
    public function getPriorityGeneral()
    {
        return $this->db->get('bugtracker_priority');
    }

    /**
     * @return mixed
     */
    public function getStatusGeneral()
    {
        return $this->db->get('bugtracker_status');
    }

    /**
     * @return mixed
     */
    public function getTypesGeneral()
    {
        return $this->db->get('bugtracker_type');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getPriorityID($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->row('priority');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTypeID($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->row('type');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getDate($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->row('date');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function closeStatus($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->row('close');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getAuthor($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->row('author');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function ReportExist($id)
    {
        return $this->db->where('id', $id)
            ->get('bugtracker')
            ->num_rows();
    }

    /**
     * @param int $idlink
     * @param string $description
     * @return bool
     */
    public function sendReplied($idlink, $description)
    {
        $this->db->insert('bugtracker_replied', [
            'idlink'      => $idlink,
            'description' => $description,
            'author'      => $this->session->userdata('wow_sess_id')
        ]);

        return true;
    }

    /**
     * @param int $id
     * @param string $row
     * @return mixed
     */
    public function getBugtrackerReplied($id, $row)
    {
        return $this->db->where('idlink', $id)
            ->get('bugtracker_replied')
            ->row($row);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function getBugtrackerRows($id)
    {
        $query = $this->db->where('idlink', $id)
            ->get('bugtracker_replied')
            ->num_rows();

        if ($query >= 1) {
            return true;
        }

        return false;
    }
}
