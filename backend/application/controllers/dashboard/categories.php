<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model("categorymodel");
    }

    public function index() {
        $this->data["categories"] = $this->categorymodel->get();
        $this->data['subview'] = "dashboard/category/_category_list";
        $this->load->view("dashboard/_main_layout", $this->data);
    }

    public function create() {
        $categoryname = "";
        $categorydescription ="";
        $datatoinsert = array(
            "category_name"=>$categoryname,
            "category_description"=>$categorydescription
        );
        $this->data["datatoinsert"] = $datatoinsert;

        if($_POST){
            $user_id = 1;
            $categoryname = $this->input->post('categoryname',true);
            $categorydescription = $this->input->post('categorydescription',true);
            $datatoinsert = array(
                "user_id"             => $user_id,
                "category_name"       => $categoryname,
                "category_description"=>$categorydescription
            );
            $this->data["datatoinsert"] = $datatoinsert;
            $this->load->library('form_validation');
            $validationrules = $this->categorymodel->rules;

            $this->form_validation->set_rules($validationrules);

            if ($this->form_validation->run() == FALSE){
                //  $this->load->view('myform');
            }else{

                $this->categorymodel->save($datatoinsert);
                redirect('dashboard/categories/','refresh');
            }
        }

        $this->data['subview']="dashboard/category/_new_category";
        $this->load->view("dashboard/_main_layout",$this->data);
    }

    public function edit($id = NULL) {
        if ($id != NULL) {
            $this->data['category'] = $this->categorymodel->get($id);
        }
        if ($_POST) {
            $catid = $this->input->post('categoryid', true);
            $categoryname = $this->input->post('categoryname', true);
            $categorydescription = $this->input->post('categorydescription', true);
            $this->load->library('form_validation');
            $validationrules = $this->categorymodel->rules;

            $category = $this->categorymodel->get($catid);

            $old_value=trim($category->category_name);
            if( $categoryname!=$old_value) {
                $validationrules['CategoryName']['rules'] = 'trim|required|is_unique[tbl_category.category_name]';
            } else {
                $validationrules['CategoryName']['rules'] = 'trim|required';;
            }


        //    $validationrules['CategoryName']['rules'] = 'trim|required|edit_unique[tbl_category.category_name.' . $categoryname . ']';

            $this->form_validation->set_rules($validationrules);

            if ($this->form_validation->run() == FALSE) {
                //  $this->load->view('myform');
            } else {
                $datatoupdate = array(
                    "category_name" => $categoryname,
                    "category_description" => $categorydescription
                );
                $this->categorymodel->save($datatoupdate, $catid);
                // $this->data['category'] = $this->categorymodel->get($id);
                redirect('dashboard/categories/', 'refresh');
            }
        }

        // $this->load->view("_layout_main",$this->data);

        $this->data['subview'] = "dashboard/category/_edit_category";
        $this->load->view("dashboard/_main_layout", $this->data);
    }

    public function delete($id) {
        $this->categorymodel->delete($id);
        redirect('dashboard/categories', 'refresh');
    }

}
