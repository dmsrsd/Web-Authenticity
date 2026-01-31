<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Store extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));

	}
	public function index(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Lab";
		$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori'=>3), 'order_by' => 'urutan asc'));
		$data['store'] = $this->model_global->get_data(array('select' => '*', 'table' => 'store','where' => array('status' => 1), 'order_by' => 'urutan asc'));
		
		//--- tambahan-revamp	
			$cur_page = 1;
			$offset = 0;
			$limit = 6;
			if( isset($_GET['page']) && $_GET['page']!='' ){
				$cur_page = $_GET['page'];
				$offset = ($cur_page-1) * $limit;
			}
			$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
			// $data['products'] = $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where' => array('status' => 1), 'order_by' => 'id_storeproduct desc', 'paging'=>$limit.','.$offset));
			// $products_total = count( $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where' => array('status' => 1), 'order_by' => 'id_storeproduct desc')) );
			$data['products'] = $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where_not_in' => array('status', 0), 'order_by' => 'id_storeproduct desc', 'paging'=>$limit.','.$offset));
			$products_total = count( $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where_not_in' => array('status', 0), 'order_by' => 'id_storeproduct desc')) );
			$data['products_page'] = ceil( $products_total / $limit );
			$data['products_url'] = site_url('lab');
			// var_dump($data['products_page']); die();
			// var_dump($this->db->last_query()); die();
			
		//-- tambahan-revamp-end
		
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/store',$data);
		$this->load->view('front/podcast/footerfp');
	}

	public function detail($slug){
		$id_store = 0;
		$product = $this->model_global->get_data(array('data' => 'row', 'table' => 'storeproduct','where' => array('status' => 1,'slug'=>$slug)));
		if($product){
			$id_store = $product['id_store'];
		}else{
			redirect($_SERVER['HTTP_REFERER']);
		}
		$product_related = $this->model_global->get_data(array('select' => '*','table' => 'storeproduct', 'where' => array( 'id_store' =>$id_store,'status' =>1), 'limit'=>3));
		$data['store'] = $this->model_global->get_data(array('data' => 'row','table' => 'store', 'where' => array( 'id_store' =>$id_store,'status' =>1)));
		
		$data['product'] = $product;
		$data['product_related'] = $product_related;
		$data['website'] = $this->website;
		$data['subtitle'] = " | Lab";
		$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
			
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/store-read',$data);
		$this->load->view('front/podcast/footerfp');

	}

	public function read($slug){
		$data['store'] = $this->model_global->get_data(array('data' => 'row','table' => 'store', 'where' => array( 'slug' =>$slug,'status' =>1)));
		$data['product'] = $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where' => array('status' => 1,'id_store'=>$data['store']['id_store']), 'order_by' => 'id_storeproduct desc'));
		$data['website'] = $this->website;
		$data['subtitle'] = " | Lab";
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/store-read',$data);
		$this->load->view('front/podcast/footerfp');

	}

	public function changesorting(){
		$ret["data"] = array();
		if(isset($_POST['sorting'])){
			$sorting = $_POST['sorting'];
			$orderBy = 'id_storeproduct desc';
			if($sorting=='terlama'){
				$orderBy = 'id_storeproduct asc';
			}
			if($sorting=='termurah'){
				$orderBy = 'harga asc';
			}
			if($sorting=='termahal'){
				$orderBy = 'harga desc';
			}

			$cur_page = 1;
			$offset = 0;
			$limit = 6;
			if( isset($_GET['page']) && $_GET['page']!='' ){
				$cur_page = $_GET['page'];
				$offset = ($cur_page-1) * $limit;
			}
			$data_widget['products'] = $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where' => array('status' => 1), 'order_by' => $orderBy, 'paging'=>$limit.','.$offset));
			$products_total = count( $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where' => array('status' => 1), 'order_by' => 'id_storeproduct desc')) );
			$data_widget['products_page'] = ceil( $products_total / $limit );
			$data_widget['products_url'] = site_url('lab');
			// var_dump($data_widget['products']); die();

			$ret['data'] = $this->load->view('front/store-widget', $data_widget, true);
		}
		echo json_encode($ret);
	}
}
?>