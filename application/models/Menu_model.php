<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends BS_Model
{
    protected $table = 'menus';

    /**
     * Default menus ids
     *
     * @var array
     */
    public const DEFAULT_MENUS  = [1, 2];

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
     * Display menu
     *
     * @param string $name
     * @return array
     */
    public function display($name = 'main')
    {
        if (! $this->db->table_exists($this->table)) {
            return [];
        }

        $userRole = is_logged_in() ? user('role') : '1';
        $cache    = $this->cache->get('menu_' . $name);

        if ($cache !== false) {
            if (array_key_exists($userRole, $cache)) {
                return $cache[$userRole];
            }

            return [];
        }

        $menu = $this->find(['name' => $name]);

        if (empty($menu)) {
            return [];
        }

        $items = [];
        $roles = $this->role_model->find_all();

        foreach ($roles as $role) {
            $items[$role->id] = $this->menu_item_model->process_items($menu->id, 0, $role->id);
        }

        $this->cache->save('menu_' . $name, $items, 604800);

        if (array_key_exists($userRole, $items)) {
            return $items[$userRole];
        }

        return [];
    }
}
