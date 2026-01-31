<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SpController extends MY_Controller {

	function __construct() {
        parent::__construct();

	    if ($this->session->userdata('userinfosp') && count($this->session->userdata('userinfosp')) > 0) {
			$this->userinfosp = $this->session->userdata('userinfosp');
	    } else {
	    	$link = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	    	redirect('sp?redirect='.$link);
			exit;
	    }
		
		$this->response = $this->session->flashdata('response');
		$this->template['title'] = 'Simply | Admin';
		$this->template['active'] = 'home';
		$this->template['url'] = base_url()."sp/dashboard/";
		$this->template['judul'] = "Simply";
    }
}