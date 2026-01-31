<?php defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH.'/libraries/RestController.php';

// use chriskacerguis\RestServer\RestController;

// class Api extends RestController {
class Apiv2 extends MY_Controller {

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

	function index()
	{
		header('Content-Type: application/json');
		echo json_encode(
			array(
				'success'    => true,
				'message'    => 'api v2 works'
			)
		);
	}

	function masuk()
	{
		$this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() == TRUE) {
			session_start();
			$user = $this->input->post('email');
			$passz = $this->input->post('password');
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
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
?>