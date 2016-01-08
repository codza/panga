<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Medias extends Admin_Controller {

	public function __construct ()
	{
		parent::__construct();

        $this->load->model("mediamodel");
        $this->load->library('form_validation');

	}

	public function index (){
        $this->data["images"] = $this->mediamodel->get();
        $this->data['subview']="dashboard/media/_media_list";
        $this->load->view("dashboard/_main_layout",$this->data);
	}

	public function create(){

	}

	public function edit($id = NULL){
        $datatoinsert =null;

        $media_name = "";


       if($id != NULL){
            $this->data['media'] = $this->mediamodel->get((int)$id);
        }

        if($_POST){
            $media_name = $this->input->post('medianame',true);

            $media_id = $this->input->post('mediaid',true);


            $datatoupdate = array(
             //   "media_id"=>$media_id,
                "media_name"=>$media_name,
            );
            $validationrules = $this->mediamodel->rules;

            $this->form_validation->set_rules($validationrules);

            if ($this->form_validation->run() == FALSE)
            {
                $this->data['errors']='form validation error';
            }else{
                $datatoupdate = array(
                //    "media_id"=>$media_id,
                    "media_name"=>$media_name,
                );
                $media_id = $this->mediamodel->save($datatoupdate,$media_id);
                $this->data['media'] = $this->mediamodel->get($media_id);
            }

        }
        $this->data['subview']="dashboard/media/_edit_media";

        $this->load->view("dashboard/_main_layout",$this->data);
	}

	public function delete ($id){

        $media_file =  $this->mediamodel->get_by(array('tbl_media.media_id'=>$id),true);

        if($media_file != null){

            $media_url = "./media/images/".get_media_url($media_file, FALSE);
            $thumb_media_url  = "./media/images/thumb/".get_media_url($media_file, TRUE);

            if (unlink($thumb_media_url)){

            }
            if(unlink($media_url)){

            }

        }
        $this->mediamodel->delete($id);
        redirect('dashboard/medias','refresh');
	}




}