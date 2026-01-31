<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event extends MY_Controller { 
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
		$data['subtitle'] = " | Event";
		$data['kategori'] = $this->kategori;
		$data['playlist_menu'] = $this->playlist_menu;
		$data['event_aktif'] = $this->model_global->get_data(array('select' => '*', 'row','table' => 'event', 'where' =>array('periode_end >' => date('Y-m-d H:i:s')), 'order_by'=>'periode_end desc'));
		$data['event_setelahnya'] = $this->model_global->get_data(array('select' => '*', 'row','table' => 'event', 'where' =>array('periode_end <' => date('Y-m-d H:i:s')), 'order_by'=>'periode_end desc'));
		//print_r($data); exit;
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/event/event-home',$data);
		$this->load->view('front/podcast/footerfp',$data);
	}
	public function detail($id){ 
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['playlist_menu'] = $this->playlist_menu;
		$data['event'] = $this->model_global->get_data(array('data' => 'row', 'row','table' => 'event', 'where' =>array('id_event' => $id)));
		$data['event_setelahnya'] = $this->model_global->get_data(array('select' => '*', 'row','table' => 'event', 'where' =>array('id_event !=' => $id), 'order_by' => 'periode_end desc'));
		//$hasil = str_replace(' ', '-', strtolower($name));
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/event/detail',$data);
		$this->load->view('front/podcast/footerfp',$data);
	}
}