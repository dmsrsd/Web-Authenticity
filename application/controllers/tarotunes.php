<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Tarotunes extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
    
	public function index(){

		if(empty($this->datamember)){
			redirect(base_url()."login?to=tarotunes");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			
			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
			//end jumlah data event
			//$this->load->view('front/podcast/header',$data);
			$this->load->view('front/tarotunes/home',$data);
			//$this->load->view('front/podcast/footerfp');
		}
	}

    public function main(){

		if(empty($this->datamember)){
			redirect(base_url()."login?to=tarotunes");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			
			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
            $data['kartu'] = $cek = $this->db->query("SELECT * FROM tarrots_module Where status='yes' ORDER BY RAND()")->result_array();
            //$data['kartu'] = $this->model_global->get_data(array('select' => array('id_tarrots','nama_kartu','gambar'), 'table' => 'tarrots_module a','where' => array( 'a.status' =>"yes")));
            //print_r($data['kartu']); exit;
			//end jumlah data event
			//$this->load->view('front/podcast/header',$data);
			$this->load->view('front/tarotunes/main',$data);
			//$this->load->view('front/podcast/footerfp');
		}
	}
    public function pilih(){

		if(empty($this->datamember)){
			redirect(base_url()."login?to=tarotunes");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			
			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
            $data['kartu'] = $this->model_global->get_data(array('select' => array('id_tarrots','nama_kartu','gambar'), 'table' => 'tarrots_module a','where' => array( 'a.status' =>"yes")));
            //print_r($data['kartu']); exit;
			//end jumlah data event
			//$this->load->view('front/podcast/header',$data);
			$this->load->view('front/tarotunes/pilih-10',$data);
			//$this->load->view('front/podcast/footerfp');
		}
	}
    public function kirimkartu(){
		if(empty($this->datamember)){
			$m =  "You are not logged in yet";
			$ret['status'] = false;
		}else{
				// Jalankan proses jika jumlah data kurang dari 2
				$data_arr = $_GET;
				$data_arr['create_at'] = date('Y-m-d H:i:s');

				$save = $this->model_global->insertId($data_arr, 'tarrots_member');
				$m =  "Thank you. You have voted for this contestant";
				$ret['status'] = true;
                $m =  $save;
				//print_r($data_arr); exit; // Debug: cetak data lalu hentikan
		}
		$ret['message'] = $m;
		echo json_encode($ret);
		return;
	}
    public function share($id){
        //$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
        $kartu = $this->model_global->get_data(array('data' => 'row','table' => 'tarrots_member a','where' => array( 'a.id_tarrots_member' =>$id)));
        $type = (int) $this->input->get('type', true);
        if($kartu){
            $data['kartu_1'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_1'])));
            $data['kartu_2'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_2'])));
            $data['kartu_3'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_3'])));
            $data['kartu_4'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_4'])));
            $data['kartu_5'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_5'])));
            $data['kartu_6'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_6'])));
            $data['kartu_7'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_7'])));
            $data['kartu_8'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_8'])));
            $data['kartu_9'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_9'])));
            $data['kartu_10'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_10'])));
            $data['type'] = $type;
            //print_r($data); exit;
            if(in_array($type, array(1, 2, 3), true)){
                $this->load->view('front/tarotunes/share',$data);
            }else{
                $this->load->view('front/tarotunes/show',$data);
            }
        }
		
	}
    public function download($id){
        //$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
        $kartu = $this->model_global->get_data(array('data' => 'row','table' => 'tarrots_member a','where' => array( 'a.id_tarrots_member' =>$id)));
        $type = (int) $this->input->get('type', true);
        if($kartu){
            $data['kartu_1'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_1'])));
            $data['kartu_2'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_2'])));
            $data['kartu_3'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_3'])));
            $data['kartu_4'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_4'])));
            $data['kartu_5'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_5'])));
            $data['kartu_6'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_6'])));
            $data['kartu_7'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_7'])));
            $data['kartu_8'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_8'])));
            $data['kartu_9'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_9'])));
            $data['kartu_10'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up , down', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_10'])));
            $data['type'] = $type;
            //print_r($data); exit;
            if(in_array($type, array(1, 2, 3), true)){
                $this->load->view('front/tarotunes/new-share',$data);
            }else{
                $this->load->view('front/tarotunes/show',$data);
            }
        }
		
	}
    public function shareemails($id){
        $this->output->set_content_type('application/json');
        $memberId = (int) $this->input->get('id', true);
        if ($memberId <= 0) {
            echo json_encode(array('status' => false, 'message' => 'Invalid member id.'));
            return;
        }

        $cek = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$memberId)));
        if (!$cek || empty($cek['email'])) {
            echo json_encode(array('status' => false, 'message' => 'Member email not found.'));
            return;
        }

        $kartu = $this->model_global->get_data(array('data' => 'row','table' => 'tarrots_member a','where' => array( 'a.id_tarrots_member' =>$id)));
        if(!$kartu){
            echo json_encode(array('status' => false, 'message' => 'Tarot result not found.'));
            return;
        }

        $data['kartu_1'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_1'])));
        $data['kartu_2'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_2'])));
        $data['kartu_3'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_3'])));
        $data['kartu_4'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_4'])));
        $data['kartu_5'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_5'])));
        $data['kartu_6'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_6'])));
        $data['kartu_7'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_7'])));
        $data['kartu_8'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_8'])));
        $data['kartu_9'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_9'])));
        $data['kartu_10'] = $this->model_global->get_data(array('data' => 'row', 'select' => 'nama_kartu , gambar , up', 'table' => 'tarrots_module a','where' => array( 'a.id_tarrots' =>$kartu['id_tarrots_10'])));
        
        $to_email = $cek['email'];
        $this->load->library('email');

        $config['protocol'] = 'smtp';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'gridsf@gramedia-majalah.com';
        $config['smtp_pass'] = 'zcup oxoy yfug waqs';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        $config['smtp_crypto'] = 'ssl';
        $this->email->initialize($config);
        $this->email->from("gridsf@gramedia-majalah.com", 'Authenticity');
        $this->email->to($to_email);
        $this->email->subject('Authenticity : Tarotunes');

        $pesan = $this->load->view('front/tarotunes/share-emails-template',$data,TRUE);
        $this->email->message($pesan);
        $se = $this->email->send();

        if(!$se){
            log_message('error', 'Tarotunes shareemails failed: '.$this->email->print_debugger(array('headers')));
            echo json_encode(array('status' => false, 'message' => 'Gagal kirim email. Coba lagi nanti.'));
            return;
        }

        echo json_encode(array('status' => true, 'message' => 'Email berhasil dikirim.'));
        return;
	}

    public function share_media() {
        if (!isset($_FILES['image'])) {
            echo json_encode(['success' => false, 'message' => 'No image uploaded.']);
            return;
        }
        $relativeDir = 'tarrotunes-file';
        $uploadDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $relativeDir . DIRECTORY_SEPARATOR;

        // Ensure upload directory exists and is writable in shared hosting setups.
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
        }
        if (!is_writable($uploadDir)) {
            @chmod($uploadDir, 0777);
        }

        // Fallback directory to avoid hard failure if primary folder is not writable.
        if (!is_writable($uploadDir)) {
            $relativeDir = 'application/cache/tarrotunes-file';
            $uploadDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $relativeDir . DIRECTORY_SEPARATOR;
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            if (!is_writable($uploadDir)) {
                @chmod($uploadDir, 0777);
            }
        }

        if (!is_writable($uploadDir)) {
            echo json_encode([
                'success' => false,
                'message' => 'Upload folder is not writable. Please set write permission on ' . $uploadDir
            ]);
            return;
        }

        $config['upload_path'] = $uploadDir;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name'] = 'tarotunes-' . time();
        $config['overwrite'] = false;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $fileUrl = base_url(trim($relativeDir, '/') . '/' . $uploadData['file_name']);
            echo json_encode(['success' => true, 'url' => $fileUrl]);
        } else {
            echo json_encode(['success' => false, 'message' => strip_tags($this->upload->display_errors())]);
        }
    }


}
