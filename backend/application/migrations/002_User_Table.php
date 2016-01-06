<?php

class Migration_User_Table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_token' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'Default'=>NULL
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '150'
            ),
            'avatar_icon' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'Default'=>"icon_no_avatar.png"
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
            ),
            'user_role' => array(
                'type' => 'int',
                'constraint' => '2',
            ),
            'created_date' => array(
                'type' => 'DATETIME'
            ),
            'updated_date' => array(
                'type' => 'TIMESTAMP'
            ),
        ));
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('tbl_user');
    }

    public function down() {
        $this->dbforge->drop_table('tbl_user');
    }

}
