<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Elite extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
    
	public function index(){

		// if(empty($this->datamember)){
		redirect(base_url()."elite/tnc");
        die;
		// }else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			
			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
			//end jumlah data event
			//$this->load->view('front/podcast/header',$data);
			$this->load->view('front/elite/home',$data);
			//$this->load->view('front/podcast/footerfp');
		//}
	}
    public function home(){

		// if(empty($this->datamember)){
		// 	redirect(base_url()."login?to=elite");
		// }else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			
			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
			//end jumlah data event
			//$this->load->view('front/podcast/header',$data);
			$this->load->view('front/elite/home',$data);
			//$this->load->view('front/podcast/footerfp');
		//}
	}
    public function tnc(){

		// if(empty($this->datamember)){
		// 	redirect(base_url()."login?to=elite");
		// }else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			if(!empty($this->datamember)){
                $data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
            }else{
                $data['member'] = array();
            }
			//end jumlah data event
			//$this->load->view('front/podcast/header',$data);
			$this->load->view('front/elite/tnc',$data);
			//$this->load->view('front/podcast/footerfp');
		//}
	}
    public function tncProses(){
        @session_start();
        //print_r($_POST); exit;
		// if(empty($this->datamember)){
		// 	redirect(base_url()."login?to=elite/tnc");
		// }else{
            // upload image
            if($_FILES['buktiSubscribeYoutube'] && $_FILES['buktiSubscribeYoutube']['name']!=''){
				//$id_member = $this->datamember['id'];
                $id_member = 0;
				$tgl = date('Y-m-d H:i:s');
				$up['id_member'] = $id_member;
				$up['created_date'] = $tgl;
				if (!is_dir('uploads/buktiSubscribeYoutube/')) {
					mkdir('./uploads/buktiSubscribeYoutube/', 0755, true);
				}				
				$ekstensi = 'jpg';
				$type_file = $_FILES['buktiSubscribeYoutube']['type'];
				if($type_file=='image/png'){ $ekstensi = 'png'; }

				$new_name = 'new_buktiSubscribeYoutube_'.rand().'.'.$ekstensi;
				$config['upload_path']          = './uploads/buktiSubscribeYoutube/';
				$config['allowed_types']        = 'jpeg|jpg|png';
				$config['max_size']          = 5120;
				// $config['max_width']         = 1024;
				// $config['max_height']        = 768;
				$config['file_name'] 			= $new_name;

				$this->load->library('upload', $config);
				//$this->upload->do_upload('resi');
				if (!$this->upload->do_upload('buktiSubscribeYoutube')) {
					// Jika gagal, tampilkan error
					$error = $this->upload->display_errors();
					redirect(base_url()."elite/tnc?info=".$error);
				} else {
                    $up = $_POST;
                    $up['bukti_screnshoot_yt'] = $new_name;
                    $up['create_at'] =date('Y-m-d H:i:s');
                    ///unset($up['tnc_hadiah']); // Hapus elemen 'tnc_hadiah'
                    //simpan data
                    $save = $this->model_global->insertId($up, 'elite_member_master');
                    //selanjutnya push session
                    $this->session->set_userdata('memberelite', $save);
                    //$update_pp = $this->model_global->update($up, 'member', array('id_member' => $this->datamember['id']));
                    if($save){
                        redirect(base_url()."elite/home?tnc=".$_POST['tnc_hadiah']);
                    }else{
                        redirect(base_url()."elite/tnc?info=Gagal update coba lagi nanti");
                    }
				}
				
			}else{
				redirect(base_url()."elite/tnc?info=wajib upload file");
			}
		//}
	}
    public function main(){
       // print_r($this->session->userdata('memberelite')); exit;
		if(empty($this->session->userdata('memberelite'))){
			redirect(base_url()."login?to=elite/main?tnc=0");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
            $data['pertanyaan'] = $cek = $this->db->query("SELECT * FROM elite_module Where status='yes' order by posisi asc")->result_array();
            //print_r($data['pertanyaan1']); exit;
			$this->load->view('front/elite/main',$data);
		}
	}
    public function mainProses(){
		if(empty($this->session->userdata('memberelite'))){
			redirect(base_url()."login?to=elite");
		}else{
            $data = $_POST;
            $counts = array_count_values($_POST); // Hitung frekuensi
            $max = max($counts); // Ambil nilai frekuensi terbesar

            foreach ($data as $value) {
                if ($counts[$value] === $max) {
                    $value=$value;
                    break;
                }
            }
            $data_arr = $_POST;
            $data_arr['created_at'] = date('Y-m-d H:i:s');
            $data_arr['id_member'] = $this->session->userdata('memberelite');
            $data_arr['kode_pemenang'] = $value;
            $save = $this->model_global->insertId($data_arr, 'elite_member');
            redirect(base_url()."elite/hasil/".$save);
		}
	}
    public function hasil($id){
        $data['website'] = $this->website;
        $data['kategori'] = $this->kategori;
        $data['data_elite'] = $this->model_global->get_data(array('data' => 'row','table' => 'elite_member', 'where' => array( 'id_elite_member' =>$id)));
        ///print_r($data['data_elite']); exit;
        if($data['data_elite']){
            $this->load->view('front/elite/hasil-1',$data);
        }else{
            redirect(base_url()."elite");
        }
	}
    public function download($id){
        if(empty($this->session->userdata('memberelite'))){
			$data['member'] = array();
		}else{
            $data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'elite_member_master a','where' => array( 'a.id_member_elite' =>$this->session->userdata('memberelite'))));
        }
        $data['website'] = $this->website;
        $data['kategori'] = $this->kategori;
        //echo $id; exit;
        if (in_array($id, [1, 2, 3])) {
            $this->load->view('front/elite/download',$data);
        }else{
            redirect(base_url()."elite");
        }
	}
    public function share($id){
        //$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
        $kartu = $this->model_global->get_data(array('data' => 'row','table' => 'tarrots_member a','where' => array( 'a.id_tarrots_member' =>$id)));
        if($kartu){
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
            //print_r($data); exit;
            if($_GET['type']){
                $this->load->view('front/tarotunes/share',$data);
            }else{
                $this->load->view('front/tarotunes/show',$data);
            }
        }
		
	}
    public function shareemails($id){
        $cek = $this->model_global->get_data(array('data' => 'row','table' => 'elite_member_master a','where' => array( 'a.id_member_elite' =>$_GET['id'])));
        //print_r($cek); exit;
        if($cek){
            $data['type']= $id;
           
            $to_email = $cek['email'];
            $this->load->library('email');

            $config['protocol'] = 'smtp';
            $config['mailpath'] = '/usr/sbin/sendmail';		
            // new smtp google
            $config['smtp_host'] = 'smtp.gmail.com';
            $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
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
            $this->email->subject('Authenticity : Elite');

            $pesan = $this->load->view('front/elite/share-emails-template',$data,TRUE);
            $this->email->message($pesan);
            $se = $this->email->send();

            $this->response = $this->session->flashdata('responsereset');
            if(!$se){
                show_error($this->email->print_debugger());
                $this->session->set_flashdata('responsereset', array('status' => 'success', 'message' => 'Something error, please contact us! '));
            }else{
                // $this->session->set_flashdata('responsereset', array('status' => 'success', 'message' => 'Check your email for a new password! '));
                $this->session->set_flashdata('responsereset', array('status' => 'success', 'message' => 'Check your email to reset your password!'));
            }

            //redirect(base_url().'login');
        }
		
	}


}
