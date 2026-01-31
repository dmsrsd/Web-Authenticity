<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct() {
        parent::__construct();

    }

    function index(){
		//echo $this->encrypt->decode("je8SrHJtBN2imtp7X5lZT5l7z6vsMv2uqpBmNOU/NbrvCQ8mjmjZKbdg2ixUEN5sTd6RvWjzWet7fOPdSrdI3g==");
		//echo $this->encrypt->encode("admin123#");
		//die();
		session_start();
		$this->template['active'] = 'home';
		if ($this->session->userdata('userinfosp')) {
			$c = $this->session->all_userdata();  
			//echo "sdf";die();
			redirect(base_url().'sp/dashboard'); 
	    } else {
			$this->load->view('sp/login', $this->template);
		}
	}

	function in() {
		session_start();
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		// $redirect = isset($_GET["redirect"]) ? $_GET["redirect"] : '';
		if ($this->configApp["superUsers"][$user] && $pass == $this->encrypt->decode($this->configApp["superUsers"][$user])) {
			$array = array(
					"_id" => $user,
					"idUser" => $user,
					"isSuperAdmin" => true,
					"grup" => "1", 
					"changePasswordDate" => date('Y-m-d H:i:s')
				);
			$this->session->set_userdata('userinfosp', $array);
			$_SESSION["verifytnmc"] = "FileManager4TinyMCE";
			redirect(base_url().'sp/dashboard');
		}else if($user == "" && $pass == ""){
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Username atau password kosong, silahkan ulangi kembali'));	
			redirect(base_url().'sp');
		}else {
			$pass = md5($pass);
			$cek = $this->model_global->get_data(array('data' => 'row','table' => 'usersp', 'where' => array('status' => 1, 'username' => $user, 'password' => $pass)));
			
			if(!empty($cek)){
				$cektiket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('id_ticket' => $cek['id_ticket'])));
				//if($cektiket['status']=="1"){
				if("1"=="1"){
					$array = array(
							"_id" => $cek['id_usersp'],
							"idUser" => $cek['name'],  
							"isSuperAdmin" => false 
						);
					$this->session->set_userdata('userinfosp', $array);
					$_SESSION["verifytnmc"] = "FileManager4TinyMCE"; 
					redirect(base_url().'sp/dashboard'); 
				}else{
					$this->response = $this->session->flashdata('response');
					$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Event '.$cektiket['judul'].' tidak aktif'));	
					redirect(base_url().'sp');
				}
			}else{
				$this->response = $this->session->flashdata('response');
				$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Username atau password yang dimasukkan salah, silahkan ulangi kembali'));	
				redirect(base_url().'sp');
			}
		}
	}
	
	function out() {
		session_start();
		$this->session->set_userdata('userinfosp', array());
//		session_destroy();
		unset($_SESSION['verifytnmc']);			
		unset($_SESSION['verify']);			
		redirect(base_url()."sp");
	}
}

