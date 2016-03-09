<?php 
class Migration_Permission_Table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'perm_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'perm_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'perm_key' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'perm_desc' => array(
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
        $this->dbforge->add_key('perm_id', TRUE );
        $this->dbforge->create_table('tbl_permission');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_permission');
    }

}