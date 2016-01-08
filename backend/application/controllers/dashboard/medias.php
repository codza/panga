<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Medias extends Admin_Controller {

	public function __construct ()
	{
		parent::__construct();

     //   $this->load->model("postmodel");
        $this->load->model("mediamodel");
     //   $this->data["categories"] = $this->categorymodel->get_array_id_name();
       // $this->data["post_no_parents"]=$this->postmodel->get_no_parents();
	}

	public function index (){
        $this->data["images"] = $this->mediamodel->get();
        $this->data['subview']="dashboard/media/_media_list";
        $this->load->view("dashboard/_main_layout",$this->data);
	}

	public function create(){

        $posttitle = ""; $parentid = "";
        $categoryid = "";    $postcontent = "";
        $postname = ""; $posttype = "";
        $userid=""; $postslug="";
        $posttemplate=""; $publicationdate ="";


        if($_POST){
            $posttitle = $this->input->post('posttitle',true);
            $postslug = $this->input->post('postslug',true);
            $categoryid = $this->input->post('categoryid',true);
            $posttemplate = $this->input->post('posttemplate',true);

            $posttype = $this->input->post('posttype',true);

            $parentid = $this->input->post('parentid',true);
            $postcontent = $this->input->post('postcontent',true);
            $postname = $this->input->post('postname',true);

            $publicationdate = $this->input->post('publicationdate', true);

            $userid = $this->input->post('userid',true);

            $datatoinsert = array(
                "user_id"=>$userid,
                "category_id"=>$categoryid,
                "parent_id"=>$parentid,
                "post_type"=>$posttype,
                "post_template"=>$posttemplate,
                "post_slug"=>put_underscore($postslug),
                "post_title"=>$posttitle,
                "post_name"=>$postname,
                "publication_date"=> $publicationdate,
                "post_content"=>$postcontent
            );
            $this->data["datatoinsert"] = $datatoinsert;
            $this->load->library('form_validation');
            $validationrules = $this->postmodel->create_rules;

            $this->form_validation->set_rules($validationrules);

            if ($this->form_validation->run() == FALSE)
            {
              //  $this->load->view('myform');
            }
            else
            {

               $this->postmodel->save($datatoinsert);
               redirect('dashboard/posts','refresh');
            }

        }else{
            $datatoinsert = array(
                "user_id"=>$userid,
                "category_id"=>$categoryid,
                "parent_id"=>$parentid,
                "post_type"=>$posttype,
                "post_template"=>$posttemplate,
                "post_slug"=>put_underscore($postslug),
                "post_title"=>$posttitle,
                "post_name"=>$postname,
                "publication_date"=> $publicationdate,
                "post_content"=>$postcontent
            );
            $this->data["datatoinsert"] = $datatoinsert;

        }

        $this->data['subview']="dashboard/media/_new_post";
        $this->load->view("dashboard/_main_layout",$this->data);

	}

	public function edit($id = NULL){
        $datatoinsert =null;

        $posttitle = "";  $categoryid = ""; $postcontent = "";  $posttype = ""; $publictiondate ="";
        $postname ="";$userid=""; $postslug=""; $parentid = ""; $posttemplate = "";


       if($id != NULL){
            $this->data['post'] = $this->postmodel->get((int)$id);
        }

        if($_POST){
            $posttitle = $this->input->post('posttitle',true);
            $postslug = $this->input->post('postslug',true);
            $parentid = $this->input->post('parentid',true);
            $post_id = $this->input->post('postid',true);

            $posttemplate = $this->input->post('posttemplate',true);

            $publicationdate = $this->input->post('publicationdate', true);

            $posttype = $this->input->post('posttype',true);

            $categoryid = $this->input->post('categoryid',true);
            $postcontent = $this->input->post('postcontent',true);
            $postname = $this->input->post('postname',true);
            $userid = $this->input->post('userid',true);

            $datatoupdate = array(
                "user_id"=>$userid,
                "category_id"=>$categoryid,
                "parent_id"=>$parentid,
                "post_type"=>$posttype,
                "post_template"=>$posttemplate,
                "post_slug"=>put_underscore($postslug),
                "post_title"=>$posttitle,
                "post_name"=>$postname,
                "publication_date"=>$publicationdate,
                "post_content"=>$postcontent
            );
            $validationrules = $this->postmodel->create_rules;

            $this->form_validation->set_rules($validationrules);

            if ($this->form_validation->run() == FALSE)
            {
                $this->data['errors']='form validation error';
            }else{
                $datatoupdate = array(
                    "user_id"=>$userid,
                    "category_id"=>$categoryid,
                    "parent_id"=>$parentid,
                    "post_type"=>$posttype,
                    "post_template"=>$posttemplate,
                    "post_slug"=>put_underscore($postslug),
                    "post_title"=>$posttitle,
                    "post_name"=>$postname,
                    "publication_date"=>$publicationdate,
                    "post_content"=>$postcontent
                );
                $post_id = $this->postmodel->save($datatoupdate,$post_id);
                $this->data['post'] = $this->postmodel->get($post_id);
            }

        }
        $this->data['subview']="dashboard/media/_edit_media";
        $this->load->view("dashboard/_main_layout",$this->data);
	}

	public function delete ($id){
        $this->postmodel->delete($id);
        redirect('dashboard/medias','refresh');
	}




}