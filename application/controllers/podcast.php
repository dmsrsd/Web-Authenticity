<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Podcast extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->active_section = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1), 'order_by' => 'order_number asc'));;

	}
	public function index(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Ini Asli Gue";
		$data['kontributor'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kontributor','where' => array('status' => 1), 'order_by' => 'nama asc'));;
		$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori' => 4), 'order_by' => 'urutan asc'));
		$data['podcast'] = $this->model_global->get_data(array('select' => '*', 'table' => 'podcast','where' => array('status' => 1), 'order_by' => 'created_date desc'));
		$data['distrik_home'] = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('status' => 1, 'is_homevideo' => 1), 'limit' => 4, 'order_by' => 'id desc'));
		// $data['web_section'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('slug' => 'distrik-campaign','status' => 1)));
		
		// var_dump($data['web_section']); die();

		// $active_section = $this->active_section;
		//get detail campaign
		// $new_section = array();
		// if(isset($active_section)){
		// 	foreach($active_section as $section){
		// 		$campaign_home = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('status' => 1, 'is_homevideo' => 1,'section' => $section['id']), 'limit' => 4, 'order_by' => 'id desc'));
		// 		if(empty($campaign_home)){
		// 			$campaign_home = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('status' => 1, 'section' => $section['id']), 'limit' => 4, 'order_by' => 'id desc'));
		// 		}
		// 		if(!empty($campaign_home)){
		// 			$section['campaign_home'] = $campaign_home;
		// 		}
		// 		array_push($new_section,$section);
		// 	}
		// }

		//-- tambahan-revamp
			$limit = 6;
			$web_section = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_homepage'=>1), 'order_by'=>'order_number asc'));
			foreach($web_section as $key=>$row){
				$campaign_limit = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('section'=>$row['id'], 'status' => 1, 'is_homevideo'=>1), 'order_by'=>'urutan asc', 'limit'=>$limit));
				$web_section[$key]['campaign'] = $campaign_limit;
				$web_section[$key]['campaign_more'] = 'no';
				$campaign_all = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('section'=>$row['id'], 'status' => 1, 'is_homevideo'=>1), 'order_by'=>'urutan asc'));
				if( count($campaign_all) > $limit ){
					$web_section[$key]['campaign_more'] = 'yes';
				}
			}
			$data['web_section'] = $web_section;
			$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		//-- tambahan-revamp-end

		// $data['active_section'] = $new_section;
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/podcast/home',$data);
		$this->load->view('front/podcast/footerfp',$data);

	}

	public function merch(){
		redirect(base_url());
		die;
		//echo $this->datamember['id'];
		$data['website'] = $this->website;
		$data['subtitle'] = " | Ini Asli Gue";
		// $data['active_section'] = $new_section;	
		$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		
		$this->load->view('front/podcast/custome-header',$data);
		if(empty($this->datamember)){
			
			//redirect(base_url()."uploads/events/");
			$this->load->view('front/event-merch',$data);
		}else{
			redirect(base_url()."campaign-merchmember");
			die;
		}
		$this->load->view('front/podcast/footerfp',$data);

	}
	public function merch_member(){
		//echo $this->datamember['id'];
		$data['website'] = $this->website;
		$data['subtitle'] = " | Ini Asli Gue";
		// $data['active_section'] = $new_section;	
		$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		
		$this->load->view('front/podcast/custome-header',$data);
		if(empty($this->datamember)){			
			redirect(base_url()."campaign-merch");
			die;
		}else{
			// cek jumlah data event
			$data['data_silver'] = $this->db->query("SELECT COUNT(id_redeem_kotak) as total FROM `kotak_redeem` where nama_kotak='silver' and id_member='".$this->datamember['id']."'")->row_array();
			$data['data_redmax'] = $this->db->query("SELECT COUNT(id_redeem_kotak) as total FROM `kotak_redeem` where nama_kotak='redmax' and id_member='".$this->datamember['id']."'")->row_array();
			$data['data_purple'] = $this->db->query("SELECT COUNT(id_redeem_kotak) as total FROM `kotak_redeem` where nama_kotak='purple' and id_member='".$this->datamember['id']."'")->row_array();
			$data['cek_roulette'] = $this->db->query("SELECT COUNT(id_kotak_hadiah) as total FROM `kotak_hadiah` where id_member='".$this->datamember['id']."'")->row_array();
			// $data['cek_roulette'] = $this->model_global->get_data(array('select' => '*','table' => 'kotak_hadiah', 'where' => array( 'id_member' =>$this->datamember['id'])));
			$this->load->view('front/event-merch-login',$data);
		}
		$this->load->view('front/podcast/footerfp',$data);

	}

	public function naikkelas(){
		// var_dump('cek');
		$data['website'] = $this->website;
		$data['subtitle'] = " | Podcast";
		$data['kontributor'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kontributor','where' => array('status' => 1), 'order_by' => 'nama asc'));;
		$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori' => 4), 'order_by' => 'urutan asc', 'limit' => 1));
		// $data['podcast'] = $this->model_global->get_data(array('select' => '*', 'table' => 'podcast','where' => array('status' => 1), 'order_by' => 'urutan asc'));
		$list_podcast = $this->model_global->get_data(array('select' => '*', 'table' => 'podcast','where' => array('status' => 1), 'order_by' => 'season,urutan  asc'));
		$list_season = $this->db->query("SELECT DISTINCT season FROM podcast order BY season desc")->result_array();
		$new_list = array();
		foreach($list_season as $row){
			$new_list[$row['season']] = array();

		}


		$cat_season = '';
		$dum_list = array();
		foreach($list_podcast as $podcast){
			$cat_season = $podcast['season'];
			array_push($new_list[$cat_season],$podcast);
			$cat_season = $podcast['season'];
		}


		$data['podcast'] =$new_list;

		//--- tambahan-revamp	
			$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		//-- tambahan-revamp-end

		// $data['active_section'] = $this->active_section;
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/podcast/naikkelas',$data);
		$this->load->view('front/podcast/footerfp',$data);
	}

	public function acceptcookie(){
		@session_start();
		$ret["status"] = "false";
		$this->load->helper('string');
		 $_SESSION["cookie"] = random_string('alnum', 'abc123');
		// //$_SESSION["cookie"] = "";
		// if($_SESSION["cookie"]!=""){
		// 	$ret["status"] = "true";
		// }
		$this->session->set_userdata("cookie", random_string('alnum', 16));

		if($this->session->userdata("cookie") != ""){
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

	//--- tambahan revamp
		public function getMoreCampaign(){
			$ret['status'] = "false";
			$ret['message'] = "";
			if(isset($_POST['page'])){
				$get_section = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'slug'=>$_POST['section'])));
				if($get_section){
					$this_section = $get_section[0];
					$campaign_all = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('section'=>$this_section['id'], 'status' => 1, 'is_homevideo'=>1), 'order_by'=>'urutan asc'));
					
					$page = $_POST['page'];
					$limit = 6;
					$offset = $page * $limit;
					$campaign_limit = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('section'=>$this_section['id'], 'status' => 1, 'is_homevideo'=>1), 'order_by'=>'urutan asc', 'paging'=>$limit.','.$offset));
					$page_next = $page + 1;
					$page_total = ceil( count($campaign_all) / $limit );
					if($page_next >= $page_total){
						$page_next = 0;
					}
					// var_dump($limit, $offset); die();
					// var_dump($campaign_limit); die();
					
					if($campaign_limit){
						$ret['status'] = 'true';
						$ret['page_next'] = $page_next;
						$ret['data'] = '';
						foreach($campaign_limit as $vid){
							$ret['data'] .= '<div class="col-md-4 col-6">'.
												'<a href="https://www.youtube.com/watch?v='.$vid['youtube'].'" class="card card--video" data-fancybox>'.
													'<div class="card-body">'.
														'<div class="card-img">'.
															'<img src="'.base_url('uploads/districtcampaign/'.$vid['mini_banner']).'" alt="Youtube">'.
														'</div>'.
														'<p>'.$vid['campaign_name'].'</p>'.
													'</div>'.
												'</a>'.
											'</div>';
						}
					}
				}
			}
			echo json_encode($ret);
		}

}
