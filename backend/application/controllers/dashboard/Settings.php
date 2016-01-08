<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends Admin_Controller {

	public function __construct ()
	{
		parent::__construct();


	}

	public function index (){

        $this->data['subview']="dashboard/settings/_settings_list";

		$this->load->view('dashboard/_main_layout', $this->data);
	}
    public function password(){
		$this->data['users'] = $this->usermodel->get();
        $datatoinsert =null;
        $current_password=''; $new_passwrord_1=null;$new_passwrord_2 =null;
        $user_id ='';


        if($_POST){
            $user_id = $this->input->post('userid',true);
            $current_password =$this->usermodel->hash( $this->input->post('current_password',true));
            $new_passwrord_1 = $this->input->post('new_password_1',true);
            $new_passwrord_2 = $this->input->post('new_password_2',true);
            $hashpass = $this->usermodel->hash($new_passwrord_1);


            $this->load->library('form_validation');
            $validationrules = $this->usermodel->editpassword;

            $this->form_validation->set_rules($validationrules);


            if ($this->form_validation->run() == FALSE)
            {

                $this->data['errors']='form validation error';
            }
            else
            {
                $current_pass_check  = array(
                    'user_id' => $user_id,
                    'password' =>$current_password,
                );

                $result = $this->usermodel->get_by($current_pass_check );



                if( count($result)){
                    $passtoupdate = array(
                        'password' =>$hashpass
                    );
                    $this->usermodel->save($passtoupdate,$user_id);
                    redirect('dashboard/settings','refresh');

                }else{

                    redirect('dashboard/settings/password','refresh');
                }

            }
        }else{

            $this->data["datatoinsert"] = $datatoinsert;

        }

		
		$this->data['subview'] = 'dashboard/settings/_edit_user_password';
		$this->load->view('dashboard/_main_layout', $this->data);
	}


}