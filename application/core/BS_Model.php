<?php defined('BASEPATH') or exit('No direct script access allowed');

class BS_Model extends CI_Model
{
    /**
     * Table name used in the model
     *
     * @var string
     */
    protected $table = '';

    /**
     * Field name used for the created time column in the table
     *
     * @var string
     */
    protected $createdField = 'created_at';

    /**
     * Auto-fill with $createdField in insert methods
     *
     * @var bool
     */
    protected $setCreatedField = false;

    /**
     * Field name used for the updated time column in the table
     *
     * @var string
     */
    protected $updatedField = 'updated_at';

    /**
     * Auto-fill with $updatedField in update methods
     *
     * @var bool
     */
    protected $setUpdatedField = false;

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
     * Insert a new row
     *
     * @param array $set
     * @return bool
     */
    public function insert(array $set)
    {
        if ($this->setCreatedField) {
            $set[$this->createdField] = current_date();
        }

        return $this->db->insert($this->table, $set);
    }

    /**
     * Insert multiple new rows
     *
     * @param array $set
     * @return mixed
     */
    public function insert_batch(array $set)
    {
        if ($this->setCreatedField) {
            foreach ($set as $key => $arr) {
                $set[$key] = array_merge($set[$key], [$this->createdField => current_date()]);
            }
        }

        return $this->db->insert_batch($this->table, $set);
    }

    /**
     * Update key/value pairs in rows
     *
     * @param array $set
     * @param array $where
     * @return bool
     */
    public function update(array $set, array $where)
    {
        if ($this->setUpdatedField) {
            $set[$this->updatedField] = current_date();
        }

        return $this->db->update($this->table, $set, $where);
    }

    /**
     * Update key/value pairs in multiple rows
     *
     * @param array $set
     * @param string $index
     * @return mixed
     */
    public function update_batch(array $set, string $index)
    {
        if ($this->setUpdatedField) {
            foreach ($set as $key => $arr) {
                $set[$key] = array_merge($set[$key], [$this->updatedField => current_date()]);
            }
        }

        return $this->db->update_batch($this->table, $set, $index);
    }

    /**
     * Set key/value pairs in rows
     *
     * @param array $keys
     * @param array $where
     * @param bool|null $escape
     * @return bool
     */
    public function set(array $keys, array $where, $escape = null)
    {
        return $this->db->set($keys, '', $escape)
            ->where($where)
            ->update($this->table);
    }

    /**
     * Delete rows through key/value pairs
     *
     * @param array $where
     * @return mixed
     */
    public function delete(array $where)
    {
        return $this->db->delete($this->table, $where);
    }

    /**
     * Delete rows by searching for values in a field
     *
     * @param string $key
     * @param array $values
     * @return mixed
     */
    public function delete_in(string $key, array $values)
    {
        return $this->db->where_in($key, $values)
            ->delete($this->table);
    }

    /**
     * Find a row through key/value pairs
     *
     * @param array $where
     * @return mixed
     */
    public function find(array $where)
    {
        return $this->db->where($where)
            ->get($this->table)
            ->row();
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

        return $query->get()
            ->result($type);
    }

    /**
     * Find rows by searching for values in a field
     *
     * @param string $key
     * @param array $values
     * @param string $type The row type. Either 'array' or 'object'
     * @return array
     */
    public function find_in(string $key, array $values, $type = 'object')
    {
        return $this->db->where_in($key, $values)
            ->get($this->table)
            ->result($type);
    }

    /**
     * Count all rows through key/value pairs
     *
     * @param array $where
     * @return int
     */
    public function count_all(array $where = [])
    {
        if ($where === []) {
            return $this->db->count_all($this->table);
        }

        return $this->db->from($this->table)
            ->where($where)
            ->count_all_results();
    }
}
