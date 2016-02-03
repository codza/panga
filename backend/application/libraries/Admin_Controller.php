<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
    var $userSession;
    var $sessionToken;
	function __construct(){
		parent::__construct();

        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->model('dashboard/usermodel');


        // Login check
      $exception_uris = array(
            'dashboard/users/login'/*,
            'admin/users/logout'*/
        );

        if ( (in_array(uri_string(), $exception_uris) == FALSE) && ( $this->session->has_userdata('user_info') == FALSE )) {

                redirect('dashboard/users/login', 'refresh');

        }else if((in_array(uri_string() , $exception_uris) == TRUE) && ($this->session->has_userdata('user_info') == TRUE) ){

            if($this->agent->is_referral() == TRUE){
                redirect( $this->agent->referrer() , 'refresh');
            }/*else{
                redirect('dashboard/users', 'refresh');
            }*/
          //

        }

        $this->tokenSession= $this->session->user_info['user_token'];
        $this->userSession = $this->usermodel->getUserByToken($this->tokenSession) ;



        }



}