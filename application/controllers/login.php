<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Login extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
	public function index(){
		@session_start();	
		
		// $this->session->unset_userdata('socialmedia_info');
		// $this->session->unset_userdata('social_media');			 

		// if(isset($_GET['rel']) && $_GET['rel']!=''){
		// 	$rel = $_GET['rel'];
		// 	$this->session->set_flashdata('rel', $rel);
		// }

		//echo $this->generateRandomString();
		//print_r($_SESSION);
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['se'] = "";
		$data['sestatus'] = "";
		if(isset($_GET['se'])){
			if($_GET['se']=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
				$data['se'] = $_GET['se'];
				$data['sestatus'] = "1";
			}else{
				redirect(base_url()."login");
			}
		}
		//$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori'=>'home'), 'order_by' => 'id_slide desc'));

		//$this->load->view('front/'.$data['website']['theme'].'/header',$data);
		//$this->load->view('front/'.$data['website']['theme'].'/home',$data);


		//--- tambahan-revamp	
			$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
			$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'tbl_provinsi', 'order_by' => 'provinsi asc'));

			$data['twitter_login_url'] = site_url('login/twitter');		
			$data['facebook_login_url'] = site_url('login/facebook');		
			$data['google_login_url'] = site_url('login/google');	
			
			// if( $this->session->userdata('tw_status') == 'verified' ){
			// 	$userdata = $this->session->all_userdata();
			// 	var_dump($userdata); die();
			// }
		//-- tambahan-revamp-end

		if(empty($this->datamember)){
			$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
			
			$data['subtitle'] = " | Login";
			//$this->load->view('front/podcast/header',$data);
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/login',$data);
			$this->load->view('front/podcast/footerfp');
		}else{
			if(isset($_GET['se'])){
				if($_GET['se']=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
					redirect(base_url()."rewards/se/".$_GET['se']);
				}else{
					redirect(base_url()."profile");
				}
			}else{
				redirect(base_url()."profile");
			}

		}
		if(isset($_GET['t'])){
			$cek = verifyEmail($_GET['t'],"anggir13@gmail.com",true);
			print_r($cek);
			echo $cek[0];
		}
	}

	// public function devreset(){
	// 	$passz = '11111111';
	// 	$pass = $this->encrypt->encode($passz);

	// 	KiBUEMXLgeWsdcVAmC1w/ntE6SCuYiq1z1rWuZh77Nmo1jks3Pr5RPmwie2OiakMjFSW4YD9xvIdVYe7edeI5w==
	// 	die($pass);
	// }

	public function in(){
		@session_start();
		@$to = $_GET['to'];
		$user = $this->input->post('email');
		$passz = $this->input->post('password');
		$pass = $this->encrypt->encode($passz);
		$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('email' => $user)));
		$getse="";
		if($this->input->post('se')=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
			$getse = "?se=".$this->input->post('se');
		}
		//cek untuk email selain gmail dan yahoo
		$domain = substr(strrchr($user, "@"), 1);
		// cek apakah domain termasuk gmail.com atau yahoo.com
		if ($domain != "gmail.com" && $domain != "yahoo.com" && $domain != "moengage.com") {
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Email harus menggunakan Gmail atau Yahoo!'));
			redirect(base_url().'login'.$getse);
			exit;
		}
		//end cek

		if(!empty($cek)){
			if($this->encrypt->decode($cek['password']) == $passz){
				if($cek['active']=="1"){
					if($cek['status']=="-1"){
						$this->response = $this->session->flashdata('response');
						$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Your account has been deleted by admin.'));
						redirect(base_url().'login'.$getse);
					}else{
						$array = array(
							"id" => $cek['id_member'],
							"fullname" => $cek['fullname'],
						);
						$this->session->set_userdata('membersimply', $array);
						if($cek['last_login'] < date('Y-m-d')){
							$point['id_member'] = $cek['id_member'];
							$point['id_jenis_point'] = "2";
							$point["created_date"] = date('Y-m-d H:i:s');
							$this->model_global->insert($point, 'point');
						}
						$up['last_login'] = date('Y-m-d h:i:s');
						$up['last_ip'] = getip();
						$up['last_browser'] = getbrowser();
						$up['token_forgot'] = "";
						$up['tokenexp_forgot'] = "";
						$_SESSION["verifytnmcmember"] = $cek['id_member'];
						$this->model_global->update($up, 'member', array('id_member' => $cek['id_member']));
						//if(isset($this->input->post('se'))){
							if($this->input->post('se')=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
								redirect(base_url()."rewards/se/".$this->input->post('se'));
							}else{
								if($to!=""){
									redirect(base_url().$to);
								}else{
									redirect(base_url().'profile');
								}
							}
						//}else{
						//	redirect(base_url().'profile');
						//}
					}
				}else{
					$this->response = $this->session->flashdata('response');
					$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Check your email to verify your account!'));
					redirect(base_url().'login'.$getse);
				}
			}else{
				$this->response = $this->session->flashdata('response');
				$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Your email and password is not match! '));
				redirect(base_url().'login'.$getse);
			}
		}else{
			$this->response = $this->session->flashdata('response');
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Your email and password is not match! '));
			redirect(base_url().'login'.$getse);
		}
	}

	public function active(){
		@session_start();
		$ver = $_GET['ver'];
		//$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('token_active' => $ver,'date(tokenexp_active) >='=>date('Y-m-d'))));
		$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('token_active' => $ver)));
		//print_r($cek); exit;
		if(!empty($cek)){
			$ac['active'] = "1";
            $update = $this->model_global->update($ac, 'member', array('id_member' => $cek['id_member']));
			$ref = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('my_referal' => $cek['from_referal'])));
			if(!empty($ref)){
				$point['id_member'] = $ref['id_member'];
				$point['id_jenis_point'] = "13";
				$point["created_date"] = date('Y-m-d H:i:s');
				$this->model_global->insert($point, 'point');
			}
            if($update){
				$h = '<meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
				$this->session->set_userdata('membersimply', array());
				unset($_SESSION['verifytnmcmember']);
				if(isset($cek['se'])){
					if($cek['se']=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
						$normal=$cek['se'];
					}else{
						$normal="1";
					}
				}else{
					$normal="1";
				}
				if($normal=="1"){
					$x['data'] = $h."<title>Authenticity | Verification</title><b>BERHASIL</b><br>Selamat ya, akun lo udah sukses diverifikasi.Sekarang lo udah auto otentik.<br><br><a href='".base_url()."login'>Back to Login</a>";
				}else{
					$x['data'] = $h."<title>Authenticity | Verification</title><b>BERHASIL</b><br>Selamat ya, akun lo udah sukses diverifikasi.Sekarang lo udah auto otentik.<br><br><a href='".base_url()."login?se=$normal'>Back to Login</a>";
				}
				$this->load->view('front/email-template',$x);
			}else{
				$x['data'] = $h."<title>Authenticity | Verification</title><b>GAGAL</b><br>Wrong Verification or URL Has been expired<br><br><a href='".base_url()."login'>Back</a>";
				$this->load->view('front/email-template',$x);
			}
		}else{
			$x['data'] = $h."<title>Authenticity | Verification</title><b>GAGAL</b><br>Wrong Verification or URL Has been expired<br><br><a href='".base_url()."login'>Back</a>";
			$this->load->view('front/email-template',$x);
		}
	}

	function generateRandomString($length = 13) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function resetform(){
		@session_start();
		@$ver = $_GET['ver'];
		$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('token_forgot' => $ver,'date(tokenexp_forgot) >='=>date('Y-m-d'))));
		if(!empty($cek)){
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/reset',$data);
		}else{
			$x['data'] = "<title>Authenticity | Reset Password</title><b>FAILED</b><br>Link has been EXPIRED.<br><br><a href='".base_url()."login'>Back to Login</a>";
			$this->load->view('front/email-template',$x);
		}

	}

	public function submitresetform(){
		@$ver = $_GET['ver'];
		$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('token_forgot' => $ver,'date(tokenexp_forgot) >='=>date('Y-m-d'))));
		if(!empty($cek)){
			$adap = strlen($_POST['password']);
			if($adap<6){
				$s = "false";
				$m = "Password harus lebih dari 6 karakter";
				$this->response = $this->session->flashdata('response');
				$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
				redirect(base_url().'reset-password?ver='.$ver);

			}else{
				$ac['active'] = "1";
				$ac['password'] = $this->encrypt->encode($_POST['password']);
				$update = $this->model_global->update($ac, 'member', array('id_member' => $cek['id_member']));
				$this->response = $this->session->flashdata('response');
				$this->session->set_flashdata('response', array('status' => 'success', 'message' => "Silahkan <a href='".base_url()."login'><b>Login</b></a> dengan Password yang telah password baru Anda<br>"));
				redirect(base_url().'reset-password?ver='.$ver);
			}
		}else{
			redirect(base_url()."login");
		}
	}

	public function reset(){
		$email = $_POST['email'];
		$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('email' => $email)));
		if(!empty($cek)){
			$acak = $this->generateRandomString();
			$pass = $this->encrypt->encode($acak);
			//$ac['password'] = $pass ;
			$exp = date('Y-m-d', strtotime("+3 days"));
			$acak = rand()."simpli".$_POST['email'];
			$ac['token_forgot'] = md5($acak);
			$ac['tokenexp_forgot'] = $exp;

			/*
			$cek2 = verifyEmail($_POST['email'],"info@simplyauthentic.id",true);
			if($cek2[0]=="invalid"){
				$this->response = $this->session->flashdata('responsereset');
				$this->session->set_flashdata('responsereset', array('status' => 'error', 'message' => 'Pastikan email Anda aktif! '));
				redirect(base_url().'login');

			}else{
				*/
				$update = $this->model_global->update($ac, 'member', array('id_member' => $cek['id_member']));

				if($update){

					$to_email = $cek['email'];
					// $this->load->config('email');
					$this->load->library('email');

					$config['protocol'] = 'smtp';
					$config['mailpath'] = '/usr/sbin/sendmail';					
					// $config['smtp_host'] = 'smtp.zoho.com';
					// $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
					// $config['smtp_timeout'] = '7';
					// //$config['smtp_user'] = 'info@simplyauthentic.id';
					// //$config['smtp_pass'] = 'clasmild16';
					// $config['smtp_user'] = 'noreply@simplyauthentic.id';
					// $config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
					// $config['smtp_user'] = 'noreplyauthenticity@gmail.com';
					// $config['smtp_pass'] = 'fqfnfzradwlxzzzt';
					//sendinblue
					// $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                    // $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                    // $config['smtp_timeout'] = '7';
                    // $config['smtp_user'] = 'admin@simplyauthentic.id';
                    // $config['smtp_pass'] = '13rBws6z9I7WvtDq';
					// new smtp google
					$config['smtp_host'] = 'smtp.gmail.com';
                    $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user'] = 'gridsf@gramedia-majalah.com';
                    $config['smtp_pass'] = 'zcup oxoy yfug waqs';

					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['smtp_crypto'] = 'ssl';
					$this->email->initialize($config);
					//$this->email->from("noreply@simplyauthentic.id", 'Authenticity');
					$this->email->from("gridsf@gramedia-majalah.com", 'Authenticity');
					$this->email->to($to_email);
					$this->email->subject('Authenticity : Reset your password');
					// $em['data'] ="Dear <b>".$cek['fullname']."</b>, <br><br>
					// Please change your password immediately.<br><br><a href='".base_url()."/reset-password?ver=".md5($acak)."'>Click here to <b>RESET</b> your Password</a>.
					// Thank you.";

					$em['data'] ="Dear <b>".$cek['fullname']."</b>, <br><br>
					Please change your password immediately.<br><br><a href='https://authenticity.id/reset-password?ver=".md5($acak)."'>Click here to <b>RESET</b> your Password</a>.
					Thank you.";

					$pesan = $this->load->view('front/email-template',$em,TRUE);
					$this->email->message($pesan);
					$se = $this->email->send();

					$this->response = $this->session->flashdata('responsereset');
					if(!$se){
						show_error($this->email->print_debugger());
						$this->session->set_flashdata('responsereset', array('status' => 'success', 'message' => 'Something error, please contact us! '));
					}else{
						// $this->session->set_flashdata('responsereset', array('status' => 'success', 'message' => 'Check your email for a new password! '));
						$this->session->set_flashdata('responsereset', array('status' => 'success', 'message' => 'Check your email to reset your password!'));
					}

					redirect(base_url().'login');
				}else{
					redirect(base_url());
				}
			//}
		}else{
			$this->response = $this->session->flashdata('responsereset');
			$this->session->set_flashdata('responsereset', array('status' => 'error', 'message' => 'Your email is not match!'));
			redirect(base_url().'login');
		}
	}

	public function submitregister(){
		@$to = $_POST['to'];
		//echo $to; exit;
		$ret['status'] = "false";
		$m = "";
		$ret['message'] = "";
		//unset($_POST['id_provinsi']);
		unset($_POST['confirmpassword']);
		unset($_POST['red']);
		$gen = $this->generateRandomString();
		$_POST['my_referal'] = $gen;
		$_POST["modified_date"] = date('Y-m-d H:i:s');
		$_POST["created_date"] = date('Y-m-d H:i:s');
		$exp = date('Y-m-d', strtotime("+3 days"));
		$acak = rand()."simpli".$_POST['email'];
		$_POST['token_active'] = md5($acak);
		$_POST['tokenexp_active'] = $exp;
		$_POST['status'] = "1";
		$_POST['active'] = "1";
		//$_POST['id_kota'] = "500";
		$red="";

		if(isset($_GET['req'])){
			if($_GET['req']!=""){
				$_POST['from_referal'] = $_GET['req'];
				$red = "?req=".$_GET['req'];
			}
		}

		$red .= ($red=='')? '?action=register':'&action=register';
		$red .= ($red=='')? '?to='.$to:'&to='.$to;
		$tamp_register = $_POST;
		$this->session->set_flashdata('tamp_register', $tamp_register);
		/*
		$birthDate = $_POST['dob'];
		$birthDate = explode("-", $birthDate);
		$age1 = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
		? ((date("Y") - $birthDate[0]) - 1)
		: (date("Y") - $birthDate[0]));
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		? ((date("Y") - $birthDate[2]) - 1)
		: (date("Y") - $birthDate[2]));
		*/
		//bypass age
		//dob section
		$yobb = '';
		$yob = $_POST['tahun_lahir'];
		if($_POST['bulan_lahir'] == '' || $_POST['tahun_lahir'] == ''){
		/*	$s = "false";
			$m = "Data konfirmasi usia masih ada yang kosong!";
			$this->response = $this->session->flashdata('response');
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
			// redirect(base_url().'register'.$red);
			redirect(base_url().'login'.$red);
			*/
			$yobb = '';
		}else{
			$yobb = $_POST['bulan_lahir'].'-'.$_POST['tahun_lahir'];
		}

		// unset($_POST['tahun_lahir']);
		// unset($_POST['bulan_lahir']);
		// unset($_POST['tgl_lahir']);
		
		//cek untuk email selain gmail dan yahoo
		$email = $_POST['email']; 
		// ambil domain email
		$domain = substr(strrchr($email, "@"), 1);
		// cek apakah domain termasuk gmail.com atau yahoo.com
		if ($domain != "gmail.com" && $domain != "yahoo.com" && $domain != "moengage.com") {
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => 'Email harus menggunakan Gmail atau Yahoo!'));
			redirect(base_url().'login'.$red);
			exit;
		}
		//end cek

		$_POST['dob'] = $dob;

			$age = 0; // default
			if (!empty($_POST['tahun_lahir'])) {
				$tahun_lahir = (int) $_POST['tahun_lahir']; // pastikan integer
				$tahun_sekarang = (int) date('Y');
				$age = $tahun_sekarang - $tahun_lahir; // cukup kurangi tahunnya saja
			}
			// Cek umur
			if ($age < 17) {
			$s = "false";
			$m = "You're not 17 years old yet!";
			$this->response = $this->session->flashdata('response');
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
			// redirect(base_url().'register'.$red);
			redirect(base_url().'login'.$red);
		}else{
			$adap = strlen($_POST['password']);
			if($adap<6){
				$s = "false";
				$m = "Password harus lebih dari 6 karakter";
			}else{
				$_POST['password'] = $this->encrypt->encode($_POST['password']);
				$cek2 = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('email' => $_POST['email'])));
				if(!empty($cek2)){
					$s = "false";
					$m = "Email has been used, use another email!";
					$this->response = $this->session->flashdata('response');
					$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
					// redirect(base_url().'register'.$red);
					redirect(base_url().'login'.$red);

				}else{
					$s = "true";
				}
			}
		}
		$go = "0";
		$cek = verifyEmail($_POST['email'],"gridsf@gramedia-majalah.com",true);
		if($s=="true"){
			if($cek[0]=="valid"){
				$go="1";
			}else{
				$s = "false";
				// $m = "Pastikan email Anda aktif!";
				$m = "Make sure your email is active!";
				$this->response = $this->session->flashdata('response');
				$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
				// redirect(base_url().'register'.$red);
				redirect(base_url().'login'.$red);

			}
		}else{
			$go="0";
		}
		if($go=="1"){
			//$_POST['age'] = $age;

			//$insert_id = $this->model_global->insert($_POST, 'member');
			//if($insert_id){

				$this->load->library('email');
				// $this->load->config('email');
				$config['protocol'] = 'smtp';
				$config['mailpath'] = '/usr/sbin/sendmail';
				// $config['smtp_host'] = 'smtp.zoho.com';
				// $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				// $config['smtp_timeout'] = '7';
				// //$config['smtp_user'] = 'info@simplyauthentic.id';
				// //$config['smtp_pass'] = 'clasmild16';
				// $config['smtp_user'] = 'noreply@simplyauthentic.id';
				// $config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
				// $config['smtp_user'] = 'noreplyauthenticity@gmail.com';
				// $config['smtp_pass'] = 'fqfnfzradwlxzzzt';
				//sendinblue
                // // $config['smtp_pass'] = 'fqfnfzradwlxzzzt';
				// $config['smtp_host'] = 'smtp-relay.sendinblue.com';
				// $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				// $config['smtp_timeout'] = '7';
				// $config['smtp_user'] = 'admin@simplyauthentic.id';
				// $config['smtp_pass'] = '13rBws6z9I7WvtDq';
				// new smtp google
				// $config['smtp_host'] = 'smtp.gmail.com';
				// $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				// $config['smtp_timeout'] = '7';
				// $config['smtp_user'] = 'gridsf@gramedia-majalah.com';
				// $config['smtp_pass'] = 'zcup oxoy yfug waqs';

				//$config['smtp_host'] = 'smtp.zoho.com';
				//$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				//$config['smtp_timeout'] = '7';
				//$config['smtp_user'] = 'info@authenticity.id';
				//$config['smtp_pass'] = 'clasmild16';
				
				$config['smtp_host'] = 'in-v3.mailjet.com';
				$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				$config['smtp_timeout'] = '7';
				$config['smtp_user'] = 'b467205daf9b1fbcbc56b6409a9c47c9';
				$config['smtp_pass'] = 'de9787bb240517f9ff187ebe432fa3a8';
				
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['newline'] = "\r\n";
				$config['smtp_crypto'] = 'ssl';
				$this->email->initialize($config);
				$this->email->from("noreply@authenticity.id", 'Authenticity.id');
				//$this->email->from("noreply@simplyauthentic.id", 'Authenticity');
				$this->email->to($_POST['email']);
				$this->email->subject('Authenticity.id : Verifikasi');

				$ver = $_POST['token_active'] ;
				// $em['data']="Hi <b>".ucwords($_POST['fullname'])."</b>.lo sudah siap untuk masuk ke wahana penuh inpirasi yang ciamik di <b>Authenticity</b>. Agar perjalanan lo lebih aman untuk menjelajah, jangan lupa aktivasi lewat link di bawah ini ya.";
				// $em['data'].="<br><br><a href='".base_url()."login/active/?ver=".$ver."'>Click here for ACTIVATION</a>";
				// $em['data']="<b>".ucwords($_POST['fullname'])."</b>.Biar lo bisa akses semua konten, event, dan reward di <b>Authenticity.id</b>, klik tombol verifikasi di bawah. Abis itu, lo langsung jadi bagian dari keseruan ini dan siap eksplor yang udah kita siapin buat lo.";
				// $em['data'].="<br><br><a href='".base_url()."login/active/?ver=".$ver."'>Verifikasi Sekarang!</a>";
				$em['data'].=base_url()."login/active/?ver=".$ver;
				$pesan = $this->load->view('front/email-register',$em,TRUE);
				$this->email->message($pesan);
				$se = $this->email->send();

				if($se){
					$tamp_rokok = $_POST['rokok'];
					if($tamp_rokok=='Lainnya'){
						$_POST['rokok'] = $_POST['rokok_lain'];
					}
					unset($_POST['rokok_lain']);

					$dt_member = [
						//'id_kota' => htmlspecialchars($this->input->post('id_kota')),
						//'fullname' => htmlspecialchars($this->input->post('fullname')),
						'my_referal' => $gen,
						'fullname' => htmlspecialchars($this->input->post('username')), //dibuat username karena yg full name di takeoff
						'email' => htmlspecialchars($this->input->post('email')),
						'address' => htmlspecialchars($this->input->post('address')),
						'gender' => htmlspecialchars($this->input->post('gender')),
						'hp' => htmlspecialchars($this->input->post('hp')),
						'rokok' => htmlspecialchars($this->input->post('rokok')),
						'nik' => htmlspecialchars($this->input->post('nik')),
						'instagram' => htmlspecialchars($this->input->post('instagram')),
						'password' => $_POST['password'],
						'token_active' => $ver,
						'yobb' => $yobb,
						'age' => $age,
						'username' => htmlspecialchars($this->input->post('username')),
						'district' => $_POST['district'],
						'id_tbl_provinsi' => $_POST['id_provinsi'],
						'id_tbl_kota' => $_POST['id_kota'],
						//'passion' => implode(",",$_POST['passion']),
						'created_date' => date('Y-m-d H:i:s')
					];
					// var_dump($dt_member); die();
					// $insert_id = $this->model_global->insert($_POST, 'member');
					$insert_id = $this->model_global->insert($dt_member, 'member');
					if($insert_id){
						$this->session->set_userdata('first_login', 'yes');

						$ret['status'] = "true";
						$ret['message'] = "Check your email to verify your account!";
						$id_member = $this->db->insert_id();
						$point['id_member'] = $id_member;
						$point['id_jenis_point'] = "1";
						$point["created_date"] = date('Y-m-d H:i:s');
						$this->model_global->insert($point, 'point');
						if(isset($_POST['se'])){
							if($_POST['se']=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
								redirect(base_url()."register-thanks?se=".$_POST['se']);
							}else{
								if($to=="campaign-merch"){
									redirect(base_url()."register-thanks-tts?to=".$to);
								}else{
									redirect(base_url()."register-thanks");
								}
							}
						}

					}else{
						$ret['status'] = "false";
						$ret['message'] = "Error Proccessing..";
						$this->response = $this->session->flashdata('response');
						$this->session->set_flashdata('response', array('status' => 'error', 'message' => $ret['message']));
						// redirect(base_url().'register'.$red);
						redirect(base_url().'login'.$red);

					}
				}else{
					$log["type"] = "register";
					$log["email"] = $_POST["email"];
					//$log["id_member"] = $id_member;
					$log["created_date"] = date('Y-m-d H:i:s');
					$log["log"] = "EMAIL TIDAK VALID";
					$this->model_global->insert($log, 'log');
					$ret['status'] = "false";
					$ret['message'] = "Error Proccessing email tidak valid";
					$x = $this->email->print_debugger();
					$this->response = $this->session->flashdata('response');
					$this->session->set_flashdata('response', array('status' => 'error', 'message' => $ret['message']));
					// redirect(base_url().'register'.$red);
					redirect(base_url().'login'.$red);
				}
			//}else{
			//	$ret['status'] = "false";
			//	$ret['message'] = "Error Proccessing";
			//}

		}else{
			$ret['status'] = "false";
			$ret['message'] = $m;
			$this->response = $this->session->flashdata('response');
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
			// redirect(base_url().'register'.$red);
			redirect(base_url().'login'.$red);
		}


	}

	public function register(){
		redirect(base_url().'login');

		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['provinsi'] = $this->model_global->get_data(array('select' => 'provinsi', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		$data['se'] = "";
		$data['sestatus'] = "";
		if(isset($_GET['se'])){
			if($_GET['se']=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
				$data['se'] = $_GET['se'];
				$data['sestatus'] = "1";
			}else{
				redirect(base_url()."register");
			}
		}
		//$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori'=>'home'), 'order_by' => 'id_slide desc'));

		//$this->load->view('front/'.$data['website']['theme'].'/header',$data);
		//$this->load->view('front/'.$data['website']['theme'].'/home',$data);
		if(empty($this->datamember)){
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/register',$data);
		}else{
			if(isset($_GET['se'])){
				if($_GET['se']=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
					redirect(base_url()."rewards/se/".$_GET['se']);
				}else{
					redirect(base_url()."profile");
				}
			}else{
				redirect(base_url()."profile");
			}
		}

	}
	public function registerthanks(){

		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','order_by' => 'provinsi asc'));
		// $data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		//$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori'=>'home'), 'order_by' => 'id_slide desc'));

		//$this->load->view('front/'.$data['website']['theme'].'/header',$data);
		//$this->load->view('front/'.$data['website']['theme'].'/home',$data);
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/register-thanks',$data);

	}

	//-- SOCIALMEDIA-CONNECT
		
		public function twitter(){

			$this->load->library('twconnect');
			$twredirect = $this->twconnect->twredirect();
			// var_dump($twredirect); die();
			// redirect(base_url()."login");
		}

		public function twitter_callback(){
			$userdata = $this->session->all_userdata();
			
			$this->load->library('twconnect');
			$callback = $this->twconnect->twprocess_callback();
			if($callback===false){
				//-- destroy-all-userdata
				if( $this->session->userdata('tw_status') == 'old_token' ){
					$this->session->sess_destroy();
				}
				
				redirect(base_url()."login/twitter");
			}else{
				if( $this->session->userdata('tw_status') == 'verified' ){
					$tw_id = $this->session->userdata('user_id');
					$twitter_data = $this->twconnect->twaccount_verify_credentials();

					//-- cek-member
					$old_member = false;
					$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('status'=>1, 'active'=>1, 'socialmedia_connect'=>'twitter', 'socialmedia_id' => $twitter_data->id)));
					if(!empty($cek)){
						$array = array(
							"id" => $cek['id_member'],
							"fullname" => $cek['fullname'],
						);
						$this->session->set_userdata('membersimply', $array);

						$up['last_login'] = date('Y-m-d h:i:s');
						$up['last_ip'] = getip();
						$up['last_browser'] = getbrowser();
						$up['token_forgot'] = "";
						$up['tokenexp_forgot'] = "";
						$_SESSION["verifytnmcmember"] = $cek['id_member'];
						$this->model_global->update($up, 'member', array('id_member' => $cek['id_member']));
						redirect(base_url()."profile");
					}

					$sosmed['sosmed_id'] = $twitter_data->id;
					$sosmed['sosmed_email'] = '';
					$sosmed['sosmed_name'] = $twitter_data->name;
					$this->session->set_userdata('socialmedia_info', $sosmed);
					$this->session->set_userdata('social_media', 'twitter');
					redirect(base_url()."login?action=register");
				}
			}

			redirect(base_url()."login");
		}

		public function facebook(){
			$this->config->load('facebook');
			$this->load->library('Facebook', $this->config->item('fb_config_2'));
			$callbackurltoyourwebsite = base_url() . 'facebook/callback';
			$data['facebook_login_url'] = $this->facebook->loginURL($callbackurltoyourwebsite);
			redirect($data['facebook_login_url']);
			// echo '<a href="'.$data['facebook_login_url'].'">Login FB</a>';
		}

		public function facebook_callback(){
			$this->config->load('facebook');
			$this->load->library('Facebook', $this->config->item('fb_config_2'));

			$callbackurltoyourwebsite = base_url() . 'facebook/callback';
			$facebook_login_url = $this->facebook->loginURL($callbackurltoyourwebsite);

			$response = $this->facebook->getAccessToken();
			if($response['token'])
			{
				$token = $response['token'];
				$this->facebook->setAccessToken($token);
			}else{
				error_log($response['message']);
			}

			
			if(!empty($token))
			{	
				$fbuser = [];
				$response = $this->facebook->getUserInfo();
				if($response['user_info']){
					$fbuser = $response['user_info'];
				}else{
					redirect($facebook_login_url);
				}

				//-- cek-member
				$old_member = false;
				$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('status'=>1, 'active'=>1, 'socialmedia_connect'=>'facebook', 'socialmedia_id' => $fbuser['id'])));
				if(!empty($cek)){
					$old_member = true;
				}else{
					$cek_byemail = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('status'=>1, 'active'=>1, 'email'=>$fbuser['email'])));
					if(!empty($cek_byemail)){
						$cek = $cek_byemail;
						$old_member = true;
					}
				}


				if($old_member){
					$array = array(
						"id" => $cek['id_member'],
						"fullname" => $cek['fullname'],
					);
					$this->session->set_userdata('membersimply', $array);
						
					$up['last_login'] = date('Y-m-d h:i:s');
					$up['last_ip'] = getip();
					$up['last_browser'] = getbrowser();
					$up['token_forgot'] = "";
					$up['tokenexp_forgot'] = "";
					$up['socialmedia_connect'] = "facebook";
					$up['socialmedia_id'] = $fbuser['id'];
					$_SESSION["verifytnmcmember"] = $cek['id_member'];
					$this->model_global->update($up, 'member', array('id_member' => $cek['id_member']));
					redirect(base_url()."profile");
				}


				$sosmed = [];
				$sosmed['sosmed_id'] = $fbuser['id'];
				$sosmed['sosmed_email'] = $fbuser['email'];
				$sosmed['sosmed_name'] = $fbuser['name'];
				$this->session->set_userdata('socialmedia_info', $sosmed);
				$this->session->set_userdata('social_media', 'facebook');
				redirect(base_url()."login?action=register");

			}else{
				redirect(base_url()."login");
			}
		}

		public function facebook_logout(){
			$this->config->load('facebook');
			$this->load->library('Facebook', $this->config->item('fb_config_2'));
			
			$this->session->unset_userdata('socialmedia_info');
			$this->session->unset_userdata('social_media');

			redirect(base_url()."login");
		}


		public function google(){
			include_once APPPATH . "libraries/Google/vendor/autoload.php";
			
			$google_client = new Google_Client();
			$google_client->setClientId(G_KEY); //masukkan ClientID anda 
			$google_client->setClientSecret(G_SECRET); //masukkan Client Secret Key anda
			$google_client->setRedirectUri(base_url().'google/callback'); //Masukkan Redirect Uri anda
			$google_client->addScope('email');
			$google_client->addScope('profile');

			$data['google_login_url'] = $google_client->createAuthUrl();
			redirect($data['google_login_url']);
		}

		public function google_callback(){

			include_once APPPATH . "libraries/Google/vendor/autoload.php";
			
			$google_client = new Google_Client();
			$google_client->setClientId(G_KEY); //masukkan ClientID anda 
			$google_client->setClientSecret(G_SECRET); //masukkan Client Secret Key anda
			$google_client->setRedirectUri(base_url().'google/callback'); //Masukkan Redirect Uri anda
			$google_client->addScope('email');
			$google_client->addScope('profile');

			if(isset($_GET["code"]))
			{
				$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
				if(!isset($token["error"]))
				{
					$google_client->setAccessToken($token['access_token']);
					// $this->session->set_userdata('access_token', $token['access_token']);
					$google_service = new Google_Service_Oauth2($google_client);
					$data = $google_service->userinfo->get();
					$current_datetime = date('Y-m-d H:i:s');

					//-- cek-member
					$old_member = false;
					$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('status'=>1, 'active'=>1, 'socialmedia_connect'=>'google', 'socialmedia_id' => $data['id'])));
					if(!empty($cek)){
						$old_member = true;
					}else{
						$cek_byemail = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('status'=>1, 'active'=>1, 'email'=>$data['email'])));
						if(!empty($cek_byemail)){
							$cek = $cek_byemail;
							$old_member = true;
						}
					}

					
					if($old_member){
						$array = array(
							"id" => $cek['id_member'],
							"fullname" => $cek['fullname'],
						);
						$this->session->set_userdata('membersimply', $array);
						
						$up['last_login'] = date('Y-m-d h:i:s');
						$up['last_ip'] = getip();
						$up['last_browser'] = getbrowser();
						$up['token_forgot'] = "";
						$up['tokenexp_forgot'] = "";
						$up['socialmedia_connect'] = "google";
						$up['socialmedia_id'] = $data['id'];
						$_SESSION["verifytnmcmember"] = $cek['id_member'];
						$this->model_global->update($up, 'member', array('id_member' => $cek['id_member']));
						redirect(base_url()."profile");
					}

					$sosmed = [];
					$sosmed['sosmed_id'] = $data['id'];
					$sosmed['sosmed_email'] = $data['email'];
					$sosmed['sosmed_name'] = $data['name'];
					$this->session->set_userdata('socialmedia_info', $sosmed);
					$this->session->set_userdata('social_media', 'google');
					redirect(base_url()."login?action=register");
					
				}									
			}

		}



	public function dev_member_cek(){
		
		$c = $this->session->all_userdata();
		$cookie = (isset($_SESSION['cookie']) ? $_SESSION['cookie'] : "");;	
		$datamember = @$c["membersimply"];	
		var_dump($datamember);

		$email = $_GET['email'];
		var_dump($email);
		$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('status'=>1, 'active'=>1, 'email' => $email)));
		var_dump($cek);
	}

}
