<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_ci_sessions extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '40',
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'ip_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '45'
                        ),
                        'timestamp' => array(
                                'type' => 'INT',
                                'constraint' => '10'
                        ),
                        'data' => array(
                                'type' => 'BLOB'
                        ),
                ));
                $this->dbforge->add_key('ci_sessions', TRUE);
                $this->dbforge->create_table('ci_sessions');
        }

        public function down()
        {
                $this->dbforge->drop_table('ci_sessions');
        }
}
