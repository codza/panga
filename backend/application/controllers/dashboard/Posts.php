<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posts extends Admin_Controller {

	public function __construct ()
	{
		parent::__construct();

        $this->load->model("postmodel");
        $this->load->model("categorymodel");
        $this->load->library('form_validation');
        $this->data["categories"] = $this->categorymodel->get_array_id_name();
        $this->data["post_no_parents"]=$this->postmodel->get_no_parents();
	}

	public function index ($start_at=0 , $number_row=0){

        $this->data["posts"] = $this->postmodel->get();
       /* $this->load->library('pagination');
        $config['total_rows'] = count($this->data["posts"]);
        $config['per_page'] = 2;
        $config["uri_segment"] = 4;*/

        $config['base_url'] = base_url().'dashboard/posts/p';
      /*  $this->pagination->initialize($config);*/

        $this->data['subview']="dashboard/post/_post_list";
    //   $this->data["create_links"] =$this->pagination->create_links();
        $this->load->view("dashboard/_main_layout",$this->data);

	}
    public function p ($start_at=0 , $number_row=0){
        $this->data["posts"] = $this->postmodel->get();
        $this->load->library('pagination');
        $config['total_rows'] = count($this->data["posts"]);
        $config['per_page'] = 2;
        $config["uri_segment"] = 4;

        $config['base_url'] = base_url().'dashboard/posts/p';
        $this->pagination->initialize($config);

        $this->data['subview']="dashboard/post/_post_list";
        $this->data["create_links"] =$this->pagination->create_links();
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
            $is_active = 0;

            $datatoinsert = array(
                "user_id"=>$userid,
                "category_id"=>$categoryid,
                "parent_id"=>$parentid,
                "post_type"=>$posttype,
                "is_active"=>$is_active,
                "post_template"=>$posttemplate,
                "post_slug"=>put_underscore($postslug),
                "post_title"=>$posttitle,
                "post_name"=>$postname,
                "publication_date"=> $publicationdate,
                "post_content"=>$postcontent
            );
            $this->data["datatoinsert"] = $datatoinsert;
         //   $this->load->library('form_validation');
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

        $this->data['subview']="dashboard/post/_new_post";
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
            $postisactive = $this->input->post('postisactive',true);
            $categoryid = $this->input->post('categoryid',true);
            $postcontent = $this->input->post('postcontent',true);
            $postname = $this->input->post('postname',true);
            $userid = $this->input->post('userid',true);
            $postisactive = (strcmp($postisactive,"on")==0)?1:0;
            $datatoupdate = array(
                "user_id"=>$userid,
                "category_id"=>$categoryid,
                "parent_id"=>$parentid,
                "post_type"=>$posttype,
                "is_active"=>$postisactive,
                "post_template"=>$posttemplate,
                "post_slug"=>put_underscore($postslug),
                "post_title"=>$posttitle,
                "post_name"=>$postname,
                "publication_date"=>$publicationdate,
                "post_content"=>$postcontent
            );

              $validationrules = $this->postmodel->create_rules;

               $this->form_validation->set_rules($validationrules);

               if($this->form_validation->run() == FALSE){
                   $this->data['errors']='form validation error';
               }else{
                   $datatoupdate = array(
                       "user_id"=>$userid,
                       "category_id"=>$categoryid,
                       "parent_id"=>$parentid,
                       "post_type"=>$posttype,
                       "is_active"=>$postisactive,
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

            $this->data['subview']="dashboard/post/_edit_post";
            $this->load->view("dashboard/_main_layout",$this->data);


	}

	public function delete ($id){
        $this->postmodel->delete($id);
        redirect('admin/posts','refresh');
	}
    public function order ()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'dashboard/post/_order_post';
        $this->load->view('dashboard/_main_layout', $this->data);
    }
    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
           // dump($_POST['sortable']);
           $this->postmodel->save_order($_POST['sortable']);
        }

        // Fetch all pages
        $this->data['posts'] = $this->postmodel->get_nested();

        // Load view
        $this->load->view('dashboard/post/_order_ajax', $this->data);
    }

    public function upload_media()
    {

        $stl = 15;

        $config['upload_path'] = './media/images';
        $config['allowed_types'] = 'gif|jpg|png';
        $media_code = RandomStringId($stl);

        $config['max_size']	= '0';
        $config['max_width']  = '1920';
        $config['max_height']  = '1200';
        $config['file_name'] = $media_code;




        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

        }else{

            $data = array('upload_data' => $this->upload->data());
            $user_id = $this->input->post('userid',true);
            $post_id = $this->input->post('postid',true);
           // var_dump($data);

        /**/

        //    $this->load->library('image_lib');
            $config_manip['image_library'] = 'gd2';
            $config_manip['source_image']  = $data['upload_data']['file_path']."/".$data['upload_data']['file_name'];
            $config_manip['new_image']     =  $data['upload_data']['file_path']."/thumb/".$data['upload_data']['file_name'];
            $config_manip['create_thumb']  = TRUE;
            $config_manip['maintain_ratio'] = TRUE;
            $config_manip['thumb_marker'] = '_thumb';

            $config_manip['width']  = 150;
            $config_manip['height'] = 150;



            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }else{



            $this->load->model('mediamodel');

        //     $media_file =  $this->mediamodel->get_by(array('tbl_media.post_id'=>$post_id),true);

             //   var_dump($media_file);

/*                if($media_file != null){
                    $media_url = "./media/images/".get_media_url($media_file, FALSE);
                    $thumb_media_url  = "./media/images/thumb/".get_media_url($media_file, TRUE);

                        if (unlink($thumb_media_url)){

                        }
                        if(unlink($media_url)){

                        }

                }*/

            $media_code = $data['upload_data']['raw_name'];
            $media_type = $data['upload_data']['file_type'];
            $media_ext  = $data['upload_data']['file_ext'];
            $media_size = $data['upload_data']['file_size'];
            $media_name = basename($data['upload_data']['client_name'],$media_ext);

            $media_to_save = array(
                'post_id'=>$post_id,
                'media_code'=>$media_code,
                'user_id'=>$user_id,
                'media_name'=>$media_name,
                'media_type'=>$media_type,
                'media_ext'=>$media_ext,
                'media_size'=>$media_size
            );
            /*    if($media_file != null){
                    $this->mediamodel->save($media_to_save,$media_file->media_id );
                }else{*/
                    $this->mediamodel->save($media_to_save);
            //    }
            }
        }
        redirect('dashboard/posts','refresh');
    }
    public function edit_other_settings()
    {

    }




    public function _unique_slug ($str)
    {
        // Do NOT validate if slug already exists
        // UNLESS it's the slug for the current page


        $id = $this->uri->segment(4);
        $this->db->where('tbl_post.post_slug', $this->input->post('postslug'));
        ! $id || $this->db->where('tbl_post.post_id !=', $id);
        $posts = $this->postmodel->get();

        if (count($posts)) {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }

}