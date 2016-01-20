<?php 
class Migration_Loaded_Post_Table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'loaded_id' => array(
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
            'post_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'loaded_post_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'loaded_post_order' => array(
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => TRUE,
                'DEFAULT'=>1,
            ),
            'created_date' => array(
                'type' => 'DATETIME'
            ),
            'updated_date' => array(
                'type' => 'TIMESTAMP'
            ),
        ));
        $this->dbforge->add_key('loaded_id', TRUE );
        $this->dbforge->create_table('tbl_loaded_post');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_loaded_post');
    }

}