<?php

class Categorymodel extends MY_Model {

    protected $_table_name = 'tbl_category';
    protected $_primary_key = 'category_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'category_id';
    protected $_timestamps = FALSE;

    function __construct() {
        parent::__construct();
    }

    public function get_category_by_name($categoriename) {
        $tag = $this->get_by(array("category_name" => $categoriename), TRUE);
        return $tag;
    }

    public function save($data, $id = NULL) {
        if ($id !== NULL) {
            return parent::save($data, $id);
        } else {
            $tagename = $data['category_name'];
            $tag = $this->get_category_by_name($tagename);
            if ($tag) {
                return $tag->category_id;
            } else {
                return parent::save($data);
            }
        }
    }
    public $rules = array(
        'CategoryName' => array(
            'field' => 'categoryname',
            'label' => 'Category Name',
            'rules' => 'required|trim|is_unique[tbl_category.category_name]'
        )
    );

}
