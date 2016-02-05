<?php
class Rolemodel extends MY_Model {
	
	protected $_table_name = 'tbl_role';
	protected $_primary_key = 'role_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'role_id';

	protected $_timestamps = TRUE;
	
	function __construct() {
		parent::__construct();
	}


    public $rules = array(
        'RoleName' => array(
            'field' => 'rolename',
            'label' => 'Role Name',
            'rules' => 'trim|is_unique[tbl_role.role_name]'
        )
    );


}