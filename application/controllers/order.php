<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Order extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));


	}
	public function index(){
		redirect(base_url());
	}
	public function detail($slug){
		$slug = strip_tags($slug);
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['darbotz'] = $this->model_global->get_data(array('data' => 'row','table' => 'darbotz', 'where' => array( 'slug' =>$slug,'status' =>1)));
		$coltags = "";
		$data['result'] = array();
		if(count($data['darbotz'])==0){
			redirect(base_url());
		}else{
			$result = array();
			$result = json_decode($this->input->post('result_data'));
			if(isset($result)){
				$data['result'] = $result;
				redirect(base_url()."mpay/status/".$result->order_id."/profile");
			}
			$data['member'] = array();
			if(!empty($this->datamember)){
				$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$this->datamember['id'])));
			}
			$data['subtitle'] = " | Order  ".$data['darbotz']['nama'];
			$data['website']['meta_description'] = $data['darbotz']['nama'];
			$data['website']['meta_image'] = base_url()."uploads/darbotz/".$data['darbotz']['banner'];
			$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/order-darbotz',$data);
		}
	}
}