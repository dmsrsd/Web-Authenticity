<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();

class Rewards extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
	public function index(){
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;

			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
			$data['member']['provinsi']='';
			$data['member']['kota']='';
			if($data['member']['id_kota']!=""){
				$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a', 'join' => array('kota b','b.id_kota = a.id_kota'),'where' => array( 'a.id_member' =>$this->datamember['id'])));
			}
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/rewards',$data);
		}











	}
	public function scrable(){
		$date = date('Y-m-d H:i:s');
		$currentDate = strtotime($date);
		$futureDate = $currentDate+(60 * $this->website['time_scrable']);
		$end = date("Y-m-d H:i:s", $futureDate);
		//echo $date;
		//echo "<br>".$end;
		//die();
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$date = date('Y-m-d H:i:s');
			$data['sudah'] = $this->model_global->get_data(array('data' => 'row','table' => 'pointacak', 'where' => array( 'date(created_date)' =>date('Y-m-d'),'id_member' =>$this->datamember['id'])));
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/scrable',$data);
		}
	}

	public function startscrable(){
		$ret['status'] = "false";
		$ret['end'] = "0";
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$date = date('Y-m-d H:i:s');
			$currentDate = strtotime($date);
			$futureDate = $currentDate+(60 * $this->website['time_scrable']);
			$end = date("Y-m-d H:i:s", $futureDate);
			$start = date("Y-m-d H:i:s");
			$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'pointacak', 'where' => array( 'date(created_date)' =>date('Y-m-d'),'id_member' =>$this->datamember['id'])));
			if(count($sudah)==0){
				$pointacak['id_member'] = $this->datamember['id'];
				$pointacak["created_date"] = date('Y-m-d H:i:s');
				$pointacak["end"] = $end;
				$pointacak["point"] = "0";
				$this->model_global->insert($pointacak, 'pointacak');
				$last = $this->db->insert_id();

				$point['id_member'] = $this->datamember['id'];
				$point['id_jenis_point'] = "12";
				$point["created_date"] = date('Y-m-d H:i:s');
				$point["id_resource"] = $last;
				$this->model_global->insert($point, 'point');
				$ret['status'] = "true";
				$ret['end'] = $end;
			}else{
				$dataend = $sudah['end'];
				if($dataend >= $date){
					$ret['end'] = $sudah['end'];
					$ret['status'] = "true";
				}else{
					$ret['end'] = "0";
					$ret['status'] = "false";
				}
			}
			$ret['start'] = $start;
		}
		echo json_encode($ret);
	}
	public function scrableanswer(){
		$ret['status'] = "false";
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$date = date('Y-m-d H:i:s');
			$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'pointacak', 'where' => array( 'date(created_date)' =>date('Y-m-d'),'id_member' =>$this->datamember['id'])));
			if(count($sudah)>0){
				$dataend = $sudah['end'];
				if($dataend >= $date){
					$source = $this->model_global->get_data(array('data' => 'row','table' => 'acak', 'where' => array( 'id_acak'=>$_POST['coount'])));

					if(strtolower($_POST['a']) == strtolower($source['nama'])){
						$acak = $this->model_global->get_data(array('data' => 'row','table' => 'pointacak', 'where' => array( 'date(created_date)' =>date('Y-m-d'),'id_member' =>$this->datamember['id'])));
						$pointacak["point"] = $acak['point'] + $source['point'];
						$this->model_global->update($pointacak, 'pointacak', array('id_pointacak' => $acak['id_pointacak']));
					}
					$ret['status'] = "true";
				}else{
					$ret['status'] = "false";
				}

			}
		}
		echo json_encode($ret);
	}
	public function scrableacak(){
		$ret['status'] = "false";
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$acak = $this->model_global->get_data(array('select' => 'nama,id_acak','table' => 'acak', 'where' => array( 'status' => 1),'order_by'=>'rand()','limit'=>'1'));
			if(count($acak)>0){
				$newstring = "";
				$words = explode(" ",$acak[0]['nama']);
				foreach ($words as $word){
					//$newstring .= substr($word,0,2);
					$newstring .= $this->getName($word)."&nbsp;";
				}
				$ret['question'] = $newstring;
				$ret['coount'] = $acak[0]['id_acak'];
				$ret['status'] = "true";
			}
		}
		echo json_encode($ret);
	}
	function getName($characters) {
		$randomString = str_shuffle($characters);
		$balikin = "";
		for ($i = 0; $i < strlen($characters) ; $i++) {
			$balikin.= "<span>".substr($randomString,$i,1)."</span> ";
		}

		return $balikin;
	}

	public function bandshare(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | What Band Are You?";
		if(empty($this->datamember)){
			$data['website']['meta_description'] = "Simply Authentcy - What Band Are You?";
			if(isset($_GET['share'])){
				$data['website']['meta_image'] = base_url()."assets/front/img/band/".$_GET['share'].".jpg";
				$data['website']['meta_description'] = "Simply Authentcy - What Band Are You? : ".str_replace("_"," ",$_GET['share']);
			}
			redirect(base_url()."login");
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/login',$data);
		}else{
			$data['band'] = $this->model_global->get_data(array('select' => '*', 'table' => 'band', 'order_by' => 'id_band asc'));
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$data['website']['meta_description'] = "Simply Authentcy - What Band Are You?";
			if(isset($_GET['share'])){
				$data['website']['meta_image'] = base_url()."assets/front/img/band/".$_GET['share'].".jpg";
				$data['website']['meta_description'] = "Simply Authentcy - What Band Are You? : ".str_replace("_"," ",$_GET['share']);
			}
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/band',$data);
		}

	}
	public function band(){
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['subtitle'] = " | What Band Are You?";
			if(empty($this->datamember)){
				$data['website']['meta_description'] = "Simply Authentcy - What Band Are You?";
				if(isset($_GET['share'])){
					$data['website']['meta_image'] = base_url()."assets/front/img/band/".$_GET['share'].".jpg";
					$data['website']['meta_description'] = "Simply Authentcy - What Band Are You? : ".str_replace("_"," ",$_GET['share']);
				}
				$this->load->view('front/podcast/header',$data);
				$this->load->view('front/login',$data);
			}else{
				$data['band'] = $this->model_global->get_data(array('select' => '*', 'table' => 'band', 'order_by' => 'id_band asc'));
				$data['website'] = $this->website;
				$data['kategori'] = $this->kategori;
				$data['website']['meta_description'] = "Simply Authentcy - What Band Are You?";
				if(isset($_GET['share'])){
					$data['website']['meta_image'] = base_url()."assets/front/img/band/".$_GET['share'].".jpg";
					$data['website']['meta_description'] = "Simply Authentcy - What Band Are You? : ".str_replace("_"," ",$_GET['share']);
				}
				$this->load->view('front/podcast/header',$data);
				$this->load->view('front/band',$data);
			}
		}
	}
	public function submitband(){
		$ret['status'] = "false";
		$ret['html'] = "<h3 style='color:#0053A0;'>Results : </h3><br>";
		$ret['pic'] = "";
		$ret['band'] = "";
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$ar = array();
			$juma=0;$jumb=0;$jumc=0;
			for($no=1; $no<=7; $no++){
				$answer = "answer-".$no;
				$value = $_POST[$answer];
				switch($value){
					case "a":$juma = $juma+1;break;
					case "b":$jumb = $jumb+1;break;
					case "c":$jumc = $jumc+1;break;
				}
			}
			$img = "";
			if($juma >= 3){
				if($juma==3){
					if($jumb==2 && $jumc==2){
						$y = "1";
					}elseif($jumb==3){
						$y = "2";
					}elseif($jumc==3){
						$y = "3";
					}
				}else{
					$y = "1";
				}
				if($y=="1"){
					$acx = array("Metallica","Madball");
					$aci = array_rand($acx);
					$img = $acx[$aci];
				}elseif($y=="2"){
					$img = "Voodoo_Glow_Skulls";
				}else{
					$img =  "Foo_Fighters";
				}
			}else{

				if($jumb >= 3){
					if($jumb==3){
						if($jumc==3){
							$y = "2";
						}else{
							$y = "1";
						}
					}else{
						$y = "1";
					}
					if($y=="1"){
						$acx = array("The_Specials","The_Who");
						$aci = array_rand($acx);
						$img = $acx[$aci];
					}elseif($y=="2"){
						$img =  "The_Libertines";
					}
				}else{
					$acx = array("Nirvana","Sonic_Youth");
					$aci = array_rand($acx);
					$img = $acx[$aci];
				}
			}
			if($img!=""){
				$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'pointband', 'where' => array( 'image' =>$img.".jpg",'id_member' =>$this->datamember['id'])));
				if(count($sudah)==0){
					$jumlah = $this->model_global->get_data(array('data' => 'row','table' => 'jenis_point', 'where' => array( 'id_jenis_point' =>'27')));
					$pointband['id_member'] = $this->datamember['id'];
					$pointband["created_date"] = date('Y-m-d H:i:s');
					$pointband["point"] = $jumlah['pts'];
					$pointband["image"] = $img.".jpg";
					$this->model_global->insert($pointband, 'pointband');
					$last = $this->db->insert_id();

					$point['id_member'] = $this->datamember['id'];
					$point['id_jenis_point'] = "27";
					$point["created_date"] = date('Y-m-d H:i:s');
					$point["id_resource"] = $last;
					$this->model_global->insert($point, 'point');

				}

				$linkimg = base_url()."assets/front/img/band/$img.jpg";
				$ret['pic'] = $linkimg;
				$ret['band'] = $img;
				$ret['html'] .=  "<img src='$linkimg' class='img-responsive' id='img-result'>";
				$ret['html'] .=  "<br><div align='center'><h3>Share hasil Lo dan dapatkan point tambahan!</h3></div>";
				$ret['html'] .=  "
					<div class='row'>
						<div class='col-sm-8 col-sm-offset-2'>
							<div class='row'>
								<div class='col-sm-4'>
									<a href='javascript:void(0)' class='btn btn-block btn-blue' onclick=\"postArtikel('$img','$linkimg');return false;\"><i class='fa fa-facebook'></i> Share</a>
								</div>
								<div class='col-sm-4'>
									<a href='javascript:void(0)' class='btn btn-block btn-info'onclick=\"postArtikelTw('$img','$linkimg');return false;\"><i class='fa fa-twitter'></i> Share</a>
								</div>
								<div class='col-sm-4'>
									<a href='$linkimg' download='$img' class='btn btn-block btn-red'><i class='fa fa-download'></i> Download</a>
								</div>
							</div>
						</div>
					</div>
				";
				$ret['status'] = "true";
			}else{
				$ret['html'] .=  $juma.$jumb.$jumc."<br><div align='center'><h3>Maaf, jawaban Anda tidak ada dalam database kami, silahkan coba kembali!</h2></div>";
			}
		}
		echo json_encode($ret);
	}

	public function landingqrspecial($se){
		if($se=="wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
			$data['website'] = $this->website;
			$data['subtitle'] = " | Special Edition";
			$data['video'] = "hide";
			$data['se'] = $se;
			$data['sudah'] = "1";
			$data['headmessage'] = "";
			$data['message'] = "";
			$data['btnpoint'] = "";
			if(isset($_GET['v'])){
				$data['video'] = "";
			}
			if(empty($this->datamember)){
				$data['haslogin'] = false;

			}else{
				$data['haslogin'] = true;
				$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array('id_jenis_point'=>'24', 'date(created_date)' =>date('Y-m-d'),'id_member' =>$this->datamember['id'])));
				$point = $this->model_global->get_data(array('data' => 'row','table' => 'jenis_point', 'where' => array('id_jenis_point'=>'24')));
				if(count($sudah)>0){
					$data['headmessage'] = "NOTIFIKASI";
					$data['message'] = "Lo udah Scan QR Code Special Edition Hari Ini! ";
					$data['btnpoint'] = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
				}else{
					$ipoint['id_member'] = $this->datamember['id'];
					$ipoint['id_jenis_point'] = '24';
					$ipoint["created_date"] = date('Y-m-d H:i:s');
					$this->model_global->insert($ipoint, 'point');
					$data['headmessage'] = "SELAMAT";
					$data['message'] = "Dengan Scan Special Edition Lo Berhak Mendapatkan Point Tambahan!";
					$data['btnpoint'] = "<a href='javascript:void(0);' class='btn-point'>Bonus $point[pts] Point!</a>";
				}
			}
			$this->load->view('front/header-se',$data);
			$this->load->view('front/landing-se',$data);
		}else{
			redirect(base_url());
		}
	}
	public function scanqrspecial(){
		$ret['status'] = "false";
		$ret['message'] = "";
		$data['website'] = $this->website;
		$data['subtitle'] = " | Scan QR";
		if(empty($this->datamember)){
			$ret['status'] = "false";
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$cek = $_POST['qr'];
			$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array('id_jenis_point'=>'24', 'date(created_date)' =>date('Y-m-d'),'id_member' =>$this->datamember['id'])));
			if(count($sudah)>0){
				$ret['status'] = "false";
				$ret['message'] = "Lo udah Scan QR Code Special Edition Hari Ini! ";
			}else{
				if($cek =="https://www.simplyauthentic.id/rewards/se/wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw"){
					$ret['status'] = "true";
					$query = $this->db->query("SELECT * FROM `jenis_point` where id_jenis_point =24 limit 1")->result_array();
					$point =  $query[0]['pts'];
					$idpoint =  $query[0]['id_jenis_point'];
					$jenisnya = "Selamat lo mendapatkan <b>".$point."</b> Poin";
					$ipoint['id_member'] = $this->datamember['id'];
					$ipoint['id_jenis_point'] = '24';
					$ipoint["created_date"] = date('Y-m-d H:i:s');
					$this->model_global->insert($ipoint, 'point');
					$ret['hasil'] = "<h2>$jenisnya</h2><h3><br>Check point Lo di halaman <a href='".base_url()."profile'>Profile</a>";
				}else{
					$ret['status'] = "false";
					$ret['message'] = "QR Code Salah, Silahkan Scan QR Code yang berada di balik kemasan produk 'Special Edition'";

				}
			}

			/*
			$id =  end($x);
			*/
		}
		echo json_encode($ret);
	}
	public function scanqr(){
		$ret['status'] = "false";
		$ret['message'] = "";
		$data['website'] = $this->website;
		$data['subtitle'] = " | Scan QR";
		if(empty($this->datamember)){
			$ret['status'] = "false";
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$cek = $_POST['qr'];
			$dec = $this->encrypt->decode($cek);
			$x = explode("-clm-",$dec);
			$jenis = $x[0];
			$slug = $x[1];
			$ticketitem = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'slug' =>$slug,'status'=>'1')));
			if(count($ticketitem)==0){
				$ret['status'] = "false";
				$ret['message'] = "Data tidak ada! ";
			}else{
				$ret['status'] = "true";
				if($ticketitem['tanggal']!=date("Y-m-d")){
					$ret['hasil'] = "<h2>Scan QR Gagal..!</h2><h3>Tidak ada event ".$ticketitem['judul']." hari ini";
				}else{
					switch($jenis){
						case "game":
							$query = $this->db->query("SELECT * FROM `jenis_point` where id_jenis_point =11 limit 1")->result_array();
							$point =  $query[0]['pts'];
							$idpoint =  $query[0]['id_jenis_point'];
							$jenisnya = "Anda mendapatkan point <b>".$point."</b> PTS";

						break;
						case "purchase":
							if($ticketitem['id_jenistiket']=="1"){
								$query = $this->db->query("SELECT * FROM `jenis_point` where id_jenis_point in (14,15,16,17,18) order by rand() limit 1")->result_array();
							}else{
								$query = $this->db->query("SELECT * FROM `jenis_point` where id_jenis_point in (19,20,21,22,23) order by rand() limit 1")->result_array();
							}
							$point =  $query[0]['pts'];
							$idpoint =  $query[0]['id_jenis_point'];
							$jenisnya = "Selamat lo dapet : <b>$point</b> Poin";
						break;
					}
					$ipoint['id_member'] = $this->datamember['id'];
					$ipoint['id_jenis_point'] = $idpoint;
					$ipoint["created_date"] = date('Y-m-d H:i:s');
					$ipoint["id_resource"] = $ticketitem['id_ticket'];
					if($ticketitem['id_jenistiket']=="1"){
						$querys = $this->db->query("SELECT * FROM `point` where id_member='".$this->datamember['id']."' and id_jenis_point in (14,15,16,17,18)  and date(created_date)='".date("Y-m-d")."'")->result_array();
					}else{
						$querys = $this->db->query("SELECT * FROM `point` where id_member='".$this->datamember['id']."' and id_jenis_point in (19,20,21,22,23)  and date(created_date)='".date("Y-m-d")."'")->result_array();
					}
					if(count($querys)==0){
						$this->model_global->insert($ipoint, 'point');
						$ret['hasil'] = "<h2>$jenisnya</h2><h3>".ucwords($ticketitem['judul'])."</h3><h4>Di : <b>".ucwords($ticketitem['dimana'])."</b><br>Tanggal : <b>".namadate($ticketitem['tanggal'])."<b><h4><br>Liat poin Lo di halaman <a href='".base_url()."profile'>Profile</a>";
					}else{
						$ret['hasil'] = "<h2>Lo udah scan hari ini!<h2><br>Liat poin Lo di halaman <a href='".base_url()."profile'>Profile</a>";
					}
				}
			}

			/*
			$id =  end($x);
			*/
		}
		echo json_encode($ret);
	}


	public function qrspecial(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Scan QR Code Special Edition";
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$data['website']['meta_description'] = "Simply Authentcy - Scan QR Code Special Edition";
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/qr-special',$data);
		}
	}
	public function qr(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Scan QR";
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$data['website']['meta_description'] = "Simply Authentcy - Scan QR Code";
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/qr',$data);
		}
	}
	public function waktu(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Scan QR";
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$data['website']['meta_description'] = "Simply Authentcy - Scan QR Code";
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/waktu',$data);
		}
	}
	public function scanqrtest(){
		$ret['status'] = "false";
		$ret['message'] = "";
		$data['website'] = $this->website;
		$data['subtitle'] = " | Scan QR";
		if(empty($this->datamember)){
			$ret['status'] = "false";
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$cek = $_POST['qr'];
			$dec = $this->encrypt->decode($cek);
			$x = explode("-",$dec);
			$id =  end($x);
			$ticketitem = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array( 'id_ticket' =>$id,'status'=>'1')));
			if(count($ticketitem)==0){
				$ret['status'] = "false";
				$ret['message'] = "Data tidak ada!";
			}else{
				$ret['status'] = "true";
				$ret['hasil'] = "<h3>".ucwords($ticketitem['judul'])."</h3><h4>Di : <b>".ucwords($ticketitem['dimana'])."</b><br>Tanggal : <b>".namadate($ticketitem['tanggal']."<b><h4>");
			}
		}
		echo json_encode($ret);
	}
}