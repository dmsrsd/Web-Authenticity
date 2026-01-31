<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Apicoba extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

		// $this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		// $this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}

	private function getRegisteredApi()
    {
        return ["101e6dfe-ed6f-48c7-8e09-b66542b3f6cb","7ca6bfd8-b733-47da-ae81-4219a0c2d233","0e4153a3-b594-4b8d-bf05-0dc9dc07d2db"];
    }

    private function isInputValid($inputs)
    {
        $apiKeys = $inputs['api_key'];
        if(in_array($apiKeys,$this->getRegisteredApi())){
            return true;
        }else{
            return false;
        }
    }

    private function http_respons_code($code = NULL) {
        switch ($code) {
            case 100: $text = 'Continue';
                break;
            case 101: $text = 'Switching Protocols';
                break;
            case 200: $text = 'OK';
                break;
            case 201: $text = 'Created';
                break;
            case 202: $text = 'Accepted';
                break;
            case 203: $text = 'Non-Authoritative Information';
                break;
            case 204: $text = 'No Content';
                break;
            case 205: $text = 'Reset Content';
                break;
            case 206: $text = 'Partial Content';
                break;
            case 300: $text = 'Multiple Choices';
                break;
            case 301: $text = 'Moved Permanently';
                break;
            case 302: $text = 'Moved Temporarily';
                break;
            case 303: $text = 'See Other';
                break;
            case 304: $text = 'Not Modified';
                break;
            case 305: $text = 'Use Proxy';
                break;
            case 400: $text = 'Bad Request';
                break;
            case 401: $text = 'Unauthorized';
                break;
            case 402: $text = 'Payment Required';
                break;
            case 403: $text = 'Forbidden';
                break;
            case 404: $text = 'Not Found';
                break;
            case 405: $text = 'Method Not Allowed';
                break;
            case 406: $text = 'Not Acceptable';
                break;
            case 407: $text = 'Proxy Authentication Required';
                break;
            case 408: $text = 'Request Time-out';
                break;
            case 409: $text = 'Conflict';
                break;
            case 410: $text = 'Gone';
                break;
            case 411: $text = 'Length Required';
                break;
            case 412: $text = 'Precondition Failed';
                break;
            case 413: $text = 'Request Entity Too Large';
                break;
            case 414: $text = 'Request-URI Too Large';
                break;
            case 415: $text = 'Unsupported Media Type';
                break;
            case 500: $text = 'Internal Server Error';
                break;
            case 501: $text = 'Not Implemented';
                break;
            case 502: $text = 'Bad Gateway';
                break;
            case 503: $text = 'Service Unavailable';
                break;
            case 504: $text = 'Gateway Time-out';
                break;
            case 505: $text = 'HTTP Version not supported';
                break;
            default:
                exit('Unknown http status code "' . htmlentities($code) . '"');
                break;
        }
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
        return $protocol . ' ' . $code . ' ' . $text;
    }

    private function jsonOutput($status, $message, $data, $code)
    {
        $response = ["status" => $status, "message" => $message, "data" => $data];

        header("Content-Type: application/json");

        header($this->http_respons_code($code));

        echo json_encode($response);
        exit;
    }


    public function api_login()
    {
        @session_start();
        if($this->isInputValid($_GET)){
            $email = $_GET['email'];
            $password = $_GET['password'];
            if(!isset($email) || !isset($password) || $email == '' || $password == ''){
                $this->jsonOutput('fail','Pleas put required input', null, 400);
                exit;
            }


            @session_start();
            $user = $email;
            $passz = $password;
            $pass = $this->encrypt->encode($passz);
            $cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('email' => $user)));
            $getse="";
            if($this->input->post('se')=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
                $getse = "?se=".$this->input->post('se');
            }

            if(!empty($cek)){
                if($this->encrypt->decode($cek['password']) == $passz){
                    if($cek['active']=="1"){
                        if($cek['status']=="-1"){
                            $response = array('status' => false, 'message' => 'Your account has been deleted by admin.');
                        } else {
                            $response = array(
                                // "id" => $cek['id_member'],
                                "fullname" => $cek['fullname'],
                                "email" => $cek['email'],
                            );

                            if($cek['last_login'] < date('Y-m-d')){
                                $point['id_member'] = $cek['id_member'];
                                $point['id_jenis_point'] = "2";
                                $point["created_date"] = date('Y-m-d H:i:s');
                                $this->model_global->insert($point, 'point');
                            }
                            $up['last_login'] = date('Y-m-d h:i:s');
                            $up['last_ip'] = getip();
                            $up['last_browser'] = 'API V2';
                            $up['token_forgot'] = "";
                            $up['tokenexp_forgot'] = "";
                            $this->model_global->update($up, 'member', array('id_member' => $cek['id_member']));
                        }
                    }else{
                        $response = array('status' => false, 'message' => 'Check your email to verify your account!');
                    }
                }else{
                    $response = array('status' => false, 'message' => 'Your email and password is not match!');
                }
            }else{
                $response = array('status' => false, 'message' => 'Your email and password is not match!');
            }


            header('Content-Type: application/json');
            echo json_encode($response);
            // $this->jsonOutput("success","api key valid",null);
        }else{
            $this->jsonOutput("fail","api key not valid", null, 401);
        }
    }

    public function api_provinsi()
    {

        if($this->isInputValid($_GET)){

            $provinsi = $this->model_global->get_data(array('select' => 'DISTINCT(provinsi)','table' => 'kota'));
            $this->jsonOutput("success","success",$provinsi, 200);
        }else{
            $this->jsonOutput("fail","api key not valid",null,401);
        }
    }

    public function api_kota()
    {

        if($this->isInputValid($_GET)){

            $kota = $this->model_global->get_data(array('select' => '*','table' => 'kota'));
            if(isset($_GET['provinsi'])){
                $lower_provinsi = strtolower($_GET['provinsi']);
                $kota = $this->model_global->get_data(array('select' => '*','table' => 'kota','where' => array('LOWER(provinsi)' =>$lower_provinsi)));
            }
            $this->jsonOutput("success","success",$kota,200);
        }else{
            $this->jsonOutput("fail","api key not valid",null,401);
        }
    }

    public function api_register()
    {

        if($this->isInputValid($_POST)){
            $ret['status'] = "false";
            $m = "";
            $ret['message'] = "";


            // unset($data_form['api_key']);
            $data_form = array(
                'fullname' => isset($_POST['fullname'])  ? $_POST['fullname'] : ''  ,
                'email' => isset($_POST['email']) ? $_POST['email'] : '',
                'gender' => isset($_POST['gender']) ? $_POST['gender'] : '',
                'hp' => isset($_POST['hp']) ? $_POST['hp'] : '',
                'issmoke' => isset($_POST['issmoke']) ? $_POST['issmoke'] : '',
                'id_kota' => isset($_POST['id_kota']) ? $_POST['id_kota'] : '',
                'password' => isset($_POST['password']) ? $_POST['password'] : '',
                'confirmpassword' => isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : ''
            );

            // $this->form_validation->reset_validation();
            // $this->form_validation->set_data($data_form);
            $this->form_validation->set_rules('fullname', 'Full name', 'required');
            // $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[member.email]');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('hp', 'Hanphone number', 'required');
            $this->form_validation->set_rules('issmoke', 'Is Smoke', 'required');
            $this->form_validation->set_rules('id_kota', 'Kota', 'required');
            // $this->form_validation->set_rules('id_provinsi', 'Provinsi', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required|matches[password]');


            if ($this->form_validation->run() == false)
            {
                $this->jsonOutput('fail',validation_errors(),null, 400);
            }

            ////manual validation
            // $key_name = '';
            // foreach($data_form as $key => $value){
            //     if(is_null($value) || empty($value) || $value == ''){
            //         $key_name = $key_name.','.$key;

            //     }
            // }
            // $message = "parameter ".$key_name." is empty or null";
            // if($key_name != ''){
            //     $this->jsonOutput('fail',$message,null);
            // }



            unset($data_form['confirmpassword']);
            $gen = $this->generateRandomString();
            $data_form['my_referal'] = $gen;
            $data_form["modified_date"] = date('Y-m-d H:i:s');
            $data_form["created_date"] = date('Y-m-d H:i:s');
            $exp = date('Y-m-d', strtotime("+3 days"));
            $acak = rand()."simpli".$data_form['email'];
            $data_form['token_active'] = md5($acak);
            $data_form['tokenexp_active'] = $exp;
            $data_form['status'] = "1";
            $data_form['active'] = "1";
            $red="";
            $data_form['tahun_lahir'] = '';
            $data_form['bulan_lahir'] = '';
            $data_form['tgl_lahir'] = '';


            //dob section
            $dob = '';
            if($data_form['tahun_lahir'] == '' || $data_form['bulan_lahir'] == '' || $data_form['tgl_lahir'] == ''){
                $s = "false";
                $m = "Data konfirmasi usia masih ada yang kosong!";
                $this->response = $this->session->flashdata('response');
                // $this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
                // redirect(base_url().'register'.$red);
            }else{
                $dob = $data_form['tahun_lahir'].'-'.$data_form['bulan_lahir'].'-'.$data_form['tgl_lahir'];
            }

            unset($data_form['tahun_lahir']);
            unset($data_form['bulan_lahir']);
            unset($data_form['tgl_lahir']);

            // $data_form['dob'] = $dob;

            $age = 20;
            if ($dob != ''){
                $date = new DateTime($dob);
                $now = new DateTime();
                $interval = $now->diff($date);
                $age = $interval->y;
                $data_form['dob'] = $dob;
            }

            if($age<17){
                $this->jsonOutput("fail","You're not 17 years old yet!",null, 403);

            }else{
                $adap = strlen($data_form['password']);
                if($adap<6){
                    $this->jsonOutput("fail","Password harus lebih dari 6 karakter",null, 400);
                }else{
                    $data_form['password'] = $this->encrypt->encode($data_form['password']);
                    $cek2 = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('email' => $data_form['email'])));
                    if(!empty($cek2)){
                        $s = "false";
                        $this->jsonOutput("fail","Email has been used, use another email!",null, 400);
                    }
                }
            }
            $go = "1";
            // $cek = verifyEmail($data_form['email'],"info@simplyauthentic.id",true);
            // if($s=="true"){
            //     if($cek[0]=="valid"){
            //         $go="1";
            //     }else{
            //         $s = "false";
            //         $this->jsonOutput("fail","Pastikan email aktif! ",null);
            //     }
            // }else{
            //     $go="0";
            // }

            if($go=="1"){

                    $this->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['mailpath'] = '/usr/sbin/sendmail';

                    // $config['smtp_host'] = 'smtp.zoho.com';
                    // //$config['smtp_host'] = 'smtp.gmail.com';
                    // $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                    // $config['smtp_timeout'] = '7';
                    // //$config['smtp_user'] = 'info@simplyauthentic.id';
                    // //$config['smtp_pass'] = 'clasmild16';
                    // $config['smtp_user'] = 'admin@simplyauthentic.id';
                    // $config['smtp_pass'] = '#m4g4pr0';
                    // //$config['smtp_user'] = 'noreplyauthenticity@gmail.com';
                    // //$config['smtp_pass'] = 'fqfnfzradwlxzzzt';
                    $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                    $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user'] = 'admin@simplyauthentic.id';
                    $config['smtp_pass'] = '13rBws6z9I7WvtDq';

                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['newline'] = "\r\n";
                    $config['smtp_crypto'] = 'ssl';
                    $this->email->initialize($config);
                    $this->email->from("admin@simplyauthentic.id", 'Simply Authentic');
                    $this->email->to($data_form['email']);
                    $this->email->subject('Simply Authentic : Register Verification');

                    $ver = $data_form['token_active'] ;
                    $em['data']="Hi <b>".ucwords($data_form['fullname'])."</b>.lo sudah siap untuk masuk ke wahana penuh inpirasi yang ciamik di <b>Simply Authentic</b>. Agar perjalanan lo lebih aman untuk menjelajah, jangan lupa aktivasi lewat link di bawah ini ya.";
                    $em['data'].="<br><br><a href='".base_url()."login/active/?ver=".$ver."'>Click here for ACTIVATION</a>";
                    $pesan = $this->load->view('front/email-template',$em,TRUE);
                    $this->email->message($pesan);
                    $se = $this->email->send();
                    if($se){

                        $insert_id = $this->model_global->insert($data_form, 'member');
                        if($insert_id){

                            $ret['status'] = "true";
                            $ret['message'] = "Check your email to verify your account!";
                            $id_member = $this->db->insert_id();
                            $point['id_member'] = $id_member;
                            $point['id_jenis_point'] = "1";
                            $point["created_date"] = date('Y-m-d H:i:s');
                            $this->model_global->insert($point, 'point');
                            $this->jsonOutput("success",$ret['message'],array('id_member' => $id_member), 200);

                        }else{
                            $ret['status'] = "false";
                            $this->jsonOutput("fail","Error Proccessing data",null, 500);

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
                        $this->jsonOutput('fail',$ret['message'],null, 400);
                    }


            }
        }else{
            $this->jsonOutput("fail","api key not valid",null, 401);
        }
    }

    public function api_resetpassword()
    {
        if($this->isInputValid($_GET)){

            $email = $_GET['email'];
            if(!isset($email) || $email == ''){
                $this->jsonOutput('fail','Please put data required',null, 400);
                exit;
            }

            $cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('email' => $email)));
            if(!empty($cek)){
                $acak = $this->generateRandomString();
                // $pass = $this->encrypt->encode($acak);

                $exp = date('Y-m-d', strtotime("+3 days"));
                $acak = rand()."simpli".$email;
                $ac['token_forgot'] = md5($acak);
                $ac['tokenexp_forgot'] = $exp;

                $update = $this->model_global->update($ac, 'member', array('id_member' => $cek['id_member']));
                if($update){
                    $to_email = $cek['email'];
                    $this->load->library('email');
                    $config['protocol'] = 'smtp';
                    $config['mailpath'] = '/usr/sbin/sendmail';
                    $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                    $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user'] = 'admin@simplyauthentic.id';
                    $config['smtp_pass'] = '13rBws6z9I7WvtDq';
                    $config['charset'] = 'utf-8';
                    $config['mailtype'] = 'html';
                    $config['newline'] = "\r\n";
                    $config['smtp_crypto'] = 'ssl';
                    $this->email->initialize($config);
                    $this->email->from("admin@simplyauthentic.id", 'Simply Authentic');
                    $this->email->to($to_email);
                    $this->email->subject('Simply Authentic : Reset your password');

                    $em['data'] ="Dear <b>".$cek['fullname']."</b>, <br><br>
                    Please change your password immediately.<br><br><a href=".base_url()."reset-password?ver=".md5($acak).">Click here to <b>RESET</b> your Password</a>.
                    Thank you.";

                    $pesan = $this->load->view('front/email-template',$em,TRUE);
					$this->email->message($pesan);
					@$se = $this->email->send();

                    if(!$se){

                        $this->jsonOutput('fail','Something wrong with system, please contact us!',null, 500);
                    }else{
                        $data_memeber = array(
                            'memeber_name' => $cek['fullname'],
                            'email' => $cek['email'],
                            'lates_login' => $cek['last_login']
                        );
                        // $data_memeber = null;
                        $this->jsonOutput('success','Reset password link already sent to your email',$data_memeber, 200);

                    }

                }
            }else{
                $this->jsonOutput('fail','Your email is not match!',null, 400);
            }
        }else{
            $this->jsonOutput("fail","api key not valid",null, 401);
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
}
