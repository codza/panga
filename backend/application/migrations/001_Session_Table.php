<?php

class Migration_Session_Table extends CI_Migration {
	public function up()
	{
    $fields = array(
      'id VARCHAR(40) DEFAULT \'0\' NOT NULL',
      'ip_address VARCHAR(45) DEFAULT \'0\' NOT NULL',
      'timestamp INT(10) unsigned DEFAULT 0 NOT NULL',
      'data blob NOT NULL',
      'KEY ci_sessions_timestamp (timestamp)'
    );
    $this->dbforge->add_field($fields);

    $this->dbforge->create_table('ci_sessions');
    $this->db->query("ALTER TABLE ci_sessions ADD PRIMARY KEY (id, ip_address)");
	}
  public function down()
  {
    $this->dbforge->drop_table('ci_sessions');
  }

}
