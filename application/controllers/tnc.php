<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tnc extends MY_Controller { 
	function __construct() {
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->library('session');  
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));
		
		$this->playlist_menu = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
	}
	public function index(){ 
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['playlist_menu'] = $this->playlist_menu;

		$this->load->view('front//podcast/header',$data);
		$this->load->view('front/tnc',$data);
	}
	public function tncrewards(){ 
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['playlist_menu'] = $this->playlist_menu;
		
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/tnc-rewards',$data);
	}
	public function tentang(){ 
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['playlist_menu'] = $this->playlist_menu;

		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/tentang',$data);
	}
	public function privacy(){ 
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['playlist_menu'] = $this->playlist_menu;
		
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/privacy',$data);
	}
}