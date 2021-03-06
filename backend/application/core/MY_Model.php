<?php
class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	protected $_asc_or_desc ="ASC";
	public $rules = array();
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
		//$this;
	}
	
	public function get($id = NULL, $single = FALSE){
		
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_table_name.".".$this->_primary_key, $id);
			$method = 'row';
		}elseif($single == TRUE) {
			$method = 'row';
		}else {
			$method = 'result';
		}
		if ( strlen($this->_order_by) > 1 ) {
			$this->db->order_by($this->_table_name.".".$this->_order_by,$this->_asc_or_desc);
		}
		return $this->db->get($this->_table_name)->$method();
	}
	
	public function get_by($where, $single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $single);
	}

	public function get_where_like($column , $match, $single = FALSE) {
		$this->db->like($this->_table_name.".".$column, $match);
		return $this->get(NULL, $single);
	}
	
	public function save($data, $id = NULL){
		
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = date('Y-m-d H:i:s');
			$id || $data['created_date'] = $now;
			$data['updated_date'] = $now;
		}
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}else{
		// Update
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_table_name.".".$this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		return $id;
	}

	// delete record
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		if (!$id) {
			return FALSE;
		}
		$this->db->where($this->_table_name.".".$this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
                return TRUE;
                ///$this->db->affected_rows();
               /* if( $this->db->affected_rows() >0){
                    return TRUE;
                }else{
                    return FAlSE;
                }*/

	}









}