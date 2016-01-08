<?php
class Migration_Category_Table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT' => 0,
                'unsigned' => TRUE,
            ),
            'category_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'category_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'created_date' => array(
                'type' => 'DATETIME'
            ),
            'updated_date' => array(
                'type' => 'TIMESTAMP'
            ),
        ));
        $this->dbforge->add_key('category_id', TRUE );
        $this->dbforge->create_table('tbl_category');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_category');
    }
}