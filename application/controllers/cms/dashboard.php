<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends AdminController {
	function __construct() {
        parent::__construct();
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		//$this->load->library('dompdf_gen');
    }
	function url_get_contents ($Url) {
		if (!function_exists('curl_init')){
			die('CURL is not installed!');
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	public function cekcekan(){
		if(function_exists('fsockopen')) {

		echo "fsockopen function is enabled";

		}else {

		echo "fsockopen is not enabled";

		}
	}
	public function index(){
		$c = $this->session->all_userdata();
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->render('dashboard');
		//echo $this->template['url'];
	}
	public function about(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "About";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->render('about');
	}
	public function website(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Website";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->render('website');
	}
	public function wanotif(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Hosting WA";
		$my_apikey = "S2CMPIX23FKWSKM76S6Z";
		$number = "6281387588349 ";
		//$destination = "62".$detil['hp'];
		$api_url = "http://panel.capiwha.com/get_messages.php";
		$api_url .= "?apikey=". urlencode ($my_apikey);
		$api_url .= "&number=". urlencode ($number);
		//$this->template['ret'] = json_decode(file_get_contents($api_url, false));
		$this->template['ret'] = json_decode($this->url_get_contents($api_url));
		$this->template['saldo'] = json_decode($this->url_get_contents("http://panel.capiwha.com/get_credit.php?apikey=".$my_apikey),true);
		/*echo "<pre>";
		//print_r($ret);
		echo "</pre>";
		foreach($ret as $k){
			echo $k->to."<br>";
			echo $k->text."<br>";
			echo $k->creation_date."<br>";
			echo $k->process_date."<br>";

			echo "<hr>";
		}*/
		$this->render('wanotif');
	}

	public function darbotz(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Darbotz  ";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'darbotz','where' => array('status !=' => -1), 'order_by' => 'id_darbotz desc'));
		$this->render('darbotz');
	}
	public function darbotz_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Darbotz  ";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Darbotz ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'darbotz', 'where' => array('status !=' => -1, 'id_darbotz' => $_GET['_id'])));
		}
		$this->render('darbotz-new');
	}
	public function darbotz_product(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Product ";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'darbotz', 'where' => array('status !=' => -1, 'id_darbotz' => $_GET['_id'])));
			$this->template["judul"] = "Product List ".$this->template['data']['nama'];
		}
		$this->render('darbotz-product');
	}

	public function headkategori(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Head Kategori ";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'headkategori', 'order_by' => 'head_kategori desc'));
		$this->render('headkategori');
	}
	public function headkategori_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Slide ";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Head Kategori ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'headkategori', 'where' => array('id_kategori' => $_GET['_id'])));
		}
		$this->render('headkategori-new');
	}
	public function store(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Store ";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'store','where' => array('status !=' => -1), 'order_by' => 'id_store desc'));
		$this->render('store');
	}
	public function store_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Store ";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Store ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'store', 'where' => array('status !=' => -1, 'id_store' => $_GET['_id'])));
		}
		$this->render('store-new');
	}
	public function slide(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Slide ";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status !=' => -1,'kategori'=>1), 'order_by' => 'id_slide desc'));
		$this->render('slide');
	}
	public function slide_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Slide ";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Slide ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'slide', 'where' => array('status !=' => -1, 'id_slide' => $_GET['_id'])));
		}
		$this->render('slide-new');
	}
	public function storeproduct(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if(isset($_GET['p']) && $_GET['p'] != ''){
			$this->template['store'] = $this->model_global->get_data(array('data' => 'row', 'table' => 'store','where' => array('status !=' => -1,'id_store'=>$_GET['p'])));
			$this->template["judul"] = "Product Store ".$this->template['store']['judul'];
			$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where' => array('status !=' => -1,'id_store'=>$_GET['p']), 'order_by' => 'id_storeproduct desc'));
		}else{
			$this->template['store'] = $this->model_global->get_data(array('select' => '*', 'table' => 'store','where' => array('status !=' => -1)));
			$this->template["judul"] = "Product Store";
			$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'storeproduct','where' => array('status !=' => -1), 'order_by' => 'id_storeproduct desc'));
		}
		$this->template['status'] = array('Tidak Aktif', 'Aktif', 'Terjual');

		$this->render('storeproduct');
	}
	public function storeproduct_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['status'] = array('Tidak Aktif', 'Aktif', 'Terjual');
		
		// $this->template['store'] = $this->model_global->get_data(array('data' => 'row', 'table' => 'store','where' => array('status !=' => -1,'id_store'=>$_GET['p'])));
		// $this->template["judul"] = "Insert Product  Store ".$this->template['store']['judul'];
		
		if(isset($_GET['p']) && $_GET['p'] != ''){
			$this->template['store'] = $this->model_global->get_data(array('data' => 'row', 'table' => 'store','where' => array('status !=' => -1,'id_store'=>$_GET['p'])));
			$this->template["judul"] = "Insert Product Store ".$this->template['store']['judul'];
		}else{
			$this->template['store'] = $this->model_global->get_data(array('select' => '*', 'table' => 'store','where' => array('status !=' => -1)));
			$this->template["judul"] = "Insert Product Store";
		}
		
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Product Store ".$this->template['store']['judul'];
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'storeproduct', 'where' => array('status !=' => -1, 'id_storeproduct' => $_GET['_id'])));
		}
		$this->render('storeproduct-new');
	}
	public function storeproduct_button(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Button ";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'storeproduct', 'where' => array('status !=' => -1, 'id_storeproduct' => $_GET['_id'])));
			$this->template["judul"] = "Button List ".$this->template['data']['judul'];
		}
		$this->render('storeproduct-button');
	}


	public function slidestore(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Slide Store";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status !=' => -1,'kategori'=>3), 'order_by' => 'id_slide desc'));
		$this->render('slidestore');
	}
	public function slidestore_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Slide  Store";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Slide Store";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'slide', 'where' => array('status !=' => -1, 'id_slide' => $_GET['_id'])));
		}
		$this->render('slidestore-new');
	}
	public function slideiag(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Slide Ini Asli Gue";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status !=' => -1,'kategori'=>2), 'order_by' => 'id_slide desc'));
		$this->render('slideiag');
	}
	public function slideiag_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Slide  Ini Asli Gue";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Slide ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'slide', 'where' => array('status !=' => -1, 'id_slide' => $_GET['_id'])));
		}
		$this->render('slideiag-new');
	}
	public function slidepodcast(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Slide Podcast";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status !=' => -1,'kategori'=>4), 'order_by' => 'id_slide desc'));
		$this->render('slidepodcast');
	}
	public function slidepodcast_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Slide  Podcast";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Slide ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'slide', 'where' => array('status !=' => -1, 'id_slide' => $_GET['_id'])));
		}
		$this->render('slidepodcast-new');
	}

	public function podcast(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Podcast";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'podcast','where' => array('status !=' => -1), 'order_by' => 'urutan asc'));
		$this->render('podcast');
	}

	public function podcast_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert  Podcast";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Podcast ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'podcast', 'where' => array('status !=' => -1, 'id_podcast' => $_GET['_id'])));
		}
		$this->render('podcast-new');
	}

	public function districtcampaign(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "District Campaign";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('status !=' => -1), 'order_by' => 'id desc'));
		$this->render('districtcampaign');
	}

	public function districtcampaign_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert District Campaign";
		$this->template['section_list'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status !=' => -1), 'order_by' => 'order_number asc'));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit District Campaign ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'district_campaign', 'where' => array('status !=' => -1, 'id' => $_GET['_id'])));
		}
		$this->render('districtcampaign-new');
	}

	public function slidedistrictcampaign(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Slide";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide_district_campaign','where' => array('status !=' => -1,'kategori'=>4), 'order_by' => 'id_slide desc'));
		$this->render('slidedistrictcampaign');
	}
	public function slidedistrictcampaign_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Slide ";

		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Slide ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'slide_district_campaign', 'where' => array('status !=' => -1, 'id_slide' => $_GET['_id'])));
		}
		$this->render('slidedistrictcampaign-new');
	}

	//master section
	public function section(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Section";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status !=' => -1), 'order_by' => 'order_number asc'));
		$this->render('section');
	}

	public function section_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Section";

		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Section ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'web_section', 'where' => array('status !=' => -1, 'id' => $_GET['_id'])));
		}
		$this->render('section-new');
	}


	public function tahun_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Tahun ";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Tahun ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'tahun', 'where' => array('status !=' => -1, 'id_tahun' => $_GET['_id'])));
		}
		$this->render('tahun-new');
	}


	public function text(){
		$this->template["judul"] = "Text";
		$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->render('text');
	}

	public function meta(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Meta";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'ever_meta', 'order_by' => 'page asc'));
		$this->render('meta');
	}
	public function meta_new(){
		$this->template["judul"] = "Edit Meta";
		$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'ever_meta', 'where' => array( 'id_meta' => $_GET['_id'])));
		$this->render('meta-new');
	}
	public function foto(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Foto";
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as galeri',
			'table' => 'foto a',
			'join' => array('galeri b','b.id_galeri = a.id_galeri'),
			'where' => array('a.status !='=>-1),
			'order_by' => 'a.id_foto desc'
		));
		$this->render('foto');
	}
	public function foto_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Foto";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Foto";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'foto', 'where' => array('status !=' => -1, 'id_foto' => $_GET['_id'])));
		}
		$this->render('foto-new');
	}

	public function video(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Video ";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'video','where' => array('status !=' => -1), 'order_by' => 'id_video desc'));
		$this->render('video');
	}
	public function video_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Video ";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Video ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'video', 'where' => array('status !=' => -1, 'id_video' => $_GET['_id'])));
		}
		$this->render('video-new');
	}


    public function invoice(){
		$id = $_GET['id'];
		$root = $_SERVER["DOCUMENT_ROOT"]."/";
		$website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$id_member = $this->datamember['id'];
			$order= $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'id_order' =>$id)));
			if(count($order)>0){
				$alamat = $this->model_global->get_data(array(
				'data' => 'row',
				'table' => 'alamat a',
				'join' => array('negara b','b.id_negara = a.id_negara'),
				'join2' => array('provinsi c','c.id_provinsi = a.id_provinsi'),
				'where' => array( 'a.id_member' =>$order['id_member'],'a.jenis'=>$order['jenis'])));

				$buy = $this->model_global->get_data(array('select' => '*', 'table' => 'order_detail','where' => array('id_order' => $order['id_order']), 'order_by' => 'id_order_detail desc'));

				$em['data']="<div style=' text-align:left;'><h3>ORDER #".$order['kode_order']."</h3><h2>Thank you for your purchase!</h2>Hi <b>".$member['nama']."</b>, we're getting your order ready to be shipped.<br>We will notify you when it has been sent.";
				$em['data'].="<br><br><div style='border-bottom:1px solid #CCCCCC;'></div><br><h3>Order summary</h3>";
				$em['data'].="
					<table width='100%' cellpadding='5' cellspacing='5' align='center'> ";

					if(isset($buy) && count($buy) > 0){
						$total = 0;
						$no = 0;
						foreach($buy as $row){
							$p = $this->model_global->get_data(array('data' => 'row','table' => 'produk', 'where' => array( 'id_produk' =>$row['id_produk'])));
							$kat = $this->model_global->get_data(array('data' => 'row','table' => 'kategori', 'where' => array( 'id_kategori' =>$p['id_kategori'])));
							if($order['jenis']=="rp"){
								$harga = "Rp. ".number_format($row['total']);
							}else{
								$harga = "$".number_format($row['total']);
							}
							$size ="";
							if($p['ukuran']=="1"){
								$size = "Size : ".strtoupper($row['ukuran'])."<br>";
							}

							$em['data'].="
								<tr>
									<td width='10'><img src='".$root."uploads/produk/thumb/$p[image_produk]' width='100'></td>
									<td><b>$p[nama]</b><br>$size Quantity : ".$row['qty']."</td>
									<td width='200' align='right'>$harga</td>
								</tr>
							";
							$total = $total + $h;
							$no++;
						}
						if($order['jenis']=="rp"){
							$toth = "Rp. ".number_format($order['total']);
							$ship = "Rp. ".number_format($website['ongkirlokal']);
							$toth2 = "Rp. ".number_format($order['total'] + $website['ongkirlokal']);
							$grand = "Rp. ".number_format($order['grand_total']);
						}else{
							$toth = "USD $".number_format($order['total']);
							$ship = "$".number_format($website['ongkirluar']);
							$toth2 = "$".number_format($order['total'] + $website['ongkirluar']);
							$grand = "USD $".number_format($order['grand_total']);
						}
						$em['data'].= " 
							<tr bgcolor='#efefef'>
								<td align='right' colspan='2'>Shipping</td>
								<td align='right'><b>$ship</b></td>
							</tr>";
						if($order['kode_voucher']!=""){
							$em['data'].="
							<tr bgcolor='#efefef'>
								<td align='right' colspan='2'>Voucher</td>
								<td align='right'><b>$order[nama_potongan]</b></td>
							</tr> 
							<tr bgcolor='#DFDFDF'>
								<td align='right' colspan='2'>Total</td>
								<td align='right'><h2 style='margin:0px;'>$grand</h2></td>
							</tr>
							";
						}else{
							$em['data'].="
							<tr bgcolor='#DFDFDF'>
								<td align='right' colspan='2'>Total</td>
								<td align='right'><h2 style='margin:0px;'>$toth</h2></td>
							</tr>";
						}
					}
				$em['data'].="</table>";
				$prv = "";
				if($order['jenis']=="rp"){
					$prv = $alamat['provinsi'];
					$sip = "Shipping	Local Delivery";
				}else{
					$sip = "Shipping	International Shipping";
				}
				$em['data'].="<br><div style='border-bottom:1px solid #CCCCCC;'></div><br><h3>Customer information</h3>";
				$em['data'].="<table width='100%' cellpadding='5' cellspacing='2' align='center'> ";
				$em['data'].="
					<tr>
						<th colspan='2' align='left'>Shipping address & Billing address</th>
					</tr>
					<tr>
						<td width='200'>First Name</td>
						<th align='left'>$alamat[first_name]</th>
					</tr>
					<tr>
						<td width='200'>Last Name</td>
						<th align='left'>$alamat[last_name]</th>
					</tr>

					<tr>
						<td width='200'>Company</td>
						<th align='left'>$alamat[company]</th>
					</tr>
					<tr>
						<td width='200'>Address</td>
						<th align='left'>$alamat[address1]</th>
					</tr>
					<tr>
						<td width='200'>Apartment, suite, etc.</td>
						<th align='left'>$alamat[address2]</th>
					</tr>
					<tr>
						<td width='200'>Country</td>
						<th align='left'>$alamat[nama] $prv</th>
					</tr>
					<tr>
						<td width='200'>City</td>
						<th align='left'>$alamat[city]</th>
					</tr>
					<tr>
						<td width='200'>Postal/ZIP Code</td>
						<th align='left'>$alamat[zip]</th>
					</tr>
					<tr>
						<td width='200'>Phone</td>
						<th align='left'>$alamat[phone]</th>
					</tr>
					<tr>
						<th colspan='2' align='left'></th>
					</tr>
					<tr>
						<th colspan='2' align='left'>Shipping Method</th>
					</tr>
					<tr>
						<td colspan='2' align='left'>$sip</td>
					</tr>
					
				";
				$em['data'].="</table><br>";
				$em['data'].="<div style='border-bottom:1px solid #CCCCCC;'></div><br>If you have any questions, reply to this email or contact us at <a href='mailto:info@joblessofficial.com'>info@joblessofficial.com</a>";
				$em['data'].="</div>";
				$this->load->view('pdf-template',$em);

				$paper_size  = 'A4';
				$orientation = 'portrait';
				$this->dompdf->set_paper($paper_size, $orientation);
				$html = $this->output->get_output();
				$this->dompdf->load_html($html);
				$this->dompdf->render();
				$this->dompdf->stream("invoice_".$order['kode_order']."_".$order['created_date'].".pdf");
			}else{
				redirect(base_url()."order");
			}
		}


	}

	public function genqrticket(){
		$encode = $_POST['will'];
		$code = $this->encrypt->encode($encode);
		$ret['status'] = "true";
		$ret['qr'] = $code;
		echo json_encode($ret);
	}
	public function ticket(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Ticket ";
		if(isset($_GET['n'])){
			$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'ticket','where' => array('status' => 0), 'order_by' => 'tanggal asc'));
		}else{
			$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'ticket','where' => array('status' => 1), 'order_by' => 'tanggal asc'));
		}
		$this->render('ticket');
	}
	public function ticket_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Ticket ";
		$this->template['eo'] = $this->model_global->get_data(array('select' => '*', 'table' => 'eo','where' => array('status' => 1), 'order_by' => 'nama asc'));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Ticket ";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('status !=' => -1, 'id_ticket' => $_GET['_id'])));
		}
		$this->render('ticket-new');
	}

	public function redeemmember(){
		$this->template["judul"] = "Redeem Member";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member,b.email,b.address,b.hp,c.nama as redeem,c.point',
			'table' => 'redeemmember a',
			'join' => array('member b','b.id_member = a.id_member'),
			'join2' => array('redeempoint c','c.id_redeempoint = a.id_redeempoint'),
			//'where' => array('a.status !='=>-1,'a.created_by !='=>"1"),
			'order_by' => 'a.id_redeemmember desc'
		));
		$this->render('redeem');
	}
	public function resendregis(){
		$remote = $_SERVER['REMOTE_ADDR'];
		if($remote =="::1"){
			$base = "https://www.simplyauthentic.id/";
		}else{
			$base = base_url();
		}
		$id = $_POST['iod'];
		$ret['status'] = "true";
		$ret['message'] = "";
		$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$id)));
		if(count($member)==0){
			$ret['status'] = "false";
			$ret['message'] = "Member Tidak ada";
		}else{
			$config['protocol'] = 'smtp';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['smtp_host'] = 'smtp.zoho.com';
			$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
			$config['smtp_timeout'] = '7';
			$config['smtp_user'] = 'noreply@simplyauthentic.id';
			$config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
			//sendinblue
            // $config['smtp_host'] = 'smtp-relay.sendinblue.com';
            // $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
            // $config['smtp_timeout'] = '7';
            // $config['smtp_user'] = 'admin@simplyauthentic.id';
            // $config['smtp_pass'] = '13rBws6z9I7WvtDq';
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$config['newline'] = "\r\n";
			$config['smtp_crypto'] = 'ssl';
			$this->load->library('email');
			$this->email->initialize($config);
			//$this->email->from("info@simplyauthentic.id", 'Simply Authentic');
			$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
			$this->email->to($member['email']);
			$this->email->subject('Simply Authentic : Register Verification');
			$exp = date('Y-m-d', strtotime("+3 days"));
			$acak = rand()."simpli".$member['email'];
			$up['token_active'] = md5($acak);
			$up['tokenexp_active'] = $exp;

			$em['data']="Hi <b>".ucwords($member['fullname'])."</b>.lo sudah siap untuk masuk ke wahana penuh inpirasi yang ciamik di <b>Simply Authentic</b>. Agar perjalanan lo lebih aman untuk menjelajah, jangan lupa aktivasi lewat link di bawah ini ya.";
			$em['data'].="<br><br><a href='".base_url()."login/active/?ver=".$up['token_active']."'>Click here for ACTIVATION</a>";
			$pesan = $this->load->view('front/email-template',$em,TRUE);

			/*$cek = verifyEmail($member['email'],"info@simplyauthentic.id",true);
			if($cek[0]=="invalid"){
				$ret['status'] = "false";
				$ret['message'] = "Pastikan email aktif! ";
			}else{*/
				$update = $this->model_global->update($up, 'member', array('id_member' => $member['id_member']));
				$this->email->message($pesan);
				$se = $this->email->send();
				//var_dump($se);
				//die();
				if(!$se){
					$ret['status'] ="false";
					$ret['message'] = "Gagal kirim email! ";
				}else{
					$ret['status'] ="true";
				}
			//}

		}


		echo json_encode($ret);

	}
	public function orderresendwatext(){
		$id = $_POST['iod'];
		$ret['status'] = "true";
		$ret['html'] = "";
		$detil = $this->model_global->get_data(array('data' => 'row','table' => 'orderdetail', 'where' => array('id_orderdetail' => $id)));
		$ord = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array('id_order' => $detil['id_order'])));
		$tiket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('id_ticket' => $ord['id_ticket'])));

		$my_apikey = "S2CMPIX23FKWSKM76S6Z";
		$number = "6281387588349";
		$destination = "62".$detil['hp'];
		$siapa = ucwords($detil['nama']);
		$judul = ucwords($tiket['judul']);
		$tanggal = namadatetime($tiket['tanggal'],FALSE);
		$di = ucwords($tiket['dimana']);
		$text = "Pembayaran atas nama ".$siapa." telah Kami terima. Terimakasih telah melakukan pembelian tiket melalui SimplyAuthentic.ID *Jangan Hapus Pesan ini Gunakan QR Code untuk tiket masuk pada Event $judul $di $tanggal";
		$message = $text;
		$api_url = "http://panel.capiwha.com/send_message.php";
		$api_url .= "?apikey=". urlencode ($my_apikey);
		$api_url .= "&number=". urlencode ($destination);
		$api_url .= "&text=". urlencode ($message);
		@$my_result_object = json_decode($this->url_get_contents($api_url, false));
		if(!$my_result_object){
			$ret['status'] = "false";
			$ret['message'] = "GA konek WA ".$my_result_object;
		}else{
			$ret['status'] = "true";
		}

		echo json_encode($ret);

	}
	public function orderresendwaqr(){
		$remote = $_SERVER['REMOTE_ADDR'];
		if($remote =="::1"){
			$base = "https://www.simplyauthentic.id/";
		}else{
			$base = base_url();
		}
		$id = $_POST['iod'];
		$ret['status'] = "true";
		$ret['html'] = "";
		$detil = $this->model_global->get_data(array('data' => 'row','table' => 'orderdetail', 'where' => array('id_orderdetail' => $id)));
		$ord = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array('id_order' => $detil['id_order'])));
		$tiket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('id_ticket' => $ord['id_ticket'])));

		$my_apikey = "S2CMPIX23FKWSKM76S6Z";
		$number = "6281387588349";
		$destination = "62".$detil['hp'];
		$text = $base."uploads/qr/item-".$detil['id_order']."-".$detil['idx'].".png";
		$message = $text;
		$api_url = "http://panel.capiwha.com/send_message.php";
		$api_url .= "?apikey=". urlencode ($my_apikey);
		$api_url .= "&number=". urlencode ($destination);
		$api_url .= "&text=". urlencode ($message);
		@$my_result_object = json_decode($this->url_get_contents($api_url, false));
		if(!$my_result_object){
			$ret['status'] = "false";
			$ret['message'] = "GA konek WA ".$my_result_object;
		}else{
			$ret['status'] = "true";
		}

		echo json_encode($ret);

	}
	public function orderresendemail(){
		$remote = $_SERVER['REMOTE_ADDR'];
		if($remote =="::1"){
			$base = "https://www.simplyauthentic.id/";
		}else{
			$base = base_url();
		}
		$id = $_POST['iod'];
		$ret['status'] = "true";
		$ret['message'] = "";
		$order = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array( 'id_order' =>$id,'paid'=>'1')));
		if(count($order)==0){
			$ret['status'] = "false";
			$ret['message'] = "Member belum bayar";
		}else{
			$config['protocol'] = 'smtp';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['smtp_host'] = 'smtp.zoho.com';
			$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
			$config['smtp_timeout'] = '7';
			$config['smtp_user'] = 'noreply@simplyauthentic.id';
			$config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
			//sendinblue
            // $config['smtp_host'] = 'smtp-relay.sendinblue.com';
            // $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
            // $config['smtp_timeout'] = '7';
            // $config['smtp_user'] = 'admin@simplyauthentic.id';
            // $config['smtp_pass'] = '13rBws6z9I7WvtDq';
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$config['newline'] = "\r\n";
			$config['smtp_crypto'] = 'ssl';
			$this->load->library('email');
			$this->email->initialize($config);
			$ticket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$order['id_ticket'])));
			$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array( 'id_member' =>$order['id_member'])));
			$judul = ucwords($ticket['judul']);
			$tanggal = namadatetime($ticket['tanggal'],FALSE);
			$di = ucwords($ticket['dimana']);

			$emailheader="";
			$emailheader ="<div align='left'>Hi <b>".ucwords($member['fullname'])."</b>.<br>Pembelian tiket <b>$judul</b> di <b>$di</b> Tanggal <b>$tanggal</b> Telah <b>BERHASIL</b><br>";
			$emailheader.="Berikut data pembelian tiket : ";
			$det = $this->model_global->get_data(array('select' => '*', 'table' => 'orderdetail','where' => array('id_order' => $order['id_order'])));
			if(isset($det) && count($det) > 0){ foreach($det as $detil){
				$emaildetail="";
				$idx = $detil['idx'];
				$siapa = ucwords($detil['nama']);
				$text = "Pembayaran atas nama ".$siapa." telah Kami terima. Terimakasih telah melakukan pembelian tiket melalui SimplyAuthentic.ID *Jangan Hapus Pesan ini Gunakan QR Code untuk tiket masuk pada Event $judul $di $tanggal";
				$emailheader.= "<div align='left'>";
				$emailheader.= "<h3>Data $detil[idx]</h3>";
				$emailheader.= "<table>";
				$emailheader.= "<tr>";
				$emailheader.= "<td rowspan='3'><img src='".$base."uploads/qr/item-".$detil['id_order']."-".$idx.".png'></td>";
				$emailheader.= "<td width='100'>Nama</td>";
				$emailheader.= "<td width='10' align='center'>:</td>";
				$emailheader.= "<td><b>$detil[nama]</b></td>";
				$emailheader.= "</tr><tr><td>Email</td>";
				$emailheader.= "<td align='center'>:</td>";
				$emailheader.= "<td><b>$detil[email]</b></td>";
				$emailheader.= "</tr><tr><td>HP/WA</td>";
				$emailheader.= "<td align='center'>:</td>";
				$emailheader.= "<td><b>$detil[hp]</b></td>";
				$emailheader.= "</tr>";
				$emailheader.= "</table>";
				$emailheader.= "</div>";

				$emaildetail.="<div align='left'>Hi <b>".ucwords($detil['nama'])."</b>.<br>Pembayaran atas nama <b>".$siapa."</b> untuk pembelian tiket <b>$judul</b> di <b>$di</b> Tanggal <b>$tanggal</b>  telah Kami terima.<br>";
				$emaildetail.="Berikut data pembelian tiket :";
				$emaildetail.= "<div align='left'>";
				$emaildetail.= "<table>";
				$emaildetail.= "<tr>";
				$emaildetail.= "<td rowspan='3'><img src='".$base."uploads/qr/item-".$detil['id_order']."-".$idx.".png'></td>";
				$emaildetail.= "<td width='100'>Nama</td>";
				$emaildetail.= "<td width='10' align='center'>:</td>";
				$emaildetail.= "<td><b>$detil[nama]</b></td>";
				$emaildetail.= "</tr><tr><td>Email</td>";
				$emaildetail.= "<td align='center'>:</td>";
				$emaildetail.= "<td><b>$detil[email]</b></td>";
				$emaildetail.= "</tr><tr><td>HP/WA</td>";
				$emaildetail.= "<td align='center'>:</td>";
				$emaildetail.= "<td><b>$detil[hp]</b></td>";
				$emaildetail.= "</tr>";
				$emaildetail.= "</table>";
				$emaildetail.= "</div></div>";
				$emaildetail.= "Terimakasih telah melakukan pembelian tiket melalui <b><a href='".base_url()."'>SimplyAuthentic.ID</a></b><br>*Jangan Hapus Pesan ini Gunakan QR Code untuk tiket masuk pada Event <b>$judul $di $tanggal</b>";
				$emd['data'] = $emaildetail;
				$pesand = $this->load->view('front/email-template',$emd,TRUE);

				$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
				//$this->email->from("info@simplyauthentic.id", 'Simply Authentic');
				$this->email->to($detil['email']);
				$this->email->subject('Simply Authentic : Pembelian Tiket '.$judul.' '.$tanggal.' '.$di);
				$this->email->message($pesand);
				@$se = $this->email->send();
				if(!$se){
					$ret['message'].=" Gagal kirim email detail : ".$detail['email']."<br>";
				}
			}}
			$emailheader.="</div>Terimakasih telah melakukan pembelian tiket melalui <b><a href='".base_url()."'>SimplyAuthentic.ID</a></b>";
			$em['data'] = $emailheader;
			$pesan = $this->load->view('front/email-template',$em,TRUE);


			$this->email->initialize($config);
			$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
			//$this->email->from("info@simplyauthentic.id", 'Simply Authentic');
			$this->email->to($member['email']);
			$this->email->subject('Simply Authentic : Pembelian Tiket '.$judul.' '.$tanggal.' '.$di);
			$this->email->message($pesan);
			@$se = $this->email->send();
			if(!$se){
				$ret['message'].=" Gagal kirim email Header : ".$member['email']."<br>";
			}
			$ret['message'].=" Berhasil kirim ulang email notifikasi pembayaran";

		}


		echo json_encode($ret);

	}
	public function orderdetil(){
		$id = $_POST['iod'];
		$ret['status'] = "true";
		$ret['html'] = "";
		$ord = $this->model_global->get_data(array('data' => 'row','table' => 'order', 'where' => array('id_order' => $id)));
		$tiket = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('id_ticket' => $ord['id_ticket'])));
		$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('id_member' => $ord['id_member'])));
		$bank = $this->model_global->get_data(array('data' => 'row','table' => 'doku_payment_channel', 'where' => array('code' => $ord['PAYMENTCHANNEL'])));
		if($ord['paid']=="1"){
			$resend = "<button class='btn btn-md btn-success resendemail' data-order='$ord[id_order]'><i class='fa fa-envelope'></i> Resend Email</button>";
		}else{
			$resend = "";
		}
		$html="
			<table class='table'>
				<tr>
					<th width='100'>Event</th><td colspan='3'>$tiket[judul] | Di : $tiket[dimana]</td>
				</tr>
				<tr>
					<th>Nama</th><td>$member[fullname]</td>
					<th>Email</th><td>$member[email]</td>
				</tr>
				<tr>
					<th>HP</th><td>$member[hp]</td>
					<th>Qty</th><td>$ord[qty]</td>
				</tr> 
				<tr>
					<th>Create Date</th><td>$ord[created_date]</td>
					<th>Request Date</th><td>$ord[request_pay]</td>
				</tr> 
				<tr>
					<th>Tgl. Bayar</th><th>$ord[paid_date]</th>
					<th>Expired Date</th><td>$ord[expired_pay]</td>
				</tr> 
				<tr>
					<th>Bank</th><td>$bank[description]</td>
					<th>Payment Code</th><td>$ord[PAYMENTCODE]</td>
				</tr> 
				<tr>
					<th>Harga</th><td>Rp. ".number_format($tiket['harga'])."</td>
					<th>Total</th><td>Rp. ".number_format($ord['total'])."</td>
				</tr>
				<tr>
					<th>Sub Total</th><th>Rp. ".number_format($ord['AMOUNT'])."</th>
					<th></th><td></td>
				</tr>
			</table>
			$resend<br><br><div id='statusresend'></div>
		";
		$headp="";
		$itemp="";
		if($ord['paid']=="1"){
			$headp="<th width='100'>Resend WA</th>";
		}
		$html.="
		<table class='table table-striped table-bordered table-hover'>
			<tr>
				<th width='10'>No</th>
				<th width='80'>QR</th>
				<th>Nama</th>
				<th width='150'>Email</th>
				<th width='150'>HP/WA</th>
				$headp
			</tr>";
		$p = $this->model_global->get_data(array('select' => '*', 'table' => 'orderdetail','where' => array('id_order'=>$ord['id_order']), 'order_by' => 'id_orderdetail desc'));
		$no = 1;
		foreach($p as $pp){
		if($ord['paid']=="1"){
			$itemp="<td align='center'>
				<button class='btn btn-sm btn-success btn-block resendwatext' data-order='$pp[id_orderdetail]'><i class='fa fa-whatsapp'></i> Text</button>
				<button class='btn btn-sm btn-success btn-block resendwaqr' data-order='$pp[id_orderdetail]'><i class='fa fa-whatsapp'></i> QR</button>
			</td>";

		}
			$html.="
				<tr>
					<td align='center'>$no</td>
					<td align='center'><a href='".base_url()."uploads/qr/item-$ord[id_order]-$pp[idx].png' target='_blank'><img src='".base_url()."uploads/qr/item-$ord[id_order]-$pp[idx].png' class='img-responsive'></a></td>
					<td>$pp[nama]</td>
					<td>$pp[email]</td>
					<td>0$pp[hp]</td>
					$itemp
				</tr>
			";
			$no++;
		}
		$html.="
		</table>
		";
		$ret['html'].= $html;

		echo json_encode($ret);
	}
	public function ordershow(){
		$idticket = $_GET['ticket'];
		$type = $_GET['type'];
		$where = array();
		switch($type){
			case "all":
				$where = array('a.PAYMENTCODE !='=>'','a.id_ticket'=>$idticket);
				$judul = "ALL ORDER";
			break;
			case "paid":
				$where = array('a.PAYMENTCODE !='=>'','a.id_ticket'=>$idticket,'a.paid'=>1);
				$judul = "ORDER PAID";
			break;
			case "pending":
				$where = array('a.PAYMENTCODE !='=>'','a.id_ticket'=>$idticket,'a.paid !='=>0,'a.expired_pay >='=>date('Y-m-d H:i:s'));
				$judul = "ORDER PENDING";
			break;
			case "expired":
				$where = array('a.PAYMENTCODE !='=>'','a.id_ticket'=>$idticket,'a.paid !='=>1,'a.expired_pay <='=>date('Y-m-d H:i:s'));
				$judul = "ORDER EXPIRED";
			break;
		}
		$this->template['ticket'] = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' => $idticket)));
		$this->template["judul"] = $judul." - ".$this->template['ticket']['judul'];
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['order'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname,b.email,hp,c.description bank',
			'table' => 'order a',
			'join' => array('member b','b.id_member = a.id_member'),
			'join2' => array('doku_payment_channel c','c.code = a.PAYMENTCHANNEL'),
			'where' => $where,
			'order_by' => 'a.id_ticket desc'
		));
		$this->render('ordershow');
	}
	public function order(){
		$this->template["judul"] = "Order";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['tiket'] = $this->model_global->get_data(array('select' => '*', 'table' => 'ticket','where' => array('status' =>1), 'order_by' => 'id_ticket desc'));
		if(isset($_GET['n'])){
			$this->template['tiket'] = $this->model_global->get_data(array(
				'select' => 'a.*,b.nama,b.mallid,b.sharedkey',
				'table' => 'ticket a',
				'join' => array('eo b','b.id_eo = a.id_eo'),
				'where' => array('a.status'=>0),
				'order_by' => 'a.tanggal asc'
			));
		}else{
			$this->template['tiket'] = $this->model_global->get_data(array(
				'select' => 'a.*,b.nama,b.mallid,b.sharedkey',
				'table' => 'ticket a',
				'join' => array('eo b','b.id_eo = a.id_eo'),
				'where' => array('a.status'=>1),
				'order_by' => 'a.tanggal asc'
			));

		}
		$this->render('order');
	}
	public function historypointajax(){
		$search = isset($_POST['search']['value']) ? $this->db->escape_like_str($_POST['search']['value']) : '';
		$limit = (int) (isset($_POST['length']) ? $_POST['length'] : 10);
		$start = (int) (isset($_POST['start']) ? $_POST['start'] : 0);
		$order_field = isset($_POST['order'][0]['column']) ? (int) $_POST['order'][0]['column'] : 0;
		$order_ascdesc = (isset($_POST['order'][0]['dir']) && strtoupper($_POST['order'][0]['dir']) === 'ASC') ? 'ASC' : 'DESC';
		$order_col = isset($_POST['columns'][$order_field]['data']) ? $_POST['columns'][$order_field]['data'] : 'id_point';
		$order_col = in_array($order_col, array('no','id_point','member','email','hp','nama_point','pts','created_date'), true) ? $order_col : 'id_point';
		$order = " ORDER BY a." . $order_col . " " . $order_ascdesc;

		$where_like = "(b.fullname LIKE '%" . $search . "%' OR b.email LIKE '%" . $search . "%' OR b.hp LIKE '%" . $search . "%' OR c.nama_point LIKE '%" . $search . "%' OR a.created_date LIKE '%" . $search . "%')";

		// recordsTotal: total row point (tanpa load semua ke memori)
		$r = $this->db->query("SELECT COUNT(*) as n FROM point a")->row_array();
		$sql_count = (int) $r['n'];

		// recordsFiltered: count dengan filter search (tanpa load semua ke memori)
		$r2 = $this->db->query("SELECT COUNT(*) as n FROM point a
			LEFT JOIN member b ON b.id_member = a.id_member
			LEFT JOIN jenis_point c ON c.id_jenis_point = a.id_jenis_point
			WHERE " . $where_like)->row_array();
		$sql_filter_count = (int) $r2['n'];

		// Hanya ambil satu halaman data
		$sqlquery = "SELECT @NUM:=@NUM + 1 AS no, a.*, b.fullname AS member, b.email, b.hp, c.nama_point, c.pts
			FROM point a
			LEFT JOIN member b ON b.id_member = a.id_member
			LEFT JOIN jenis_point c ON c.id_jenis_point = a.id_jenis_point
			, (SELECT @NUM:=0) A
			WHERE " . $where_like . $order . " LIMIT " . $limit . " OFFSET " . $start;
		$data = $this->db->query($sqlquery)->result_array();

		$callback = array(
			'draw' => isset($_POST['draw']) ? (int) $_POST['draw'] : 0,
			'recordsTotal' => $sql_count,
			'recordsFiltered' => $sql_filter_count,
			'data' => $data
		);
		header('Content-Type: application/json');
		echo json_encode($callback);
	}
	public function historypoint(){
		$this->template["judul"] = "History Point";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		// Data di-load via DataTables AJAX (historypointajax), jangan load semua row ke memori
		$this->template['data'] = array();
		$this->render('historypoint');
	}

	public function point(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Point";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'jenis_point', 'order_by' => 'id_jenis_point asc'));
		$this->render('point');
	}
	public function point_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Point";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Point";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'jenis_point', 'where' => array( 'id_jenis_point' => $_GET['_id'])));
		}
		$this->render('point-new');
	}
	public function eo(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "EO";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'eo','where' => array('status !=' => -1), 'order_by' => 'nama asc'));
		$this->render('eo');
	}
	public function eo_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert EO";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit EO";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'eo', 'where' => array('status !=' => -1, 'id_eo' => $_GET['_id'])));
		}
		$this->render('eo-new');
	}
	public function kategori(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Kategori";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status !=' => -1), 'order_by' => 'head_kategori asc'));
		$this->render('kategori');
	}
	public function kategori_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Insert Kategori";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Kategori";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'kategori', 'where' => array('status !=' => -1, 'id_kategori' => $_GET['_id'])));
		}
		$this->render('kategori-new');
	}
	public function designcompetition(){
		$this->template["judul"] = "Poster Challenge";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member,b.address as memberalamat,b.email as memberemail',
			'table' => 'designcompetition a',
			'join' => array('member b','b.id_member = a.id_member'),
			'where' => array('a.status !='=>-1,'a.id_member !='=>"1"),
			'order_by' => 'a.id_designcompetition desc'
		));
		$this->render('designcompetition');
	}
	public function designcompetition_new(){
		$this->template["judul"] = "Insert Poster Challenge";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Poster Challenge";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'designcompetition', 'where' => array('status !=' => -1, 'id_designcompetition' => $_GET['_id'])));
			$this->template['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('id_member' => $this->template['data']['id_member'])));

		}
		$this->render('designcompetition-new');
	}
	public function newcampaign(){
		$this->template["judul"] = "New Campaign";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member,b.address as memberalamat,b.email as memberemail',
			'table' => 'newcampaign a',
			'join' => array('member b','b.id_member = a.id_member'),
			'where' => array('a.status !='=>-1,'a.id_member !='=>"1"),
			'order_by' => 'a.id_newcampaign desc'
		));
		$this->render('newcampaign');
	}
	public function newcampaign_new(){
		$this->template["judul"] = "Insert New Campaign";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit New Campaign";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'newcampaign', 'where' => array('status !=' => -1, 'id_newcampaign' => $_GET['_id'])));
			$this->template['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('id_member' => $this->template['data']['id_member'])));

		}
		$this->render('newcampaign-new');
	}
	public function posterchallenge(){
		$this->template["judul"] = "Poster Challenge";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member',
			'table' => 'posterchallenge a',
			'join' => array('member b','b.id_member = a.created_by'),
			'where' => array('a.status !='=>-1,'a.created_by !='=>"1"),
			'order_by' => 'a.id_posterchallenge desc'
		));
		$this->render('posterchallenge');
	}
	public function posterchallenge_new(){
		$this->template["judul"] = "Insert Poster Challenge";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Poster Challenge";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array('status !=' => -1, 'id_posterchallenge' => $_GET['_id'])));
			$this->template['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('id_member' => $this->template['data']['created_by'])));

		}
		$this->render('posterchallenge-new');
	}
	public function soundroom_2022(){
		$this->template["judul"] = "Soundroom";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member',
			'table' => 'soundroom a',
			'join' => array('member b','b.id_member = a.created_by'),
			'where' => array('a.status !='=>-1,'a.created_by !='=>"1"),
			'order_by' => 'a.votes desc'
		));
		$this->template['data3'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member',
			'table' => 'soundroom a',
			'join' => array('member b','b.id_member = a.created_by'),
			'where' => array('a.status !='=>-1,'a.created_by !='=>"1","a.top3"=>"1"),
			'order_by' => 'a.votes5 desc'
		));
		$this->render('soundroom');
	}
	public function soundroom_2019(){
		$this->template["judul"] = "Soundroom 2019";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member',
			'table' => 'soundroom_2019 a',
			'join' => array('member b','b.id_member = a.created_by'),
			'where' => array('a.status !='=>-1,'a.created_by !='=>"1"),
			'order_by' => 'a.votes desc'
		));
		$this->template['data5'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member',
			'table' => 'soundroom a',
			'join' => array('member b','b.id_member = a.created_by'),
			'where' => array('a.status !='=>-1,'a.created_by !='=>"1","a.top5"=>"1"),
			'order_by' => 'a.votes5 desc'
		));
		$this->render('soundroom_2019');
	}
    public function soundroom_2023(){
        $this->template["judul"] = "Soundroom 2023";
        $this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
        $this->template['data'] = $this->model_global->get_data(array(
            'select' => 'a.*,b.fullname as member',
            'table' => 'soundroom_2023 a',
            'join' => array('member b','b.id_member = a.created_by'),
            'where' => array('a.status !='=>-1,'a.created_by !='=>"1"),
            'order_by' => 'a.votes desc'
        ));
        $this->template['data3'] = $this->model_global->get_data(array(
            'select' => 'a.*,b.fullname as member',
            'table' => 'soundroom_2023 a',
            'join' => array('member b','b.id_member = a.created_by'),
            'where' => array('a.status !='=>-1,'a.created_by !='=>"1","a.top3"=>"1"),
            'order_by' => 'a.rank asc'
        ));
        $this->render('soundroom_2023');
    }
    
	public function soundroom_2024(){
        $this->template["judul"] = "Soundroom 2024";
        $this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
        $this->template['data'] = $this->model_global->get_data(array(
            'select' => 'a.*,b.fullname as member',
            'table' => 'soundroom_2024 a',
            'join' => array('member b','b.id_member = a.created_by'),
            'where' => array('a.status !='=>-1,'a.created_by !='=>"1"),
            'order_by' => 'a.votes desc'
        ));
        $this->template['data3'] = $this->model_global->get_data(array(
            'select' => 'a.*,b.fullname as member',
            'table' => 'soundroom_2024 a',
            'join' => array('member b','b.id_member = a.created_by'),
            'where' => array('a.status !='=>-1,'a.created_by !='=>"1","a.top3"=>"1"),
            'order_by' => 'a.rank asc'
        ));
        $this->render('soundroom_2024');
    }
	public function soundroom_2025(){
        $this->template["judul"] = "Soundroom 2025";
        $this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
        $this->template['data'] = $this->model_global->get_data(array(
            'select' => 'a.*,b.fullname as member',
            'table' => 'soundroom_2025 a',
            'join' => array('member b','b.id_member = a.created_by'),
            'where' => array('a.status !='=>-1,'a.created_by !='=>"1"),
            'order_by' => 'a.votes desc'
        ));
        $this->template['data3'] = $this->model_global->get_data(array(
            'select' => 'a.*,b.fullname as member',
            'table' => 'soundroom_2025 a',
            'join' => array('member b','b.id_member = a.created_by'),
            'where' => array('a.status !='=>-1,'a.created_by !='=>"1","a.top10"=>"1"),
            'order_by' => 'a.rank asc'
        ));
        $this->render('soundroom_2025');
    }
	public function soundroom_new(){
		$this->template["judul"] = "Insert Soundroom";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
            $table = 'soundroom';

            if (isset($_GET['_year']) && $_GET['_year'] == '2023') {
                $table = 'soundroom_2023';
            } elseif (isset($_GET['_year']) && $_GET['_year'] == '2024') {
                $table = 'soundroom_2024';
            }  elseif (isset($_GET['_year']) && $_GET['_year'] == '2025') {
                $table = 'soundroom_2025';
            }

			$this->template["judul"] = "Edit Soundroom";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => $table, 'where' => array('status !=' => -1, 'id_soundroom' => $_GET['_id'])));
			$this->template['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('id_member' => $this->template['data']['created_by'])));

		}
		$this->render('soundroom-new');
	}

	public function soundroomcek(){

		$kota = "ALL";
		if(isset($_POST['kota']) && $_POST['kota']!="ALL" && $_POST['kota']!=""){
			$where['b.id_kota']=$_POST['kota'];
			$kota = $_POST['kota'];
		}
		if(isset($_POST['start']) && $_POST['start']!='ALL'){
			$next = ($_POST['end']=='ALL') ? 1 : $_POST['end'] + 1;
			$paging = "12,".($next -1) * 12;
		}else{
			$next = 1;
			$paging = "12,0";
		}

		$arr_kota = [];
		if(isset($_POST['search'])){
			$prov = $_POST['id'];

			$this->db->order_by('kota asc');
			$cari_kota = $this->db->get_where('kota', array('provinsi'=>$prov));
			if($cari_kota->num_rows()>0){
				foreach($cari_kota->result() as $key=>$dt){
					$arr_kota[] = $dt->id_kota;
				}
			}
		}

		if(isset($_POST['kota']) && $_POST['kota']!="ALL" && $_POST['kota']!=""){
			$arr_kota[] = $_POST['kota'];
		}

		$this->db->select('s.*, k.kota, k.provinsi');
		$this->db->from('soundroom s');
		$this->db->join('kota k', 'k.id_kota = s.id_kota');
		if(count($arr_kota)>0){
			$this->db->where_in('s.id_kota', $arr_kota);
		}
		$this->db->where('s.approve', 1);
		$this->db->where('s.status', 1);
		$this->db->order_by('s.top3 desc');
		$soundroom = $this->db->get()->result_array();

		$status_exist = isset($_GET['exist'])? $_GET['exist']:'all';
		echo 'file exist: '.$status_exist.'<br /><br />';

		$no = 1;
		foreach($soundroom as $key=>$data){
			$path_sound = "uploads/soundroom/".$data['sound'];
			$url_sound = '<a href="'.base_url().'uploads/soundroom/'.$data['sound'].'">'.$data['sound'].'</a>';
			$exist = 'no';
			$exist_info = '[NO] -- ';
			if( file_exists( $path_sound ) ){
				$exist = 'yes';
				$exist_info = '';
			}

			if($status_exist=='all'){
				echo $no.'. '.$exist_info.'  '.$data['judul'].' :: '.$url_sound;
				echo '<br />';
				$no++;
			}else{
				if($status_exist==$exist){
					echo $no.'. '.$exist_info.'  '.$data['judul'].' :: '.$url_sound;
					echo '<br />';
					$no++;
				}
			}

		}
		die();
	}

	public function write(){
		$this->template["judul"] = "Member's Article";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategoria,b.head_kategori,c.fullname as member',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'join2' => array('member c','c.id_member = a.created_by'),
			'where' => array('a.status !='=>-1,'a.created_by !='=>"1"),
			'order_by' => 'a.id_artikel desc'
		));
		$this->render('write');
	}
	public function write_new(){
		$this->template["judul"] = "Insert Member's Article";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['kategori'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'nama asc'));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Member's Article";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('status !=' => -1, 'id_artikel' => $_GET['_id'])));
			$this->template['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('id_member' => $this->template['data']['created_by'])));

		}
		$this->render('write-new');
	}
	public function artikel(){
		$head = isset($_GET['k']) ? $_GET['k'] : 'music';
		if (!isset($this->template['headkategori'][$head])) {
			$keys = is_array($this->template['headkategori']) ? array_keys($this->template['headkategori']) : array();
			$head = !empty($keys) ? $keys[0] : 'music';
		}
		$this->template['k'] = $head;
		$this->template["judul"] = $this->template['headkategori'][$head];
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategoria,b.head_kategori',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status !='=>-1,'b.head_kategori'=>$head,'a.created_by'=>"1"),
			'order_by' => 'a.id_artikel desc'
		));
		$this->render('artikel');
	}
	public function artikel_new(){
		$head = isset($_GET['k']) ? $_GET['k'] : 'music';
		if (!isset($this->template['headkategori'][$head])) {
			$keys = is_array($this->template['headkategori']) ? array_keys($this->template['headkategori']) : array();
			$head = !empty($keys) ? $keys[0] : 'music';
		}
		$this->template['k'] = $head;
		$this->template["judul"] = "Insert ".$this->template['headkategori'][$head];
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['kategori'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1,'head_kategori'=>$head), 'order_by' => 'nama asc'));
		$this->template['kontributor'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kontributor','where' => array('status' => 1), 'order_by' => 'nama asc'));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit".$this->template['headkategori'][$head];
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('status !=' => -1, 'id_artikel' => $_GET['_id'])));
		}
		$this->render('artikel-new');
	}
	public function redeempoint(){
		$this->template["judul"] = "Redeem Point";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*',
			'table' => 'redeempoint a',
			//'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status !='=>-1),
			'order_by' => 'a.id_redeempoint desc'
		));
		$this->render('redeempoint');
	}
	public function redeempoint_new(){
		$this->template["judul"] = "Insert Redeem Point";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Redeem Point";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'redeempoint', 'where' => array('status !=' => -1, 'id_redeempoint' => $_GET['_id'])));
		}
		$this->render('redeempoint-new');
	}
	public function kontributor(){
		$this->template["judul"] = "Kontributor";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*',
			'table' => 'kontributor a',
			//'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status !='=>-1),
			'order_by' => 'a.id_kontributor desc'
		));
		$this->render('kontributor');
	}
	public function kontributor_new(){
		$this->template["judul"] = "Insert Kontributor";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit Kontributor";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'kontributor', 'where' => array('status !=' => -1, 'id_kontributor' => $_GET['_id'])));
		}
		$this->render('kontributor-new');
	}
	public function memberajax(){
		if(isset($_GET['n'])){
			$ac = " and active!=1";
		}else{
			$ac = " and active=1";
		}
		$ac.= " and id_member !=1";
		$search = strtolower($_POST['search']['value']);
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$sql = $this->db->query("SELECT * from member  where status!='-1' $ac")->result_array();
		$sql_count = count($sql);
		$order_field = $_POST['order'][0]['column'];
		$order_ascdesc = $_POST['order'][0]['dir'];
		$order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;
		$sqlquery = "SELECT  @NUM:=@NUM + 1 AS no,member.* FROM member , (SELECT @NUM:=0)A where status!='-1'
			and (fullname LIKE '%".$search."%' or email LIKE '%".$search."%' or hp LIKE '%".$search."%' or address LIKE '%".$search."%') $ac";

		$embel = $order." LIMIT ".$limit." OFFSET ".$start;
		$query = $this->db->query($sqlquery)->result_array();
		$querydata = $this->db->query($sqlquery.$embel)->result_array();
		$sql_filter_count = count($query);
		$data = $querydata;
		$callback = array(
			'draw'=>$_POST['draw'],
			'recordsTotal'=>$sql_count,
			'recordsFiltered'=>$sql_filter_count,
			'data'=>$data
		);
		header('Content-Type: application/json');
		echo json_encode($callback);

	}
	public function membercek(){
		$qm = $this->db->query("select id_member from member where email='".$_GET['email']."'")->result_array();
		$idm =  $qm[0]['id_member'];
		$query = $this->db->query("select sum(b.pts) as total from point a left join jenis_point b on b.id_jenis_point = a.id_jenis_point where a.id_member='".$idm."'")->result_array();
		$total1 =  $query[0]['total'];
		$query2 = $this->db->query("select sum(point) as total from redeemmember where id_member='".$idm."'")->result_array();
		$total2 =  $query2[0]['total'];

		$query3 = $this->db->query("select sum(point) as total from pointacak  where  id_member='".$idm."'")->result_array();
		$total3 =  $query3[0]['total'];

		$query4 = $this->db->query("select count(id_member) as total from pointband  where  id_member='".$idm."'")->result_array();
		$jum = $this->model_global->get_data(array('data' => 'row','table' => 'jenis_point','where' => array( 'id_jenis_point' =>'27')));
		$total4 =  $query4[0]['total'] * $jum['pts'];


		$total_point1 = ($total1 + $total3 + $total4);
		$total_point2 = $total_point1 - $total2 ;
		echo "Total akhir :". $total_point2."<br>";
		echo "Total tanpa redeem :". $total_point1;
	}
	public function hapuspoint(){
		$id = $_POST['iod'];
		$ret['status'] = "true";
		$ret['message'] = "";
		$point = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array( 'id_point' =>$id)));
		if(count($point)==0){
			$ret['status'] = "false";
			$ret['message'] = "Point Tidak ada";
		}else{
			$this->db->delete("point", array('id_point' => $id));
			$ret['status'] ="true";
		}


		echo json_encode($ret);

	}
	public function hapusredeem(){
		$id = $_POST['iod'];
		$ret['status'] = "true";
		$ret['message'] = "";
		$redeem = $this->model_global->get_data(array('data' => 'row','table' => 'redeemmember', 'where' => array( 'id_redeemmember' =>$id)));
		if(count($redeem)==0){
			$ret['status'] = "false";
			$ret['message'] = "Redeem Tidak ada";
		}else{
			$this->db->delete("redeemmember", array('id_redeemmember' => $id));
			$ret['status'] ="true";
		}


		echo json_encode($ret);

	}

	public function tracking(){
		$this->template['data'] = array();
		$this->template["judul"] = "Tracking Point";
		$this->template['message']="";
		if(isset($_POST['email'])){
			$member = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('email' => $_POST['email'])));
			if(count($member)==0){
				$this->template['message'] = "Data tidak ada";
			}else{
				$this->template['data'] = $this->model_global->get_data(array(
					'select' => 'a.id_point,b.fullname,b.email,c.pts,c.nama_point,a.created_date,a.id_jenis_point,a.id_resource,b.id_member',
					'table' => 'point a',
					'join' => array('member b','b.id_member = a.id_member'),
					'join2' => array('jenis_point c','c.id_jenis_point = a.id_jenis_point'),
					'where' => array('b.email'=>$_POST['email']),
					'order_by' => 'a.created_date desc'
				));
				$this->template['dataredeem'] = $this->model_global->get_data(array(
					'select' => 'a.point,b.nama,a.created_date,a.id_redeemmember',
					'table' => 'redeemmember a',
					'join' => array('redeempoint b','b.id_redeempoint = a.id_redeempoint'),
					'where' => array('a.id_member'=>$member['id_member']),
					'order_by' => 'a.created_date desc'
				));
				$query = $this->db->query("select sum(b.pts) as total from point a left join jenis_point b on b.id_jenis_point = a.id_jenis_point where a.id_member='".$member['id_member']."' and a.id_jenis_point!=27  and a.id_jenis_point!=12 ")->result_array();
				$total1 =  $query[0]['total'];
				$query2 = $this->db->query("select sum(point) as total from redeemmember where id_member='".$member['id_member']."'")->result_array();
				$total2 =  $query2[0]['total'];

				$query3 = $this->db->query("select sum(point) as total from pointacak  where  id_member='".$member['id_member']."'")->result_array();
				$total3 =  $query3[0]['total'];

				$query4 = $this->db->query("select count(id_member) as total from pointband  where  id_member='".$member['id_member']."'")->result_array();
				$jum = $this->model_global->get_data(array('data' => 'row','table' => 'jenis_point','where' => array( 'id_jenis_point' =>'27')));
				$total4 =  $query4[0]['total'] * $jum['pts'];


				$total_point = ($total1 + $total3 + $total4)- 0 ;


				$totalall = $total1 + $total3 + $total4;
				$this->template['acak']=$total3;
				$this->template['band']=$total4;

				$this->template['total_point']=$total_point;
				$this->template['totalredeem']=$total2;
				$this->template['total2']=$total_point - $total2;

			}
		}
		$this->render('tracking');
	}
	public function member(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		if(isset($_GET['n'])){
			$this->template["n"] = "?n=1";
			$this->template["judul"] = "Member - Non Aktif";
			$this->template['data'] = $this->model_global->get_data(array(
				'select' => 'a.*',
				'table' => 'member a',
				//'join' => array('kota b','b.id_kota = a.id_kota'),
				'where' => array('active !='=>1,'a.status !='=>-1,'a.id_member !='=>"1"),
				'order_by' => 'a.id_member desc'
			));
		}else{
			$this->template["n"] = "";
			$this->template["judul"] = "Member - Aktif";
			$this->template['data'] = $this->model_global->get_data(array(
				'select' => 'a.*',
				'table' => 'member a',
				//'join' => array('kota b','b.id_kota = a.id_kota'),
				'where' => array('active'=>1,'a.status !='=>-1,'a.id_member !='=>"1"),
				'order_by' => 'a.id_member desc'
			));

		}
		$this->render('memberajax');
	}
	public function memberold(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Old Member";
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*',
			'table' => 'member_old a',
			'order_by' => 'oo_id desc'
		));
		$this->render('memberold');
	}
	public function user(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "User CMS";
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => '',
			'table' => 'user a',
			//'join' => array('user b','b.id_user = a.id_user'),
			'where' => array('status !='=>-1),
			'order_by' => 'id_user desc'
		));
		$this->render('user');
	}
	public function user_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "User CMS Baru";
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit User CMS";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'user', 'where' => array('status !=' => -1, 'id_user' => $_GET['_id'])));
		}
		$this->render('user-new');
	}
	public function usersp(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "User Sales Promotion";
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.judul tiket',
			'table' => 'usersp a',
			'join' => array('ticket b','b.id_ticket = a.id_ticket'),
			'where' => array('a.status !='=>-1),
			'order_by' => 'a.id_usersp desc'
		));
		$this->render('usersp');
	}
	public function usersp_new(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "User Sales Promotion Baru";
		$this->template['tiket'] = $this->model_global->get_data(array('select' => '*', 'table' => 'ticket', 'where' => array('status' => 1), 'order_by' => 'tanggal desc'));
		if(isset($_GET['_id']) && $_GET['_id'] != ''){
			$this->template["judul"] = "Edit User Sales Promotion";
			$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'usersp', 'where' => array('status !=' => -1, 'id_usersp' => $_GET['_id'])));
		}
		$this->render('usersp-new');
	}
	public function contact(){
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template["judul"] = "Kontak";
		$this->template['data'] = $this->model_global->get_data(array('select' => '*', 'table' => 'contact', 'order_by' => 'id_contact desc'));
		$this->render('contact');
	}
 	public function member_excel(){
		$d = date('Y-m-d');
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$this->excel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('Data Member');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Simply Authentic Member');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
		//$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Tanggal Dibuat');
		$objPHPExcel->getActiveSheet()->setCellValue('C2', $d);
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A5', "No")
		 ->setCellValue('B5', "Nama")
		 ->setCellValue('C5', "Email")
		 ->setCellValue('D5', "Hp")
		 ->setCellValue('E5', "Kota")
		 ->setCellValue('F5', "Alamat")
		 ->setCellValue('G5', "Tanggal Daftar");

		$dataArray= array();
		$no=0;
		$c = $this->model_global->get_data(array(
			'select' => 'a.*,b.kota,b.provinsi',
			'table' => 'member a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('status !='=>-1,'id_member !='=>"1"),
			'order_by' => 'id_member desc'
		));
		if(isset($c) && count($c) > 0): foreach($c as $row):

			$no++;
			$row_array['no'] = $no;
			$row_array['fullname'] = $row['fullname'];
			$row_array['email'] = $row['email'];
			$row_array['hp'] = $row['hp'];
			$row_array['kota'] = $row['provinsi'].", ".$row['kota'];
			$row_array['address'] = $row['address'];
			$row_array['date'] = $row['created_date'];
			array_push($dataArray,$row_array);
		endforeach; endif;
		//print_r($dataArray);
		//die();
		$nox=$no+5;
		$objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A6');


		$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->getFont()->setBold(true);
		// Set fills
		$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->getFill()->getStartColor()->setARGB('##000000');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30.00);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(100.00);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

		$sharedStyle1 = new PHPExcel_Style();
		$sharedStyle2 = new PHPExcel_Style();

		$sharedStyle1->applyFromArray(
		 array('borders' => array(
		 'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		 'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
		 'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
		 ),
		 ));

		$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A5:G$nox");
		$objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(27);
		// Set style for header row using alternative method
		$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->applyFromArray(
		 array(
		 'font' => array(
		 'bold' => true,
		 'color' => array('rgb' => 'FFFFFF')
		 ),
		 'alignment' => array(
		 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		 ),
		 'borders' => array(
		 'top' => array(
		 'style' => PHPExcel_Style_Border::BORDER_THIN
		 )
		 ),
		 'fill' => array(
		 'type' => PHPExcel_Style_Fill::FILL_SOLID,
		 'color' => array('rgb' => '000000')
		 )
		 )
		);

		$filename='Data_Member_'.$d.'.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
	public function contact_excel(){
		$d = date('Y-m-d');
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$this->excel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle('Data Contact');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Simply Authentic Member');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
		//$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Tanggal Dibuat');
		$objPHPExcel->getActiveSheet()->setCellValue('C2', $d);
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setCellValue('A5', "No")
		 ->setCellValue('B5', "Nama")
		 ->setCellValue('C5', "Pesan")
		 ->setCellValue('D5', "Email")
		 ->setCellValue('E5', "Tlp")
		 ->setCellValue('F5', "Date");

		$dataArray= array();
		$no=0;
		$c = $this->model_global->get_data(array('select' => '*', 'table' => 'contact','where' => array( 'status'=>1), 'order_by' => 'id_contact desc'));
		if(isset($c) && count($c) > 0): foreach($c as $row):

			$no++;
			$row_array['no'] = $no;
			$row_array['name'] = $row['name'];
			$row_array['message'] = $row['message'];
			$row_array['email'] = $row['email'];
			$row_array['phone'] = $row['phone'];
			$row_array['date'] = $row['created_date'];
			array_push($dataArray,$row_array);
		endforeach; endif;
		$nox=$no+5;
		$objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A6');


		$objPHPExcel->getActiveSheet()->getStyle('A5:F5')->getFont()->setBold(true);
		// Set fills
		$objPHPExcel->getActiveSheet()->getStyle('A5:F5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('A5:F5')->getFill()->getStartColor()->setARGB('##000000');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30.00);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(100.00);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

		$sharedStyle1 = new PHPExcel_Style();
		$sharedStyle2 = new PHPExcel_Style();

		$sharedStyle1->applyFromArray(
		 array('borders' => array(
		 'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		 'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		 'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
		 'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
		 ),
		 ));

		$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A5:F$nox");
		$objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(27);
		// Set style for header row using alternative method
		$objPHPExcel->getActiveSheet()->getStyle('A5:F5')->applyFromArray(
		 array(
		 'font' => array(
		 'bold' => true,
		 'color' => array('rgb' => 'FFFFFF')
		 ),
		 'alignment' => array(
		 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		 ),
		 'borders' => array(
		 'top' => array(
		 'style' => PHPExcel_Style_Border::BORDER_THIN
		 )
		 ),
		 'fill' => array(
		 'type' => PHPExcel_Style_Fill::FILL_SOLID,
		 'color' => array('rgb' => '000000')
		 )
		 )
		);

		$filename='Data_Contact_'.$d.'.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
	public function validate_slug($table, $column, $slug, $id = 0) {
		if ($id > 0)
			$this->db->where('id !=', $id);

		$this->db->where($column." REGEXP '^".$slug."(\-[0-9]+)?$'");

		$this->db->order_by($column, 'desc');
		$this->db->limit(1, 0);
		$res = $this->db->get($table);
		if ($res->num_rows() == 0) {
			return $slug;
		} else {
			$row = $res->row_array();
			$slug2 = $row[$column];
			preg_match('/^(.+)([0-9]+)$/', $slug2, $found);
			if (empty($found)) {
				return $slug.'-1';
			} else {
				return $slug.'-'.((int)$found[2]+1);
			}
		}
	}
	public function reroute() {
		$action = str_replace('-', '_', $this->uri->segment(3));
		// echo $action;
		// die();
		$c = $this->session->all_userdata();
			if (method_exists($this, $action)) {
				call_user_func_array(array($this, $action), array());
			} else {
				show_404();
			}
	}

}
/*
	$actual_link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	echo $actual_link;
	echo "<br>";
	$url = $_SERVER['REQUEST_URI'];
	$parts = explode('/',$url);
	$dir = $_SERVER['SERVER_NAME'];
	for ($i = 0; $i < count($parts) - 1; $i++) {
		$dir .= $parts[$i] . "/";
	}
	echo $dir;*/
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
