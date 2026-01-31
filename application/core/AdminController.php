<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminController extends MY_Controller {

	function __construct() {
        parent::__construct();

	    if ($this->session->userdata('userinfo') && count($this->session->userdata('userinfo')) > 0) {
			$this->userinfo = $this->session->userdata('userinfo');
	    } else {
	    	$link = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	    	redirect('webadmin?redirect='.$link);
			exit;
	    }
		
		$this->response = $this->session->flashdata('response');
		$this->template['title'] = 'Authenticity | Admin';
		$this->template['active'] = 'home';
		$this->template['url'] = base_url()."webadmin/dashboard/";
		$this->template['judul'] = "Authenticity";
    }
}