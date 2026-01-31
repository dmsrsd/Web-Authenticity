<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Socialdistanceone extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		//$this->load->helper('informasi');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));
		// $this->ticket = $this->model_global->get_data(array('select' => '*', 'table' => 'ticket','where' => array('status' => 1), 'order_by' => 'tanggal desc'));;

	}
	public function index(){
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;

			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/socialdistanceone-view',$data);
		}
	}
}
?>