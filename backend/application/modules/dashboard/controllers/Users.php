<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("dashboard/Rolemodel","rolemodel");
        $this->data['roles_option'] = $this->rolemodel->get_array_id_name();

    }

    public function index() {
        $ids = array($this->userSession->user_id, 1);

        $this->data['users'] = $this->usermodel->getAllButCurrentUser($ids);
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

            $old_value = trim($user->email);
            if ($email != $old_value) {
                $rules['Email']['rules'] = 'trim|required|valid_email|is_unique[tbl_user.email]';
            } else {
                $rules['Email']['rules'] = 'trim|required|valid_email';
                ;
            }





            //  $rules['Email']['rules'] = 'trim|required|edit_unique[tbl_user.email.' . $email . ']';

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
                $this->session->set_userdata("user_info", $userAuth);
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

    public function edit_unique($value, $params) {
        $this->set_message('edit_unique', "This %s is already in use!" . $params . " 000" . $value);
        list($table, $field, $current_id) = explode(".", $params);
        $result = $this->CI->db->where($field, $value)->get($table)->row();
        return ($result && $result->user_id != $current_id) ? FALSE : TRUE;
    }

    public function test() {
        echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";
        //  echo $this->session->user_info->user_token."<br>";
        echo "######################################<br>";
        var_dump($this->session->user_info);
        echo "######################################<br>";
        echo $this->session->user_info['user_token'] . "<br>";
        echo "######################################<br>";
        var_dump($user=$this->usermodel->getUserByToken($this->session->user_info['user_token']));
        echo "######################################<br>";
        echo "1111111111111111111111111111111111111<br>";
        echo "<br>############<br>";
        $this->load->model("dashboard/Rolepermmodel","rolepermmodel");
        $perm = $this->rolepermmodel->get_array_perms_by_role_id($user->user_role);
        var_dump($perm);
        echo "<br>############<br>";
      //  array_key_exists('first', $perm);



        if(perm_exits($perm ,'edit_user') ){
            echo "exits";
        }
        else{
            echo "doesn't exits";
        }




        
    }
    function async_upload_avatar_post() {
        $stl = 12;
        $config['upload_path'] = './icon_image/';
        $config['allowed_types'] = 'png|jpeg|jpg';
        $config['max_size'] = '1000';
        $avartar_code = RandomStringId($stl);
        $config['file_name'] = $avartar_code;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload("avatarfile")) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('uploaded_data' => $this->upload->data());
            $user_id = $this->post('userid');
            
          //  $is_public = 1;
          //  $avartar_code = RandomStringId($stl);
        //    $path_name = $data['uploaded_data']['file_path'];
            $file_name = $data['uploaded_data']['file_name'];
//            $raw_name = $data['uploaded_data']['raw_name'];
//            $video_ext = $data['uploaded_data']['file_ext'];
            $avartar_to_save = array(
                'avatar_icon' => $file_name,
            );
            $this->usermodel->save($avartar_to_save,$user_id);
        }
        $resp = ['status' => "success"];
        $this->response($resp);
    }


    public function contains_date($date) {
        if (strlen($date) < 10){
            return false;
        }else{
            $a_d = substr($date, -10);
            list($d, $m, $y ) = explode("_", $a_d);
        if (checkdate($m, $d, $y)) {
            echo "OK Date";
        } else {
            echo "BAD Date";
        }
            
        }
                
        
    }

}
