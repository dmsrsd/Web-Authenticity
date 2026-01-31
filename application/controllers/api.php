<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Api extends RestController {
// class Api extends MY_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));
    }

    function login_get()
    {

        if(!$this->get('user_name') && !$this->get('password'))
        {
            $this->response(NULL, 400);
        }

        $api_reponse = array(
            'status' => false,
            'message' => 'Error',
        );

        //cek exist user
        $user = $this->get('user_name');
		$passz = $this->get('password');
		$pass = $this->encrypt->encode($passz);
        $cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('email' => $user)));

        if(empty($cek)){
            $api_reponse = 'Not registered ';
            $this->response($api_reponse, 200);
        }

        if($this->encrypt->decode($cek['password']) == $passz){
            if($cek['active']=="1"){
                if($cek['status']=="-1"){
                    $api_reponse['status'] = false;
                    $api_reponse['message'] = 'Data has ben deleted by admin';

                }else{
                    $array = array(
                            "id" => $cek['id_member'],
                            "fullname" => $cek['fullname']
                        );
                    $this->session->set_userdata('membersimply', $array);

                }
            }else{
                $api_reponse['status'] = false;
                $api_reponse['message'] = 'Check your email to verify your account!';

            }
        }else{
            $api_reponse['status'] = false;
            $api_reponse['message'] = 'Your email and password is not match!
			';

        }

        $this->response($api_reponse, 200);

    }

    function register_put()
    {
        $api_reponse = array(
            'status' => false,
            'message' => 'Error',
        );
		$m = "";
		$ret['message'] = "";
		$data_update = array();

		$gen = $this->generateRandomString();
		$data_update['my_referal'] = $gen;
		$data_update["modified_date"] = date('Y-m-d H:i:s');
		$data_update["created_date"] = date('Y-m-d H:i:s');
		$exp = date('Y-m-d', strtotime("+3 days"));
		$acak = rand()."simpli".$data_update['email'];
		$data_update['token_active'] = md5($acak);
		$data_update['tokenexp_active'] = $exp;
		$data_update['status'] = "1";
		$data_update['active'] = "1";
		$data_update['id_kota'] = "500";
		$red="";



		if(isset($_GET['req'])){
			if($_GET['req']!=""){
				$_POST['from_referal'] = $_GET['req'];
				$red = "?req=".$_GET['req'];
			}
		}
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
		$dob = '';
		if($_POST['tahun_lahir'] == '' || $_POST['bulan_lahir'] == '' || $_POST['tgl_lahir'] == ''){
			$s = "false";
			$m = "Data konfirmasi usia masih ada yang kosong!";
			$this->response = $this->session->flashdata('response');
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
			redirect(base_url().'register'.$red);
		}else{
			$dob = $_POST['tahun_lahir'].'-'.$_POST['bulan_lahir'].'-'.$_POST['tgl_lahir'];
		}

		unset($_POST['tahun_lahir']);
		unset($_POST['bulan_lahir']);
		unset($_POST['tgl_lahir']);

		$_POST['dob'] = $dob;

		$age = 20;
		if ($dob != ''){
			$date = new DateTime($dob);
			$now = new DateTime();
			$interval = $now->diff($date);
			$age = $interval->y;
		}
		if($age<17){
			$s = "false";
			$m = "You're not 17 years old yet!";
			$this->response = $this->session->flashdata('response');
			$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
			redirect(base_url().'register'.$red);
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
					redirect(base_url().'register'.$red);

				}else{
					$s = "true";
				}
			}
		}
		$go = "0";
		$cek = verifyEmail($_POST['email'],"info@simplyauthentic.id",true);
		if($s=="true"){
			if($cek[0]=="valid"){
				$go="1";
			}else{
				$s = "false";
				$m = "Pastikan email Anda aktif! ";
				$this->response = $this->session->flashdata('response');
				$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
				redirect(base_url().'register'.$red);

			}
		}else{
			$go="0";
		}
		if($go=="1"){
			//$_POST['age'] = $age;

			//$insert_id = $this->model_global->insert($_POST, 'member');
			//if($insert_id){

				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['smtp_host'] = 'smtp.zoho.com';
				$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				$config['smtp_timeout'] = '7';
				$config['smtp_user'] = 'noreply@simplyauthentic.id';
				$config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
				//sendinblue
                // $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                // $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                // $config['smtp_timeout'] = '7';
                // $config['smtp_user'] = 'admin@simplyauthentic.id';
                // $config['smtp_pass'] = '13rBws6z9I7WvtDq';
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['newline'] = "\r\n";
				$config['smtp_crypto'] = 'ssl';
				$this->email->initialize($config);
				$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
				$this->email->to($_POST['email']);
				$this->email->subject('Simply Authentic : Register Verification');

				$ver = $_POST['token_active'] ;
				$em['data']="Hi <b>".ucwords($_POST['fullname'])."</b>.lo sudah siap untuk masuk ke wahana penuh inpirasi yang ciamik di <b>Simply Authentic</b>. Agar perjalanan lo lebih aman untuk menjelajah, jangan lupa aktivasi lewat link di bawah ini ya.";
				$em['data'].="<br><br><a href='".base_url()."login/active/?ver=".$ver."'>Click here for ACTIVATION</a>";
				$pesan = $this->load->view('front/email-template',$em,TRUE);
				$this->email->message($pesan);
				$se = $this->email->send();

				if($se){
					$insert_id = $this->model_global->insert($_POST, 'member');
					if($insert_id){

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
								redirect(base_url()."register-thanks");
							}
						}

					}else{
						$ret['status'] = "false";
						$ret['message'] = "Error Proccessing..";
						$this->response = $this->session->flashdata('response');
						$this->session->set_flashdata('response', array('status' => 'error', 'message' => $ret['message']));
						redirect(base_url().'register'.$red);

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
					redirect(base_url().'register'.$red);
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
			redirect(base_url().'register'.$red);
		}

        $result = $this->user_model->update( $this->post('id'), array(
            'name' => $this->post('name'),
            'email' => $this->post('email')
        ));

        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }

        else
        {
            $this->response(array('status' => 'success'));
        }

    }

    function resetpassword_post()
    {
        // $users = $this->user_model->get_all();

        $api_reponse = array(
            'status' => false,
            'message' => 'error',
        );

        $email = $this->post('email');
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
					$this->load->library('email');
					$config['protocol'] = 'smtp';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['smtp_host'] = 'smtp.zoho.com';
					$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
					$config['smtp_timeout'] = '7';
					$config['smtp_user'] = 'noreply@simplyauthentic.id';
					$config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
					//sendinblue
                    // $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                    // $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                    // $config['smtp_timeout'] = '7';
                    // $config['smtp_user'] = 'admin@simplyauthentic.id';
                    // $config['smtp_pass'] = '13rBws6z9I7WvtDq';
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['smtp_crypto'] = 'ssl';
					$this->email->initialize($config);
					$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
					$this->email->to($to_email);
					$this->email->subject('Reset your password');

					$em['data'] ="Dear <b>".$cek['fullname']."</b>, <br><br>
					Please change your password immediately.<br><br><a href='https://authenticity.id/reset-password?ver=".md5($acak)."'>Click here to <b>RESET</b> your Password</a>.
					Thank you.";


					$this->email->message($pesan);
					@$se = $this->email->send();
					$this->response = $this->session->flashdata('responsereset');
					if(!$se){
                        $api_reponse = array(
                            'status' => false,
                            'message' => 'Something error, please contact us!'
                        );

					}else{
                        $api_reponse = array(
                            'status' => true,
                            'message' =>'Check your email to reset your password!'
                        );
					}


				}
		}else{
            $api_reponse = array(
                'status' => false,
                'message' => 'Your email is not match!'
            );

		}


        $this->response($api_reponse, 200);

    }
}
?>
