<?php
class MediaModel extends MY_Model {
	
	protected $_table_name = 'tbl_media';
	protected $_primary_key = 'media_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created_date';
	protected $_rules = array();
	protected $_timestamps = TRUE;

    function __construct() {
        parent::__construct();
    }

	public function get($id = null , $single = FAlSE){

		$this->db->select("$this->_table_name.* , post.post_title , post.post_name ");
	//	$this->db->join('tbl_category cat'," $this->_table_name.category_id = cat.category_id");
		$this->db->join('tbl_post post'," $this->_table_name.post_id = post.post_id");
		/* $this->db->join('tbl_media media'," $this->_table_name.post_id = media.post_id", "left");*/
		//$this->db->group_by("$this->_table_name.post_id");
		return parent::get($id, $single);



	}



}