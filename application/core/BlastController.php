<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BlastController extends MY_Controller {

	function __construct() {
        parent::__construct();

	    if ($this->session->userdata('userinfoblast') && count($this->session->userdata('userinfoblast')) > 0) {
			$this->userinfoblast = $this->session->userdata('userinfoblast');
	    } else {
	    	$link = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	    	redirect('blast?redirect='.$link);
			exit;
	    }
		
		$this->response = $this->session->flashdata('response');
		$this->template['title'] = 'Simply | Admin';
		$this->template['active'] = 'home';
		$this->template['url'] = base_url()."sp/dashboard/";
		$this->template['judul'] = "Simply";
    }
}