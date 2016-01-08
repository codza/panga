<?php 
class Migration_Media_Table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'media_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'media_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '25',
            ),
            'post_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'media_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'media_size' => array(
                'type' => 'INT',
                'constraint' => 6,
            ),
            'media_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '25',
            ),
            'media_ext' => array(
                'type' => 'VARCHAR',
                'constraint' => '25',
            ),
            'created_date' => array(
                'type' => 'DATETIME'
            ),
            'updated_date' => array(
                'type' => 'TIMESTAMP'
            ),
        ));
        $this->dbforge->add_key('media_id', TRUE );
        $this->dbforge->create_table('tbl_media');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_media');
    }

}