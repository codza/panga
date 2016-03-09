<?php
class Permissionmodel extends MY_Model {
	
	protected $_table_name = 'tbl_permission';
	protected $_primary_key = 'perm_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'perm_id';

	protected $_timestamps = TRUE;
	
	function __construct() {
		parent::__construct();
	}


    public $rules = array(
        'PermissionName' => array(
            'field' => 'permissionname',
            'label' => 'Permession Name',
            'rules' => 'trim|is_unique[tbl_permission.perm_name]'
        ),
		'PermissionKey' => array(
			'field' => 'permissionkey',
			'label' => 'Permession Key',
			'rules' => 'trim|is_unique[tbl_permission.perm_key]'
		),
        'PermissionDescription' => array(
            'field' => 'permissiondescription',
            'label' => 'Permession Description',
            'rules' => 'trim'
        )
    );


}