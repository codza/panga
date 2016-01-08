<?php
class Migration_Post_Table extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'post_id' => array(
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
            'parent_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => 0
            ),
            'post_slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'DEFAULT'=>''
            ),
            'post_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'post_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'post_content' => array(
                'type' => 'TEXT'

            ),
            'post_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '500'
            ),
            'post_keywords' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),
            'is_active' => array(
                'type' => 'INT',
                'constraint' => 1,
                'DEFAULT'=>1
            ),
            'post_order' => array(
                'type' => 'INT',
                'constraint' => 11,
                'DEFAULT'=>0
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'post_type' => array(
                'TYPE' => 'VARCHAR',
                'CONSTRAINT' => '15'

            ),
            'post_template' => array(
                'type' => 'VARCHAR',
                'constraint' => 25,
            ),
            'publication_date' => array(
                'TYPE' => 'DATE'
            ),
            'created_date' => array(
                'type' => 'DATETIME'
            ),
            'updated_date' => array(
                'type' => 'TIMESTAMP'
            ),
		));
		$this->dbforge->add_key('post_id', TRUE );
		$this->dbforge->create_table('tbl_post');
	}

	public function down()
	{
		$this->dbforge->drop_table('tbl_post');
	}
}