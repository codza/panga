<?php 
class Migration_Role_Table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'role_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'created_date' => array(
                'type' => 'DATETIME'
            ),
            'updated_date' => array(
                'type' => 'TIMESTAMP'
            ),
        ));
        $this->dbforge->add_key('role_id', TRUE );
        $this->dbforge->create_table('tbl_role');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_role');
    }

}