
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Event extends AdminController {
	function __construct() {
        parent::__construct();
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		//$this->load->library('dompdf_gen');
    }

	public function index(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Event";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => '*',
			'table' => 'event',
			'where' => array('status !=' => 2),
			'order_by' => 'id_event desc'
		));
		$this->render('event/list-event');
	}
	public function new(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Tambah Event";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		
		$this->render('event/new');
	}
	public function Prosescreate(){
		$_POST["created_date"]  = date('Y-m-d H:i:s');
	
		// ambil file
		$file = isset($_FILES['image']) ? $_FILES['image'] : null;
		$file_image = "";
		$upload_dir = "uploads/events";
	
		$FILE_MIMES = array('image/jpeg','image/jpg','image/png');
		$FILE_EXTS  = array('.jpeg','.jpg','.png');
	
		if ($file && $file['name'] != "") {
			$file_type  = $file['type'];
			$file_name  = $file['name'];
			$file_size  = $file['size'];
	
			// batas maksimal 1 MB
			if($file_size > 1048576){
				redirect('cms/event/new?s=false&m=Sorry, Max. image 1 MB');
				exit;
			}
	
			$file_ext = strtolower(substr($file_name, strrpos($file_name,".")));
	
			// cek ekstensi & mime
			if(!in_array($file_ext, $FILE_EXTS) || !in_array($file_type, $FILE_MIMES)){
				redirect('cms/event/new?s=false&m=Invalid file type');
				exit;
			}
	
			$temp_name = $file['tmp_name'];
	
			// sanitize nama file
			$file_name = preg_replace("/[^a-zA-Z0-9\.\_\-]/", "_", $file_name);
	
			// random prefix
			$random_digit = rand(1000,9999);
			$file_image   = $random_digit."_".$file_name;
	
			// buat folder kalau belum ada
			if (!is_dir($upload_dir.'/')) {
				mkdir($upload_dir.'/', 0775, TRUE);
			}
	
			$file_path = $upload_dir.'/'.$file_image;
	
			if(move_uploaded_file($temp_name, $file_path)){
				$_POST['image'] = $file_image;
			}
		}
	
		// konversi htm_start & htm_end dari "Rp10.000" ke angka
		if(isset($_POST['htm_start'])){
			$_POST['htm_start'] = preg_replace("/[^0-9]/", "", $_POST['htm_start']);
		}
		if(isset($_POST['htm_end'])){
			$_POST['htm_end'] = preg_replace("/[^0-9]/", "", $_POST['htm_end']);
		}
	
		$insert_id = $this->model_global->insert($_POST, 'event');
		if($insert_id){
			redirect('cms/event/new?s=true&m=Data Berhasil Disimpan');
		}
		else{
			redirect('cms/event/new?s=false&m=Data Gagal Disimpan');
		}
	}
	public function edit($id){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Tambah Event";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'event', 'where' => array('id_event' => $id)));
		//print_r($this->template['data']); exit;
		$this->render('event/new');
	}
	public function Prosesedit(){
		$id = $_POST['_id'];
		$image_old = $_POST['image_old'];
		unset($_POST['_id']);
		unset($_POST['image_old']);
	
		// ambil file
		$file = isset($_FILES['image']) ? $_FILES['image'] : null;
		$file_image = "";
		$upload_dir = "uploads/events";
	
		$FILE_MIMES = array('image/jpeg','image/jpg','image/png');
		$FILE_EXTS  = array('.jpeg','.jpg','.png');
	
		if ($file && $file['name'] != "") {
			$file_type  = $file['type'];
			$file_name  = $file['name'];
			$file_size  = $file['size'];
	
			// batas maksimal 1 MB
			if($file_size > 1048576){
				redirect('cms/event/new?s=false&m=Sorry, Max. image 1 MB');
				exit;
			}
	
			$file_ext = strtolower(substr($file_name, strrpos($file_name,".")));
	
			// cek ekstensi & mime
			if(!in_array($file_ext, $FILE_EXTS) || !in_array($file_type, $FILE_MIMES)){
				redirect('cms/event/new?s=false&m=Invalid file type');
				exit;
			}
	
			$temp_name = $file['tmp_name'];
	
			// sanitize nama file
			$file_name = preg_replace("/[^a-zA-Z0-9\.\_\-]/", "_", $file_name);
	
			// random prefix
			$random_digit = rand(1000,9999);
			$file_image   = $random_digit."_".$file_name;
	
			// buat folder kalau belum ada
			if (!is_dir($upload_dir.'/')) {
				mkdir($upload_dir.'/', 0775, TRUE);
			}
	
			$file_path = $upload_dir.'/'.$file_image;
	
			if(move_uploaded_file($temp_name, $file_path)){
				$_POST['image'] = $file_image;
			}
		} else {
			$_POST['image'] = $image_old;
		}
	
		// konversi htm_start & htm_end dari "Rp10.000" ke angka
		if(isset($_POST['htm_start'])){
			$_POST['htm_start'] = preg_replace("/[^0-9]/", "", $_POST['htm_start']);
		}
		if(isset($_POST['htm_end'])){
			$_POST['htm_end'] = preg_replace("/[^0-9]/", "", $_POST['htm_end']);
		}
	
		$update = $this->model_global->update($_POST, 'event', array('id_event' => $id));
		if($update){
			redirect('cms/event/new?s=true&m=Data Berhasil Diubah');
		}
		else{
			redirect('cms/event/new?s=false&m=Data Gagal Diubah');
		}
	}
	// hangout
	public function hangout(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Hangaout";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => '*',
			'table' => 'outlet_hangout',
			'where' => array('status !=' => -1),
			'order_by' => 'id_outlet desc'
		));
		$this->render('hangout/list');
	}
	public function hangoutnew(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Tambah Hangout";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'outlet_tmp','order_by' => 'nama_kota asc'));
		$this->render('hangout/new');
	}
	public function Prosescreatehangout(){
		$_POST["created_date"]  = date('Y-m-d H:i:s');
	
		// ambil file
		$file = isset($_FILES['image']) ? $_FILES['image'] : null;
		$file_image = "";
		$upload_dir = "uploads/hangout";
	
		$FILE_MIMES = array('image/jpeg','image/jpg','image/png');
		$FILE_EXTS  = array('.jpeg','.jpg','.png');
	
		if ($file && $file['name'] != "") {
			$file_type  = $file['type'];
			$file_name  = $file['name'];
			$file_size  = $file['size'];
	
			// batas maksimal 1 MB
			if($file_size > 1048576){
				redirect('cms/event/hangoutnew?s=false&m=Sorry, Max. image 1 MB');
				exit;
			}
	
			$file_ext = strtolower(substr($file_name, strrpos($file_name,".")));
	
			// cek ekstensi & mime
			if(!in_array($file_ext, $FILE_EXTS) || !in_array($file_type, $FILE_MIMES)){
				redirect('cms/event/hangoutnew?s=false&m=Invalid file type');
				exit;
			}
	
			$temp_name = $file['tmp_name'];
	
			// sanitize nama file
			$file_name = preg_replace("/[^a-zA-Z0-9\.\_\-]/", "_", $file_name);
	
			// random prefix
			$random_digit = rand(1000,9999);
			$file_image   = $random_digit."_".$file_name;
	
			// buat folder kalau belum ada
			if (!is_dir($upload_dir.'/')) {
				mkdir($upload_dir.'/', 0775, TRUE);
			}
	
			$file_path = $upload_dir.'/'.$file_image;
	
			if(move_uploaded_file($temp_name, $file_path)){
				$_POST['media_source'] = base_url('uploads/hangout/'.$file_image);
			}
		}
	
	
		$insert_id = $this->model_global->insert($_POST, 'outlet_hangout');
		if($insert_id){
			redirect('cms/event/hangout?s=true&m=Data Berhasil Disimpan');
		}
		else{
			redirect('cms/event/hangoutnew?s=false&m=Data Gagal Disimpan');
		}
	}
	public function hangoutedit($id){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Edit hangout";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array('data' => 'row','table' => 'outlet_hangout', 'where' => array('id_outlet' => $id)));
		$this->template['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'outlet_tmp','order_by' => 'nama_kota asc'));
		//print_r($this->template['data']); exit;
		$this->render('hangout/new');
	}
	public function Prosesedithangout(){
		$id = $_POST['_id'];
		$image_old = $_POST['image_old'];
		unset($_POST['_id']);
		unset($_POST['image_old']);
	
		// ambil file
		$file = isset($_FILES['image']) ? $_FILES['image'] : null;
		$file_image = "";
		$upload_dir = "uploads/hangout";
	
		$FILE_MIMES = array('image/jpeg','image/jpg','image/png');
		$FILE_EXTS  = array('.jpeg','.jpg','.png');
	
		if ($file && $file['name'] != "") {
			$file_type  = $file['type'];
			$file_name  = $file['name'];
			$file_size  = $file['size'];
	
			// batas maksimal 1 MB
			if($file_size > 1048576){
				redirect('cms/eventhangoutedit/'.$id.'?s=false&m=Sorry, Max. image 1 MB');
				exit;
			}
	
			$file_ext = strtolower(substr($file_name, strrpos($file_name,".")));
	
			// cek ekstensi & mime
			if(!in_array($file_ext, $FILE_EXTS) || !in_array($file_type, $FILE_MIMES)){
				redirect('cms/eventhangoutedit/'.$id.'?s=false&m=Invalid file type');
				exit;
			}
	
			$temp_name = $file['tmp_name'];
	
			// sanitize nama file
			$file_name = preg_replace("/[^a-zA-Z0-9\.\_\-]/", "_", $file_name);
	
			// random prefix
			$random_digit = rand(1000,9999);
			$file_image   = $random_digit."_".$file_name;
	
			// buat folder kalau belum ada
			if (!is_dir($upload_dir.'/')) {
				mkdir($upload_dir.'/', 0775, TRUE);
			}
	
			$file_path = $upload_dir.'/'.$file_image;
	
			if(move_uploaded_file($temp_name, $file_path)){
				$_POST['media_source'] = base_url('uploads/hangout/'.$file_image);
			}
		} else {
			$_POST['media_source'] = $image_old;
		}
	
		// konversi htm_start & htm_end dari "Rp10.000" ke angka
		if(isset($_POST['htm_start'])){
			$_POST['htm_start'] = preg_replace("/[^0-9]/", "", $_POST['htm_start']);
		}
		if(isset($_POST['htm_end'])){
			$_POST['htm_end'] = preg_replace("/[^0-9]/", "", $_POST['htm_end']);
		}
	
		$update = $this->model_global->update($_POST, 'outlet_hangout', array('id_outlet' => $id));
		if($update){
			redirect('cms/event/hangoutedit/'.$id.'?s=true&m=Data Berhasil Diubah');
		}
		else{
			redirect('cms/event/hangoutedit/'.$id.'?s=false&m=Data Gagal Diubah');
		}
	}

	public function hangoutdeletesoft($id){
		$delete = $this->model_global->delete('outlet_hangout', array( 'id_outlet' => $id));
		redirect('cms/event/hangout?s=true&m=Data Berhasil Dihapus');
	}
}
