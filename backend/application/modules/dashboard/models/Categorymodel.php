<?php
class Categorymodel extends MY_Model {

    protected $_table_name = 'tbl_category';
    protected $_primary_key = 'category_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'category_id';
    public $rules = array(
        'CategoryName' => array(
            'field' => 'categoryname',
            'label' => 'Category Name',
            'rules' => 'trim|required|is_unique[tbl_category.category_name]'
        ),
        'CategoryDescription' => array(
            'field' => 'categorydescription',
            'label' => 'Category Description',
            'rules' => 'trim'
        )
    );
    protected $_timestamps = TRUE;
    function __construct() {
        parent::__construct();
    }

    public function get_category_by_name($categoriename) {
        $tag = $this->get_by(array("category_name" => $categoriename), TRUE);
        return $tag;
    }

    public function get_array_id_name(){
        // Fetch pages without parents
        $this->db->select('category_id, category_name');
        $categories = parent::get();

        // Return key => value pair array
        $array = array(
            0 => ' -------- '
        );
        if (count($categories)) {
            foreach ($categories as $category) {
                $array[$category->category_id] = $category->category_name;
            }
        }
        return $array;
    }



}