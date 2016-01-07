<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->data['users'] = $this->usermodel->get();
        $this->data['subview'] = 'dashboard/user/_user_list';
        $this->load->view('dashboard/_main_layout', $this->data);

    }

    public function create() {
        //$this->data['users'] = $this->usermodel->get();
        
        $datatoinsert = null;
        $lastname = '';
        $firstname = '';
        $username = '';
        $email = '';
        $usertype = '';
        $password = '';
        $confirmpassword = '';


        if ($_POST) {
            $lastname = $this->input->post('lastname', true);
            $firstname = $this->input->post('firstname', true);
            $username = $this->input->post('username', true);
            $email = $this->input->post('email', true);
            $usertype = $this->input->post('usertype', true);
            $password = $this->input->post('password', true);
            $confirmpassword = $this->input->post('confirmpassword', true);
            $hashpass = $this->usermodel->hash($password);

            $datatoinsert = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email,
                'username' => $username,
                'user_role' => $usertype,
                'password' => $hashpass
            );
            $this->data["datatoinsert"] = $datatoinsert;
            $this->load->library('form_validation');

            $validationrules = $this->usermodel->rules;

            $this->form_validation->set_rules($validationrules);

            if ($this->form_validation->run() == FALSE) {
                //$this->load->view('myform');
                //var_dump($validationrules);
               // $this->data['errors'] = 'form validation error';
            } else {
                $this->usermodel->save($datatoinsert);
                redirect('dashboard/users', 'refresh');
            }
        } else {
            $datatoinsert = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email,
                'username' => $username,
                'user_role' => $usertype,
            );
            $this->data["datatoinsert"] = $datatoinsert;
        }
        $this->data['subview'] = 'dashboard/user/_new_user';
        $this->load->view('dashboard/_main_layout', $this->data);
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->data['user'] = $this->usermodel->get($id);
            if (count($this->data['user'])) {
                $this->data['subview'] = 'dashboard/user/_edit_user';
            } else {
                
            }
        } else {
            //	$this->data['user'] = $this->usermodel->get_new();
            $this->data['item'] = 'User';
            $this->data['subview'] = 'errors/no_item';
        }

        if ($_POST) {

            $userid = $this->input->post('userid', true);
            $lastname = $this->input->post('lastname', true);
            $firstname = $this->input->post('firstname', true);
            $email = $this->input->post('email', true);
            $usertype = $this->input->post('usertype', true);

            $rules = $this->usermodel->editrules;

            $user = $this->usermodel->get($userid);

            $old_value=trim($user->email);
            if( $email!=$old_value) {
                $rules['Email']['rules'] = 'trim|required|valid_email|is_unique[tbl_user.email]';
            } else {
                $rules['Email']['rules'] = 'trim|required|valid_email';;
            }





            //$rules['Email']['rules'] = 'trim|required|edit_unique[tbl_user.email.' . $email . ']';

            $this->load->library('form_validation');
            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $datatoupdate = array(
                    "first_name" => $firstname,
                    "last_name" => $lastname,
                    "email" => $email,
                    "user_role" => $usertype,
                );
                $data = $this->usermodel->save($datatoupdate, $id);

                $this->data['user'] = $this->usermodel->get($id);
                redirect('dashboard/users');
            }/* */
        }


        $this->load->view('dashboard/_main_layout', $this->data);
    }

    public function delete($id) {
        
        
        $type="videos";
        $this->load->helper("file");
        //
        $videos = $this->videomodel->get_video_by_user($id);
        foreach($videos as $video ){
            
        $this->videotagmodel->delete_tags_by_video_id($video->video_id);
        $this->load->helper('file');
        $path ='./video/' . $video->video_code;
        $this->elasticsearch->delete($type,$id);
        delete_files($path, true);
        rmdir($path);
        
        
        }    
        $this->videomodel->delete_videos_by_user_id($id);
        
        $this->usermodel->delete($id);
        
        redirect('dashboard/users', 'refresh');
    }

    public function login() {
        $userAuth = null;

        if ($_POST) {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $userAuth = $this->usermodel->getUserTokenByUsernameAndPassword($username, $password);

            if ($userAuth == null) {
                $this->data["errors"] = array("username" => "error", "password" => "error");
            } else {
                $this->session->set_userdata("user_info",$userAuth);
                redirect('dashboard/users', 'refresh');
            }
        }
        $this->load->view('dashboard/_login', $this->data);
    }

    public function logout() {
        $this->session->unset_userdata('user_data');
        $this->session->sess_destroy();
        redirect('dashboard/users/login', 'refresh');
    }

    public function _unique_email($str) {
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $user = $this->usermodel->get();

        if (count($user)) {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }


    public function test() {
        echo "######################################<br>";
        var_dump($this->session->user_info);
        echo "######################################<br>";
        echo $this->session->user_info['user_token']."<br>";
        echo "######################################<br>";
        var_dump( $this->usermodel->getUserByToken($this->session->user_info['user_token']) );
        echo "######################################<br>";

    }

}
