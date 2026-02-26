<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Campaign extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));

	}
	public function index($slug){
        
        if(!isset($slug)){
            show_404();
        }
        $data['website'] = $this->website;
		$data['kontributor'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kontributor','where' => array('status' => 1), 'order_by' => 'nama asc'));
		$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori' => 4), 'order_by' => 'urutan asc'));
		$data['campaign'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('slug' => $slug), 'order_by' => 'order_number asc'));
		$data['campaign_video'] = $this->model_global->get_data(array('select' => '*', 'table' => '_campaign','where' => array('section' => $data['campaign'][0]['id'],'status' => 1), 'order_by' => 'urutan asc'));
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/podcast/campaign-detail',$data);

	}

	public function acceptcookie(){
		$ret["status"] = "false";
		$this->load->helper('string');
		$_SESSION["cookie"] = random_string('alnum', 16);
		//$_SESSION["cookie"] = "";
		if($_SESSION["cookie"]!=""){
			$ret["status"] = "true";
		}
		echo json_encode($ret);
		die();
	}
	public function submitvisitor(){
		$ret["status"] = "false";
		echo json_encode($ret);
		die();
	}

}
