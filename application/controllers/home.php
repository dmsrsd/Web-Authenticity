<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
	public function index(){

		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori' => 1), 'order_by' => 'urutan asc'));;
		$data['ticket'] = $this->model_global->get_data(array('select' => '*', 'table' => 'ticket','where' => array('status' => 1), 'order_by' => 'tanggal asc'));;
		$data['kontributor'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kontributor','where' => array('status' => 1), 'order_by' => 'nama asc'));;
		$data['artikeladmin'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategori,b.head_kategori,b.slug as slugkat',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status'=>1 ),
			'limit' => 4,
			'order_by' => 'a.created_date desc'
		));
		$data['artikelmember'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategori,b.head_kategori,b.slug as slugkat',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status'=>1,'a.approve'=>1,'a.created_by !='=>1),
			'limit' => 8,
			'order_by' => 'a.created_date desc'
		));
		//$data['slide'] = $this->model_global->get_data(array('select' => '*', 'table' => 'slide','where' => array('status' => 1,'kategori'=>'home'), 'order_by' => 'id_slide desc'));

		//$this->load->view('front/'.$data['website']['theme'].'/header',$data);
		//$this->load->view('front/'.$data['website']['theme'].'/home',$data);
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/home',$data);

	}


	public function search(){
		$data['website'] = $this->website;
		$data['listkontributor'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kontributor','where' => array('status' => 1), 'order_by' => 'nama asc'));;

		if(isset($_POST['txtsearch'])){
			$data['artikel'] = $this->model_global->get_data(array(
				'select' => 'a.*, b.nama as kategori,b.head_kategori,b.slug as slugkat',
				'table' => 'artikel a',
				'join' => array('kategori b','b.id_kategori = a.id_kategori'),
				'like' => array('a.judul'=>$_POST['txtsearch']),
				'where' => array('a.status'=>1),
				'order_by' => 'a.created_date desc'
			));
			$data['search'] = $_POST['txtsearch'];
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/search',$data);
		}else{
			redirect(base_url()."article");
		}
	}
	public function comboprovince(){
		$ret["data"] = array();
		if(isset($_POST['search'])){
			$kota = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by'=>'provinsi', 'order_by' => 'provinsi asc'));
			if(count($kota)>0){
				$ret["data"] = $kota;
			}
		}
		echo json_encode($ret);
	}
	public function combocity(){
		$ret["data"] = array();
		if(isset($_POST['search'])){
			$prov = $_POST['id'];
			$kota = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','where'=>array('provinsi'=>$prov), 'order_by' => 'kota asc'));
			if(count($kota)>0){
				$ret["data"] = $kota;
			}
		}
		echo json_encode($ret);
	}
	public function getcity(){
		$ret["data"] = array();
		if(isset($_POST['search'])){
			$prov = $_POST['id'];
			$kota = $this->model_global->get_data(array('select' => '*', 'table' => 'tbl_kabkot','where'=>array('provinsi_id'=>$prov), 'order_by' => 'kabupaten_kota asc'));
			if(count($kota)>0){
				$ret["data"] = $kota;
			}
		}
		echo json_encode($ret);
	}
	public function getkec(){
		$ret["data"] = array();
		if(isset($_POST['search'])){
			$prov = $_POST['id'];
			$kec = $this->model_global->get_data(array('select' => '*', 'table' => 'tbl_kecamatan','where'=>array('kabkot_id'=>$prov), 'order_by' => 'kecamatan asc'));
			if(count($kec)>0){
				$ret["data"] = $kec;
			}
		}
		echo json_encode($ret);
	}
	public function testmail(){
		/*$em['data'] =  'Dear Anggimasa sih ini bisa di kirim ?';
		$pesan = $this->load->view('front/email-template',$em,FALSE);
		*/
		//$email = "anggi1@dialectiga.com";
		$email = $_GET['email'];
		$cek2 = verifyEmail($email,"anggir13@gmail.com",true);
		if($cek2[0]=="invalid"){
			echo "fail";
		}else{
			$this->load->library('email');
			$emd['data'] = "TEST";
			$pesand = $this->load->view('front/email-template',$emd,TRUE);
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
			$this->email->from("noreply@authenticity.id", 'Authenticity');
			$this->email->to($email);
			$this->email->subject('Authenticity');
			$this->email->message($pesand);
			$a = $this->email->send();
			if($a){
				echo "sukses";
			}else{
				echo "fail";
				echo $this->email->print_debugger();
			}
		}

	}
	public function submitcontact(){
		$data['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$_POST["status"] = '1';
		$_POST["modified_date"] = '';
		$_POST["created_date"] = date('Y-m-d H:i:s');
		$js['status']="false";

		$insert_id = $this->model_global->insert($_POST, 'contact');
		if($insert_id){
			$js['status']="true";
			$from_email = "info@joblessofficial.com";
			$to_email = $_POST['email'];

			//Load email library
			$this->load->library('email');

			$this->email->from($from_email, 'Jobless Official');
			$this->email->to($to_email);
			$this->email->subject('Contact Submit');
			$this->email->message('Dear '.$_POST['name'].', Terima Kasih, telah menghubungi kami, Jobless Official.');
			$this->email->send();

			$this->email->from($from_email, 'Jobless Official');
			$this->email->to("jobless.fockwurk@gmail.com");
			$this->email->subject('Contact Submit');
			$this->email->message('Dear '.$_POST['name'].', Terima Kasih, telah menghubungi kami, Jobless Official.');
			$this->email->send();

			$this->response = $this->session->flashdata('response');
			$this->session->set_flashdata('response', array('status' => 'success', 'alert' => 'success', 'message' => 'Successfull send your message!'));

		}
		else{
			$js['status']="false";
			$this->response = $this->session->flashdata('response');
			$this->session->set_flashdata('response', array('status' => 'error','alert' => 'danger',  'message' => 'Failed!'));

		}
		echo json_encode($js);
    }

	public function genqryoutube(){
		$this->genqr("https://youtu.be/YbCvtwFczPA","547x547");
	}
	public function genqrbungkus(){
		$this->genqr("https://www.simplyauthentic.id/rewards/se/wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw","547x547");
	}
	public function genqrbungkusnoc(){
		$this->genqrnoc("https://www.simplyauthentic.id/rewards/se/wxwKQMOtmjWd9G2qsbNlDQb9E52PgrVQwUId9UlUz2ZcIQDANCj2HSs66aq29SjREGdc1Uf8PcfvvwlcGtw","547x547");
	}
	public function genqrnoc($data,$size){
		//$data = 'ClephH5mXADRiWeuBaJNFcmBIUp822AoKz1MTq4W1PgA0HeGu2a+xXPNgkL7lMTkvAaq3PtlDV1WZ6b9vl67qsxzC6etT3Gk4ebUsgXZ4Pf0GAl0DBEJGSU3GJpITCHoDUFQPj9fVKkR5IfJPGK5m4i0QxBnRqx3Po6+815wjoU=';
		//$size = '320x320';
		$logo = false;
		//$logo = FALSE;
		header('Content-type: image/png');
		//$QR = imagecreatefrompng(base_url().'assets/front/img/qrlogo.png');
		$QR = imagecreatefrompng('http://chart.googleapis.com/chart?cht=qr&chld=L|1&chs='.$size.'&chl='.urlencode($data));
		if($logo !== FALSE){
			$logo = imagecreatefromstring(file_get_contents($logo));
			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			$logo_width = imagesx($logo);
			$logo_height = imagesy($logo);
			$logo_qr_width = $QR_width/4;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;
			imagecopyresampled($QR, $logo, $QR_width/2.65, $QR_height/2.65, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
		}
		imagepng($QR);
		imagedestroy($QR);
	}
	public function genqr($data,$size){
		//$data = 'ClephH5mXADRiWeuBaJNFcmBIUp822AoKz1MTq4W1PgA0HeGu2a+xXPNgkL7lMTkvAaq3PtlDV1WZ6b9vl67qsxzC6etT3Gk4ebUsgXZ4Pf0GAl0DBEJGSU3GJpITCHoDUFQPj9fVKkR5IfJPGK5m4i0QxBnRqx3Po6+815wjoU=';
		//$size = '320x320';
		$logo = base_url().'assets/front/img/icon.png';
		//$logo = FALSE;
		header('Content-type: image/png');
		//$QR = imagecreatefrompng(base_url().'assets/front/img/qrlogo.png');
		$QR = imagecreatefrompng('http://chart.googleapis.com/chart?cht=qr&chld=L|1&chs='.$size.'&chl='.urlencode($data));
		if($logo !== FALSE){
			$logo = imagecreatefromstring(file_get_contents($logo));
			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			$logo_width = imagesx($logo);
			$logo_height = imagesy($logo);
			$logo_qr_width = $QR_width/4;
			$scale = $logo_width/$logo_qr_width;
			$logo_qr_height = $logo_height/$scale;
			imagecopyresampled($QR, $logo, $QR_width/2.65, $QR_height/2.65, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
		}
		imagepng($QR);
		imagedestroy($QR);
	}

	public function respon_400() {
		header("HTTP/1.1 404 Not Found");
		$this->load->helper('url');
		// redirect('home');

		$data['website'] = $this->website;
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/404', $data);
		$this->load->view('front/podcast/footerfp');
	 }
}
