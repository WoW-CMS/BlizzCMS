<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_permissions extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'auto_increment' => TRUE
            ],
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'module' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'TEXT'
            ]
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('permissions', false, ['ENGINE' => 'InnoDB']);

        $this->permission_model->insert_batch([
            ['id' => '-1', 'key' => 'add.newscomments', 'module' => ':base:', 'description' => 'Can add comments in the news'],
            ['id' => '-2', 'key' => 'edit.newscomments', 'module' => ':base:', 'description' => 'Can edit comments in the news'],
            ['id' => '-3', 'key' => 'editown.newscomments', 'module' => ':base:', 'description' => 'Can edit own comments in the news'],
            ['id' => '-4', 'key' => 'delete.newscomments', 'module' => ':base:', 'description' => 'Can delete comments in the news'],
            ['id' => '-5', 'key' => 'deleteown.newscomments', 'module' => ':base:', 'description' => 'Can delete own comments in the news'],

            ['id' => '-100', 'key' => 'editown.profile', 'module' => 'user', 'description' => 'Can edit own profile'],
            ['id' => '-101', 'key' => 'editown.email', 'module' => 'user', 'description' => 'Can edit own email'],
            ['id' => '-102', 'key' => 'editown.password', 'module' => 'user', 'description' => 'Can edit own password'],

            ['id' => '-200', 'key' => 'view.admin', 'module' => 'admin', 'description' => 'Can view admin dashboard'],
            ['id' => '-201', 'key' => 'update.cms', 'module' => 'admin', 'description' => 'Can update the CMS'],
            ['id' => '-202', 'key' => 'run.tools', 'module' => 'admin', 'description' => 'Can run CMS tools'],
            ['id' => '-203', 'key' => 'view.settings', 'module' => 'admin', 'description' => 'Can view settings'],
            ['id' => '-204', 'key' => 'edit.settings', 'module' => 'admin', 'description' => 'Can edit settings'],
            ['id' => '-205', 'key' => 'view.appearance', 'module' => 'admin', 'description' => 'Can view appearance'],
            ['id' => '-206', 'key' => 'activate.themes', 'module' => 'admin', 'description' => 'Can activate a theme'],
            ['id' => '-207', 'key' => 'deactivate.themes', 'module' => 'admin', 'description' => 'Can deactivate the currently active theme'],
            ['id' => '-208', 'key' => 'delete.themes', 'module' => 'admin', 'description' => 'Can delete themes'],
            ['id' => '-209', 'key' => 'add.menus', 'module' => 'admin', 'description' => 'Can add new menus'],
            ['id' => '-210', 'key' => 'edit.menus', 'module' => 'admin', 'description' => 'Can edit menus'],
            ['id' => '-211', 'key' => 'delete.menus', 'module' => 'admin', 'description' => 'Can delete menus'],
            ['id' => '-212', 'key' => 'add.slides', 'module' => 'admin', 'description' => 'Can add new slides'],
            ['id' => '-213', 'key' => 'edit.slides', 'module' => 'admin', 'description' => 'Can edit slides'],
            ['id' => '-214', 'key' => 'delete.slides', 'module' => 'admin', 'description' => 'Can delete slides'],
            ['id' => '-215', 'key' => 'view.modules', 'module' => 'admin', 'description' => 'Can view modules'],
            ['id' => '-216', 'key' => 'install.modules', 'module' => 'admin', 'description' => 'Can install modules'],
            ['id' => '-217', 'key' => 'uninstall.modules', 'module' => 'admin', 'description' => 'Can uninstall modules'],
            ['id' => '-218', 'key' => 'delete.modules', 'module' => 'admin', 'description' => 'Can delete modules'],
            ['id' => '-219', 'key' => 'migrations.modules', 'module' => 'admin', 'description' => 'Can run migrations on modules'],
            ['id' => '-220', 'key' => 'view.realms', 'module' => 'admin', 'description' => 'Can view realms'],
            ['id' => '-221', 'key' => 'add.realms', 'module' => 'admin', 'description' => 'Can add new realms'],
            ['id' => '-222', 'key' => 'edit.realms', 'module' => 'admin', 'description' => 'Can edit realms'],
            ['id' => '-223', 'key' => 'delete.realms', 'module' => 'admin', 'description' => 'Can delete realms'],
            ['id' => '-224', 'key' => 'view.logs', 'module' => 'admin', 'description' => 'Can view logs'],
            ['id' => '-225', 'key' => 'view.users', 'module' => 'admin', 'description' => 'Can view users'],
            ['id' => '-226', 'key' => 'edit.users', 'module' => 'admin', 'description' => 'Can edit users'],
            ['id' => '-227', 'key' => 'view.bans', 'module' => 'admin', 'description' => 'Can view bans'],
            ['id' => '-228', 'key' => 'add.bans', 'module' => 'admin', 'description' => 'Can add new bans'],
            ['id' => '-229', 'key' => 'delete.bans', 'module' => 'admin', 'description' => 'Can delete bans'],
            ['id' => '-230', 'key' => 'view.roles', 'module' => 'admin', 'description' => 'Can view roles'],
            ['id' => '-231', 'key' => 'add.roles', 'module' => 'admin', 'description' => 'Can add new roles'],
            ['id' => '-232', 'key' => 'edit.roles', 'module' => 'admin', 'description' => 'Can edit roles'],
            ['id' => '-233', 'key' => 'delete.roles', 'module' => 'admin', 'description' => 'Can delete roles'],
            ['id' => '-234', 'key' => 'view.news', 'module' => 'admin', 'description' => 'Can view news'],
            ['id' => '-235', 'key' => 'add.news', 'module' => 'admin', 'description' => 'Can add new news'],
            ['id' => '-236', 'key' => 'edit.news', 'module' => 'admin', 'description' => 'Can edit news'],
            ['id' => '-237', 'key' => 'delete.news', 'module' => 'admin', 'description' => 'Can delete news'],
            ['id' => '-238', 'key' => 'view.pages', 'module' => 'admin', 'description' => 'Can view pages'],
            ['id' => '-239', 'key' => 'add.pages', 'module' => 'admin', 'description' => 'Can add new pages'],
            ['id' => '-240', 'key' => 'edit.pages', 'module' => 'admin', 'description' => 'Can edit pages'],
            ['id' => '-241', 'key' => 'delete.pages', 'module' => 'admin', 'description' => 'Can delete pages']
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('permissions');
    }
}
