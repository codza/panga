<?php

class Rolepermmodel extends MY_Model {

    protected $_table_name = 'tbl_role_perm';
    protected $_primary_key = 'role_perm_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'role_perm_id';
    protected $_timestamps = TRUE;

    function __construct() {
        parent::__construct();
    }

    public function get($id = NULL, $single = FALSE) {

           $this->db->select("$this->_table_name.* , perm.perm_name , role.role_name  ");
           $this->db->join('tbl_permission perm', " $this->_table_name.perm_id = perm.perm_id", 'left');
           $this->db->join('tbl_role role', " $this->_table_name.role_id = role.role_id", 'left');
        return parent::get($id, $single);
    }

    public function is_role_permitted($perm_id, $role_id) {
        $roleperm = $this->get_by(
                array(
            "$this->_table_name.perm_id" => $perm_id,
            "$this->_table_name.role_id" => $role_id
                ), TRUE
        );
        return $roleperm;
    }

    public function get_perms_by_role_id($role_id) {

        $roleperms = $this->get_by(
                array(
            "$this->_table_name.role_id" => $role_id
                ), FALSE
        );
        return $roleperms;
    }
    public function get_array_perms_by_role_id($role_id='1'){
     //   $perms_array = [];
        $this->db->select(" perm.perm_name ,perm.perm_key");
        $this->db->join('tbl_permission perm', " $this->_table_name.perm_id = perm.perm_id", 'left');
        $this->db->join('tbl_role role', " $this->_table_name.role_id = role.role_id", 'left');
        $this->db->where(array($this->_table_name.".role_id "=> $role_id));

        return $this->db->get($this->_table_name)->result_array();
    }

    public function get_roles_by_perm_id($perm_id) {

        $roleperms = $this->get_by(
            array(
                "$this->_table_name.perm_id" => $perm_id,
                //   "$this->_table_name.liked_or_unliked" => $lorul
            ), FALSE
        );

        return $roleperms;
    }

    public function save($data, $id = NULL) {
        if ($id !== NULL) {
            return parent::save($data, $id);
        } else {
            $perm_id = $data['perm_id'];
            $role_id = $data['role_id'];
            $roleperm = $this->is_role_permitted($perm_id, $role_id);
            if ($roleperm) {
                return $roleperm;
            } else {
                return parent::save($data);
            }
        }
    }

}
