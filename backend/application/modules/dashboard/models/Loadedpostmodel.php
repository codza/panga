<?php

class Loadedpostmodel extends MY_Model {

    protected $_table_name = 'tbl_loaded_post';
    protected $_primary_key = 'loaded_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'loaded_id';
    protected $_timestamps = TRUE;

    function __construct() {
        parent::__construct();
    }

    public function get($id = NULL, $single = FALSE) {

           $this->db->select("$this->_table_name.* , mp.post_id  mp_post_id , mp.post_name  mp_post_name ,sp.post_id  sp_post_id , sp.post_name  sp_post_name ");
           $this->db->join('tbl_post mp', " $this->_table_name.post_id = mp.post_id", 'left');
           $this->db->join('tbl_post sp', " $this->_table_name.loaded_post_id = sp.post_id", 'left');
        return parent::get($id, $single);
    }

    public function is_post_loaded($postid, $loadedpostid) {
        $loadedpost = $this->get_by(
                array(
            "$this->_table_name.post_id" => $postid,
            "$this->_table_name.loaded_post_id" => $loadedpostid
                ), TRUE
        );
        return $loadedpost;
    }

    public function get_loaded_post_by_post_id($postid) {

        $loadedpost = $this->get_by(
                array(
            "$this->_table_name.post_id" => $postid,
         //   "$this->_table_name.liked_or_unliked" => $lorul
                ), FALSE
        );

        return $loadedpost;
    }

    public function save($data, $id = NULL) {
        if ($id !== NULL) {
            return parent::save($data, $id);
        } else {
            $postid = $data['post_id'];
            $loadedpostid = $data['loaded_post_id'];
            $loadedpost = $this->is_post_loaded($postid, $loadedpostid);
            if ($loadedpost) {
                return $loadedpost;
            } else {
                return parent::save($data);
            }
        }
    }

}
