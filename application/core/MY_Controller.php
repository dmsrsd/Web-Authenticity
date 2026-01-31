<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
    public $template = array();
    public $is_auth = 0;
    public $userinfo = array();
    public $userinfosp = array();
    public $response;
    public $configApp;
	public $bulanarr = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	public $headkategori = array('music'=>'Classified Music','arts'=>'Classified Arts','culture'=>'Classified Culture');
	public $approve = array(''=>'Admin','0'=>'Waiting For Approval','1'=>'Approve','2'=>'Rejected');
	public $approvesong = array(''=>'Admin','0'=>'In curation process','1'=>'Approve','2'=>'Rejected');
	
	function __construct() {
		@session_start();
        parent::__construct();
		$c = $this->session->all_userdata();
		$this->cookie = (isset($_SESSION['cookie']) ? $_SESSION['cookie'] : "");;	
		$this->datamember = @$c["membersimply"];	
		$this->tipe = array('1'=>'Potongan Harga','2'=>'Diskon','3'=>'Free Ongkir');	
		$this->payment = array('0'=>'Waiting for payment','2'=>'Checking Payment','3'=>'Failed','4'=>'Success Payment','5'=>'Shipping Process');
		
        $this->configApp = $this->config->item("common");
        $this->template['document_root'] = $_SERVER['DOCUMENT_ROOT'];
      	$this->response = $this->session->flashdata('response');

      	if ($this->session->userdata('userinfo')) {
        	$this->userinfo = $this->session->userdata('userinfo');
      		log_message('debug', 'Found User Info on session: '.print_r($this->userinfo, TRUE));
          	$this->template['userinfo'] = $this->userinfo;
      	}
      	if ($this->session->userdata('userinfosp')) {
        	$this->userinfo = $this->session->userdata('userinfosp');
      		log_message('debug', 'Found User Info on session: '.print_r($this->userinfosp, TRUE));
          	$this->template['userinfosp'] = $this->userinfosp;
      	}
    	
		if ($this->session->flashdata('response')) {
			$this->response = $this->session->flashdata('response');
			$this->template['response'] = $this->response;
		}

        $this->template['title'] = 'WGaY | Admin';
        $this->template['active'] = 'home';
        $this->template['bulan'] = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $this->template['hari'] = array("","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
        $this->template['status'] = array('Tidak Aktif', 'Aktif');
        $this->template['buytype'] = array('Pre Order', 'Buy Now');
        $this->template['akses'] = array('1'=>'Admin Website', '2'=>'Sales Promotion');
        $this->template['group'] = array('1'=>'Admin Website', '2'=>'Content Writer');
		$this->template['headkategori'] = array('music'=>'Classified Music','arts'=>'Classified Arts','culture'=>'Classified Culture');
		$this->template['approve'] = array(''=>'Admin','0'=>'Waiting For Approval','1'=>'Approve','2'=>'Rejected');
        $this->template['jenistiket'] = array('1'=>'Moment', '2'=>'Fest');
		$active_section = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1), 'order_by' => 'order_number asc'));
		//get detail campaign
		$new_section = array();
		if(isset($active_section)){
			foreach($active_section as $section){
				$campaign_home = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('status' => 1, 'is_homevideo' => 1,'section' => $section['id']), 'limit' => 4, 'order_by' => 'id desc'));
				if(empty($campaign_home)){
					$campaign_home = $this->model_global->get_data(array('select' => '*', 'table' => 'district_campaign','where' => array('status' => 1, 'section' => $section['id']), 'limit' => 4, 'order_by' => 'id desc'));
				}
				if(!empty($campaign_home)){
					$section['campaign_home'] = $campaign_home;
				}
				array_push($new_section,$section);
			}
		}
		$array_podcast = array(
			'id' => null,
			'section_name' => 'PODCAST NAIK CLAS',
			'slug' => 'podcast',
			'url' => 'podcast',
			'mini_banner' => '',
			'landing_banner' => '',
			'show_at_homepage' => 0,
			'show_at_menu' => 1,
			'order_number' => 1,
			'status' => 1,
			'created_date' => null,
			'modified_date' => null
		);
		array_push($new_section,$array_podcast);
		$array_lab = array(
			'id' => null,
			'section_name' => 'AUTHENTICITY LAB',
			'slug' => 'lab',
			'url' => 'lab',
			'mini_banner' => '',
			'landing_banner' => '',
			'show_at_homepage' => 0,
			'show_at_menu' => 1,
			'order_number' => 4,
			'status' => 1,
			'created_date' => null,
			'modified_date' => null
		);
		array_push($new_section,$array_lab);
		array_multisort(array_column($new_section, 'order_number'), SORT_DESC, $new_section);
		$data['active_section'] = $new_section;
		$this->load->vars($data);
	}

    public function namadate($tgl){
		$pisah = explode("-",$tgl);
		return $pisah[2]." ".$this->bulanarr[$pisah[1]*1]." ".$pisah[0];
	}
    public function fullnamadate($tgl){
		$pisah1 = explode(" ",$tgl);
		$pisah = explode("-",$pisah1[0]);
		return $pisah[2]." ".$this->bulanarr[$pisah[1]*1]." ".$pisah[0]." ".$pisah1[1];
	}
    public function render_popup($view){
        $this->load->view('header_popup', $this->template);
        $this->load->view($view, $this->template);
        $this->load->view('footer_popup', $this->template);
	}
    public function render($view){
        $this->load->view('header', $this->template);
        $this->load->view($view, $this->template);
        $this->load->view('footer', $this->template);
    }
    public function rendersp($view){
        $this->load->view('sp/header-sp', $this->template);
        $this->load->view($view, $this->template);
        //$this->load->view('sp/footer-sp', $this->template);
    }
	public function money_format($nilai,$koma="0"){
		$form = number_format($nilai,$koma,"",".");
		return $form.",-";
	}
    function reArrayFiles(&$file_post) {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
          foreach ($file_keys as $key) {
              $file_ary[$i][$key] = $file_post[$key][$i];
          }
        }

        return $file_ary;
    }
    public function upload_foto($file,$folder,$thumb=FALSE,$thumb_width){
    	$file_image = "";

    	//$upload_dir = $this->config->item('upload_path');
    	$upload_dir = "uploads/";
		
		$FILE_MIMES = array('image/jpeg','image/jpg','image/png','image/x-icon');
		$FILE_EXTS  = array('.jpeg','.jpg','.png'.'.ico');
		
		if (isset($file) && $file['name'] != "") {
			$file_type 	= $file['type']; 
			$file_image = $file['name'];
			$file_size 	= $file['size'];
			$file_ext 	= strtolower(substr($file_image,strrpos($file_image,".")));

			$temp_name 	= $file['tmp_name'];
			$file_image = str_replace("\\","",$file_image);
			$file_image = str_replace("'","",$file_image);

            $file_edit = str_replace(" ","_",$file_image);
            $random_digit=rand(0000,9999);
            $file_image = $folder.'_'.$random_digit."_".$file_edit;

			$file_path 	= $upload_dir.$folder.'/'.$file_image;

			if (!in_array($file_type, $FILE_MIMES) && !in_array($file_ext, $FILE_EXTS) ) {
				die(json_encode(array('status'=>'error', 'message' => "Sorry, $file_image($file_type) is not allowed to be uploaded")));
			}
			$result = move_uploaded_file($temp_name, $file_path);

			if ($result) {
				if($thumb==TRUE){
					$thumb_path = $upload_dir.$folder.'/thumb/';
					$thumbnail = $thumb_path.$file_image;
					$upload_image = $file_path;
					if($thumb_width==""){
						$thumb_width = 300;
					}else{
						$thumb_width = $thumb_width;
					}
					$info = getimagesize($upload_image);
					$aspectRatio = $info[1] / $info[0];
					$thumb_height = (int)($aspectRatio * $thumb_width) . "px";
					$thumb_width .= "px";  

					list($width,$height) = getimagesize($upload_image);
					$thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
					switch($file_ext){
						case '.jpg':
							$source = imagecreatefromjpeg($upload_image);
							break;
						case '.jpeg':
							$source = imagecreatefromjpeg($upload_image);
							break;

						case '.png':
							$source = imagecreatefrompng($upload_image);
							break;
						case '.gif':
							$source = imagecreatefromgif($upload_image);
							break;
						default:
							$source = imagecreatefromjpeg($upload_image);
					}
					//$source = imagecreatefrompng($upload_image);
					imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
					switch($file_ext){
						case '.jpg' || '.jpeg':
							imagejpeg($thumb_create,$thumbnail,100);
							break;
						case '.png':
							imagepng($thumb_create,$thumbnail,100);
							break;

						case '.gif':
							imagegif($thumb_create,$thumbnail,100);
							break;
						default:
							imagejpeg($thumb_create,$thumbnail,100);
						break;
					}				
				}
				return $file_image;
			}
			else{
				return "";
			}
		}
    }	
}
require_once(APPPATH.'core/AdminController.php');
require_once(APPPATH.'core/SpController.php');
