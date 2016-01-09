<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend_Controller extends MY_Controller {

	function __construct(){
		parent::__construct();
        $this->load->model('dashboard/postmodel');
        $this->load->model('dashboard/categorymodel');
        $this->load->model('dashboard/mediamodel');

      //  $this->data['menu'] = $this->postmodel->get_nested();


        $this->data['meta_title'] = config_item('site_name');
        $this->data['meta_title_acronym'] = config_item('site_acronym');

	}
}