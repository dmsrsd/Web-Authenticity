<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contributor extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
	public function index(){
		redirect(base_url());
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['soundroom'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.modified_date desc'
		));
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/soundroom',$data);
	}
	public function read($slug){
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['kontributor'] = $this->model_global->get_data(array('data' => 'row','table' => 'kontributor', 'where' => array( 'slug' =>$slug,'status' =>1)));
		$data['listkontributor'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kontributor','where' => array('status' => 1), 'order_by' => 'nama asc'));;
		if(count($data['kontributor'])==0){
			redirect(base_url());
		}else{
			$data['subtitle'] = " | Contributor : ".$data['kontributor']['nama'];
			$data['website']['meta_description'] = $data['kontributor']['deskripsi'];
			$data['artikel'] = $this->model_global->get_data(array(
				'select' => 'a.*, b.nama as kategori,b.head_kategori,b.slug as slugkat',
				'table' => 'artikel a',
				'join' => array('kategori b','b.id_kategori = a.id_kategori'),
				'where' => array('a.status'=>1,'a.created_by'=>1,'a.id_kontributor'=>$data['kontributor']['id_kontributor']),
				'order_by' => 'a.created_date desc'
			));
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/contributor',$data);
		}
	}
}