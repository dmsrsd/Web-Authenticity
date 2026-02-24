<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct() {
        parent::__construct();

    }

	function index(){
		//echo $this->encrypt->decode("je8SrHJtBN2imtp7X5lZT5l7z6vsMv2uqpBmNOU/NbrvCQ8mjmjZKbdg2ixUEN5sTd6RvWjzWet7fOPdSrdI3g==");
		//echo $this->encrypt->encode("admin123#");
		//die();
		$this->template['active'] = 'home';
		if ($this->session->userdata('userinfo')) {
			$c = $this->session->all_userdata(); 
			redirect(base_url().'webadmin/dashboard');
	    } else {
			$this->load->view('login', $this->template);
		}
	}

	function in() {
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		// $redirect = isset($_GET["redirect"]) ? $_GET["redirect"] : '';
		if (isset($this->configApp['superUsers'][$user]) && $pass == $this->encrypt->decode($this->configApp['superUsers'][$user])) {
			$array = array(
					"_id" => $user,
					"idUser" => $user,
					"isSuperAdmin" => true,
					"group" => "1", 
					"changePasswordDate" => date('Y-m-d H:i:s')
				);
			$this->session->set_userdata('userinfo', $array);
			$_SESSION["verifytnmc"] = "FileManager4TinyMCE";
			redirect(base_url().'webadmin/dashboard');
		}else if($user == "" && $pass == ""){
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Username atau password kosong, silahkan ulangi kembali'));	
			redirect(base_url().'webadmin');
		}else {
			$pass = md5($pass);
			$cek = $this->model_global->get_data(array('data' => 'row','table' => 'user', 'where' => array('status' => 1, 'username' => $user, 'password' => $pass)));
			if(!empty($cek)){
				$array = array(
						"_id" => $cek['id_user'],
						"idUser" => $cek['name'],  
						"group" => $cek['group'],  
						"isSuperAdmin" => false 
					);
				$this->session->set_userdata('userinfo', $array);
				$_SESSION["verifytnmc"] = "FileManager4TinyMCE"; 
				redirect(base_url().'webadmin/dashboard'); 
			}else{
				$this->response = $this->session->flashdata('response');
				$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Username atau password yang dimasukkan salah, silahkan ulangi kembali'));	
				redirect(base_url().'webadmin');
			}
		}
	}
	
	function out() {
		$this->session->set_userdata('userinfo', array());
//		session_destroy();
		unset($_SESSION['verifytnmc']);			
		unset($_SESSION['verify']);			
		redirect(base_url()."webadmin");
	}
}

