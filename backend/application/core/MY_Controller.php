<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	
	public $data = array();

	function __construct(){
		parent::__construct();
		$this->data['errors'] = array();
		//$this->data['site_name'] = config_item('site_name');
		/**
		* these are the subview of the pages
		**/
		$this->data['body_header'] = null;
		$this->data['subview'] = null;
		$this->data['body_footer'] =null;
	}
	
	
}