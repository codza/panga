<?php 
class Migration_User_Role_Table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'user_role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE

            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,

            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,

            ),
            'created_date' => array(
                'type' => 'DATETIME'
            ),
            'updated_date' => array(
                'type' => 'TIMESTAMP'
            ),
        ));
        $this->dbforge->add_key('user_role_id', TRUE );
        $this->dbforge->create_table('tbl_user_role');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_user_role');
    }

}