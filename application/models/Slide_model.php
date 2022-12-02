<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slide_model extends BS_Model
{
    protected $table = 'slides';

    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Find all rows through key/value pairs
     *
     * @param array $where
     * @param string $type The row type. Either 'array' or 'object'
     * @return array
     */
    public function find_all(array $where = [], $type = 'object')
    {
        $query = $this->db->from($this->table);

        if ($where !== []) {
            $query->where($where);
        }

        return $query->order_by('sort', 'ASC')
            ->get()
            ->result($type);
    }

    /**
     * Get sort column of the last item
     *
     * @return int
     */
    public function last_item_sort()
    {
        $result = $this->db->order_by('sort', 'ASC')
            ->get($this->table)
            ->last_row();

        if (empty($result)) {
            return 0;
        }

        return (int) $result->sort;
    }
}
