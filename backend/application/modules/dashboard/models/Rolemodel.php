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

	public function get_array_id_name(){
		// Fetch pages without parents
		$array =[];
		$roles_array = $this->db->order_by("created_date", "asc")->get($this->_table_name)->result_array();
		//	$categories = parent::get();
		$array = array(
			0 => ' -------- '
		);
		if (count($roles_array) > 0 ) {
			foreach ($roles_array as $role) {
				$array[$role['role_id']]= $role['role_name'];
			}
		}
		return $array;

	}


    public $rules = array(
        'RoleName' => array(
            'field' => 'rolename',
            'label' => 'Role Name',
            'rules' => 'trim|is_unique[tbl_role.role_name]'
        )
    );


}