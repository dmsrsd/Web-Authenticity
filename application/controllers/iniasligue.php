<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Iniasligue extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));

	}
	public function index(){

		$data['website'] = $this->website;
		$data['kontributor'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kontributor','where' => array('status' => 1), 'order_by' => 'nama asc'));;
		$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori' => 2), 'order_by' => 'urutan asc'));;
		$data['artikeladmin'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategori,b.head_kategori,b.slug as slugkat',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status'=>1 ),
			'limit' => 3,
			'order_by' => 'a.created_date desc'
		));
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/iniasligue',$data);

	}

}
