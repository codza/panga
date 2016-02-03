<?php 
class Migration_role_perm_Table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'role_perm_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE

            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,

            ),
            'perm_id' => array(
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
        $this->dbforge->add_key('role_perm_id', TRUE );
        $this->dbforge->create_table('tbl_role_perm');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_role_perm');
    }

}