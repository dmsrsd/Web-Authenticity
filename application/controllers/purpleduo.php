<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purpleduo extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));

	}

	public function index(){
		$data['website'] = $this->website;
        $this->load->view('front/purpleduo/header',$data);
        $this->load->view('front/purpleduo/homepages',$data);
		$this->load->view('front/purpleduo/footerfp');
	}
	public function register(){
		$data['website'] = $this->website;
        $data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
		if(empty($data['member'])){
			redirect(base_url("login?to=purple-duo-home"));
		}
		$data['provinsi'] = $this->db->query("SELECT provinsi FROM kota GROUP BY provinsi ORDER BY provinsi asc")->result_array();
		if(!empty($data['member']['id_kota'])){
			$data['prov_selected'] = $this->db->query("SELECT * FROM kota where id_kota = ".$data['member']['id_kota'])->row_array();
		}else{
			$data['prov_selected'] = array();
		}
		// print_r($data['prov_selected']); exit;
		//print_r($data['provinsi']); exit;
		$this->load->view('front/purpleduo/header',$data);
        $this->load->view('front/purpleduo/welcome',$data);
		$this->load->view('front/purpleduo/footerfp');
	}
	public function submit_register(){
        $member = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
		if(empty($member)){
			redirect(base_url("login?to=purple-duo-home"));
		}else{
			//update alamat
			$data_update = array(
				'id_kota' => $_POST['id_kota'],
				'fullname'	=> $_POST['fullname'],
				'age'	=>	$_POST['age']
			);
			$update = $this->model_global->update($data_update, 'member', array('id_member' => $this->datamember['id']));
			redirect(base_url("pertanyaan/1"));
		}
	}
	public function pertanyaan($halaman){
		$data['website'] = $this->website;
		$data['halaman'] = $halaman;
        $member = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
		if(empty($member)){
			redirect(base_url("login?to=purple-duo-home"));
		}
		//cek umur masuk ke urutan berapa
		$umur = $member['age'];
		//cek jika umur kosong redirect ke lengkapi data
		if($umur ==""){
			redirect(base_url("purple-duo-home"));
		}
		//cek apakah sudah pernah ikut sebelumnya?
		$cek_step = $this->model_global->get_data(array('data' => 'row','table' => 'pupleduo_jawaban a','where' => array( 'a.member_id' =>$this->datamember['id'], 'a.halaman' => $halaman)));
		if($cek_step){ //jika sebelumnya ikut redirect ke next
			$halaman_next = $halaman + 1;
			redirect(base_url("pertanyaan/".$halaman_next));
		}
		//$umur=55;
		//ambil data
		if($umur<=30){
			// echo "20-30"; //value1
			$urutan_umur = 1;
		}else if($umur<=35){
			// echo "31-35"; //value3
			$urutan_umur = 2;
		}else if($umur<=40){
			// echo "36-40"; //value3
			$urutan_umur = 3;
		}else{
			// echo "41-45"; //value3
			$urutan_umur = 4;
		}
		
		$data['pertanyaan'] = $this->model_global->get_data(array('data' => 'row','table' => 'pupleduo_pertanyaan','where' => array( 'umur' => $urutan_umur,'urutan' => $halaman)));
		if(empty($data['pertanyaan'])){
			//redirect ke hasil
			redirect(base_url("caracter"));
		}
		$data['pertanyaan_lanjutan'] = $this->model_global->get_data(array('select' => '*','table' => 'pupleduo_pertanyaan_lanjutan','where' => array( 'id_pertanyaan' => $data['pertanyaan']['id_pertanyaan']), 'order_by' => 'type asc'));
		
		$this->load->view('front/purpleduo/header',$data);
        $this->load->view('front/purpleduo/pertanyaan',$data);
		$this->load->view('front/purpleduo/footerfp');
	}

	public function submit_pertanyaan($halaman){
		$member = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
		$halaman_next = $halaman + 1;
		if(empty($member)){
			redirect(base_url("login?to=purple-duo-home"));
		}
		//cek umur masuk ke urutan berapa
		$umur = $member['age'];
		//cek jika umur kosong redirect ke lengkapi data
		if($umur ==""){
			redirect(base_url("purple-duo-home"));
		}
		//simpan data
		$up['member_id'] = $this->datamember['id'];
		$up['umur'] = $umur;
		$up['halaman'] = $halaman;
		list($quiz, $value_quiz) = explode("|", $_POST['quiz']);
		$up['quiz'] = $quiz;
		$up['value_quiz'] = $value_quiz;
		list($sub_quiz, $bobot_quiz) = explode("|",$_POST['sub_quiz']);
		$up['sub_quiz'] = $bobot_quiz;
		$up['bobot_quiz'] = $sub_quiz;
		$up['created_at'] = date('Y-m-d H:i:s');
		$ave_data = $this->model_global->insert($up, 'pupleduo_jawaban');
		if($ave_data){
			redirect(base_url("pertanyaan/".$halaman_next));
		}else{
			redirect(base_url("pertanyaan/".$halaman));
		}
	}
	public function caracter(){
		$data['website'] = $this->website;
        $member = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
		if(empty($member)){
			redirect(base_url("login?to=purple-duo-home"));
		}
		//cek umur masuk ke urutan berapa
		$umur = $member['age'];
		//cek jika umur kosong redirect ke lengkapi data
		if($umur ==""){
			redirect(base_url("purple-duo-home"));
		}
		//cek apa udah lengkap testnya
		if($umur<=30){
			// echo "20-30"; //value1
			$total_pertanyaan = 5;
			$kode_umur = 1;
		}else if($umur<=35){
			// echo "31-35"; //value3
			$total_pertanyaan = 2;
			$kode_umur = 2;
		}else if($umur<=40){
			// echo "36-40"; //value3
			$total_pertanyaan = 3;
			$kode_umur = 3;
		}else{
			// echo "41-45"; //value3
			$total_pertanyaan = 3;
			$kode_umur = 4;
		}
		$cek_step = $this->model_global->get_data(array('select' => '*','table' => 'pupleduo_jawaban a','where' => array('a.member_id' =>$this->datamember['id']), 'order_by' => 'bobot_quiz desc'));
		if($cek_step){ //jika sebelumnya ikut redirect ke next
			if(count($cek_step) < $total_pertanyaan){
				//jika ga lengkap ulangi dari soal 1
				redirect(base_url("pertanyaan/1"));
			}			
		}
		$cek_data_character = $this->model_global->get_data(array('data' => 'row','table' => 'pupleduo_jawaban_karakter a','where' => array('a.member_id' =>$this->datamember['id'])));
		if($cek_data_character){
			$data['character'] = $this->model_global->get_data(array('data' => 'row','table' => 'pupleduo_karakter a','where' => array('a.id_pupleduo_karakter' =>$cek_data_character['id_pupleduo_karakter'])));
		}else{
			$char =array();
			$douplicate = array();
			//tentukan label
			foreach ($cek_step as $item) {
				//temukan yg dipilih kiri
				if ($item['bobot_quiz'] >= 1) {
					// temukan charcter
					$char[] = $item['value_quiz'];
				}

				// temukan jika dia pilih double abaikan kanan kiri
				$value_quiz = $item['value_quiz'];  
				// Jika value_quiz sudah ada di frequency array, tambahkan frekuensinya
				if (isset($frequency[$value_quiz])) {
					$frequency[$value_quiz]++;
				} else {
					// Jika belum ada, inisialisasi dengan nilai 1
					$frequency[$value_quiz] = 1;
				}
			}
			//cek dia pilih kanan semua atau kiri semua
			$label_char1 ="";
			$label_char2 ="";
			if((count($char)<=1)or(count($char)==$total_pertanyaan)){
				//tentukan sesuai umur default
				if($umur<=30){ // echo "20-30"; //pop rock
					$label_char1 ="POP";
					$label_char2 ="ROCK";
				}else if($umur<=35){ // echo "31-35";
					$label_char1 =$cek_step['0']['value_quiz'];
					$label_char2 =$cek_step['1']['value_quiz'];
				}else if($umur<=40){ // echo "36-40";  //age traditional
					$label_char1 ="NEW AGE";
					$label_char2 ="TRADITIONAL";
				}else{ // echo "41-45"; //folk traditional
					$label_char1 ="NEW AGE";
					$label_char2 ="TRADITIONAL";
				}
			}else{
				//jika nilai sudah 2
				if(count($char)>=2){
					//setup label satu dan 2
					$label_char1 =$char[0];
					$label_char2 =$char[1];
				} else{
					//cek duplicate dimana buat nentuin char 1
					foreach ($frequency as $value_quiz => $count) {
						if ($count > 1) {
							$label_char1 = $value_quiz;
						}
						$label_char2 = $value_quiz;
					}
				}
			}
			if(($label_char1 != '')and($label_char2 !="")){
				//buat code character
				$kode_char1 = $label_char1." ".$label_char2;
				$kode_char2 = $label_char2." ".$label_char1;
				//cari di database untuk penamaan pemenang
				$data_character = $this->model_global->get_data(array('data' => 'row','table' => 'pupleduo_karakter','where' => array( 'umur' =>$kode_umur,'genre' => $kode_char1)));
				// Jika data karakter pertama tidak ditemukan, cari dengan kombinasi kedua
				if (!$data_character) {
					$data_character = $this->model_global->get_data(array('data' => 'row','table' => 'pupleduo_karakter','where' => array( 'umur' =>$kode_umur,'genre' => $kode_char2)));
				}
				// Set data karakter atau tampilkan pesan kesalahan
				if ($data_character) {
					//simpan ke db
					$up['member_id'] = $this->datamember['id'];
					$up['nama_member'] = $member['fullname'];
					$up['umur'] = $kode_umur;
					$up['id_pupleduo_karakter'] = $data_character['id_pupleduo_karakter'];
					$up['create_at'] = date('Y-m-d H:i:s');
					$ave_data = $this->model_global->insert($up, 'pupleduo_jawaban_karakter');
					//load data untuk di view
					$data['character'] = $data_character;
				} else {
					echo "Data tidak ditemukan";
					print_r($cek_step);
					exit;
				}

			}else{
				echo"data tidak ditemukan";
				print_r($cek_step); exit;
			}
		}
		// print_r($data['character']); exit;
		$this->load->view('front/purpleduo/header',$data);
        $this->load->view('front/purpleduo/caracter',$data);
		$this->load->view('front/purpleduo/footerfp');
	}
	public function card($id_member){
		$data['website'] = $this->website;
        $data['items'] = $this->db->query("SELECT * FROM pupleduo_jawaban_karakter where member_id = ".$id_member)->row_array();
		if($data['items']){
			$data['character'] = $this->model_global->get_data(array('data' => 'row','table' => 'pupleduo_karakter a','where' => array('a.id_pupleduo_karakter' =>$data['items']['id_pupleduo_karakter'])));
		} else{
			redirect(base_url());
		}
		$this->load->view('front/purpleduo/header',$data);
        $this->load->view('front/purpleduo/card',$data);
		$this->load->view('front/purpleduo/footerfp');
	}


}
