<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_item_model extends BS_Model
{
    protected $table = 'menus_items';

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
     * Get a list of item ids related to a menu
     *
     * @param int $menuId
     * @return array
     */
    public function items_ids($menuId)
    {
        $query = $this->find_all(['menu_id' => $menuId], 'array');

        if (empty($query)) {
            return [];
        }

        return array_column($query, 'id');
    }

    /**
     * Get sort column of the last item
     *
     * @param int $menuId
     * @param int $parent
     * @return int
     */
    public function last_item_sort($menuId, $parent)
    {
        $result = $this->db->where(['menu_id' => $menuId, 'parent' => $parent])
            ->order_by('sort', 'ASC')
            ->get($this->table)
            ->last_row();

        if (empty($result)) {
            return 0;
        }

        return (int) $result->sort;
    }

    /**
     * Process menu items
     *
     * @param int $menuId
     * @param int $parent
     * @param int $role
     * @return array
     */
    public function process_items($menuId, $parent, $role)
    {
        $items = $this->find_all(['menu_id' => $menuId, 'parent' => $parent]);
        $keys  = $this->permission_model->permissions_keys($role, ':menu-item:');

        if (empty($items)) {
            return [];
        }

        $list = [];

        foreach ($items as $item) {
            if (! in_array($item->id, $keys, true)) {
                continue;
            }

            $list[] = (object) [
                'name'    => $item->name,
                'url'     => filter_var($item->url, FILTER_VALIDATE_URL) ? $item->url : site_url($item->url),
                'icon'    => $item->icon,
                'target'  => $item->target,
                'type'    => $item->type,
                'childs'  => $item->type === ITEM_DROPDOWN ? $this->process_items($menuId, $item->id, $role) : []
            ];
        }

        return $list;
    }
}
