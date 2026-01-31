<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Unlock extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));


	}
	public function index(){
		//ambil data
		$code= $_GET['code'];
		$tgl = date('Y-m-d H:i:s');
		$id_member = $this->datamember['id'];
		if(empty($id_member)){
			redirect(base_url()."login");
		}
		//cek code apa ada dan sesuai?
		$cek_code = $this->model_global->get_data(array('data' => 'row','table' => 'kotak_code', 'where' => array( 'code' =>$code, 'status' => 1)));
		if($cek_code){
			//unlock kode
			$up_redeem['id_code'] = $cek_code['id_code'];
			$up_redeem['nama_kotak'] = $cek_code['type'];
			$up_redeem['id_member'] = $id_member;
			$up_redeem['id_jenis_point'] = $cek_code['id_jenis_point'];
			$up_redeem['created_date'] = $tgl;
			$insert_id = $this->model_global->insert($up_redeem, 'kotak_redeem');
			if($insert_id){
				// sukses tambahkan point member
				$point['id_member'] = $id_member;
				$point['id_jenis_point'] = $cek_code['id_jenis_point'];
				$point["created_date"] = date('Y-m-d H:i:s');
				$this->model_global->insert($point, 'point');
				// masukkan ke log 
				// $log["type"] = "pay-item";
				// $log["id_member"] = $id_member;
				// $log["created_date"] = date('Y-m-d H:i:s');
				// $log["log"] = "unlock event";
				// $this->model_global->insert($log, 'log');
				//tandain code sudah di claim
				$up_code['status'] = 0;
				$up_code['member_claim'] = $id_member;
				$up_code['tgl_claim'] = $tgl;
				$this->model_global->update($up_code, 'kotak_code', array('id_code' => $cek_code['id_code']));
				redirect(base_url()."unlock/roulette");
			} else { //gagal unlock kode
				redirect(base_url()."campaign-merch?info=gagal claim data coba lagi nanti#mypoin");
			}
		} else { //kode tidak ditemukan			
			redirect(base_url()."campaign-merch?info=barcode product tidak ditemukan / sudah di claim#mypoin");
		}
	}

	public function roulette(){
		$id_member = $this->datamember['id'];
		if(empty($id_member)){
			redirect(base_url()."login");
		}
		//cek code apa ada dan sesuai?
		$cek_code = $this->db->query("SELECT COUNT(id_redeem_kotak) as total FROM `kotak_redeem` where id_member='".$this->datamember['id']."'")->row_array();
		$cek_jml = $this->db->query("SELECT COUNT(id_kotak_hadiah) as total FROM `kotak_hadiah` where id_member='".$this->datamember['id']."'")->row_array();
		//cek jika sudah kalim maka lanjut
		if(($cek_code['total'] >= 1)and($cek_jml['total']==0)or($cek_code['total'] >= 2)and($cek_jml['total']==1)){	
			//cek apakah sudah claim
			//$cek_code = $this->model_global->get_data(array('select' => '*','table' => 'kotak_hadiah', 'where' => array( 'id_member' =>$id_member)));
				
			// buka halaman roulette
			$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
	
			$this->load->view('front/podcast/header',$data);
			$data['datapemenang'] = $this->model_global->get_data(array('select' => '*','table' => 'kotak_data_hadiah', 'where' => array( 'status' => 1), 'order_by' => 'urutan desc'));			
			
			//cek apakah disetup dapat hadiah tertentu
			$cek_hadiah_setup = $this->model_global->get_data(array('data' => 'row','table' => 'kotak_setup_winner', 'where' => array( 'id_member' =>$id_member)));
			//print_r($cek_hadiah_setup); exit;
			//jika iya
			if($cek_hadiah_setup){
				//cek sisa hadiah
				$cek_sisa_hadiah_setup = $this->model_global->get_data(array('data' => 'row','table' => 'kotak_data_hadiah', 'where' => array( 'id_hadiah' =>$cek_hadiah_setup['id_hadiah'])));
				//print_r($cek_sisa_hadiah_setup); exit;
				if($cek_sisa_hadiah_setup){
					//cek apakah hadiah masih ada
					$data_hadiahh = $this->model_global->get_data(array('data' => 'row','table' => 'kotak_data_hadiah', 'where' => array( 'id_hadiah' =>$cek_sisa_hadiah_setup["id_hadiah"])));
					//updat jumlah hadiah
					if($data_hadiahh['jumlah_hadiah'] > 0){
						// sisa hadiah ada langsung ngarah ke roulete js hadiah tujuan
						$data["nama_hadiah"] = $cek_sisa_hadiah_setup["nama_hadiah"];
						$data["kode_hadiah"] = $cek_sisa_hadiah_setup["kode_hadiah"];
					} else {
						//jika tidak maka arahkan ke zonk
						$data["nama_hadiah"] = "belum dapat";
						$data["kode_hadiah"] = 18300;							
					}
				}else{
					//jika tidak maka arahkan ke zonk
					$data["nama_hadiah"] = "belum dapat";
					$data["kode_hadiah"] = 18300;
				}
			//jika tidak
			} else {
				//buat acak apakah dia beruntung atau tidak
				//$luck = rand(1, 5);
				$luck = 3; //update biar selalu dapat hadiah
				//jika beruntung
				if ($luck == 3) { //buat kemungkinan 20%
					//apa ada jumlah hadiah yg ga di setup pemenang?
					$cek_sisa_hadiah = $this->model_global->get_data(array('select' => '*','table' => 'kotak_data_hadiah', 'where' => array( 'jumlah_hadiah !=' => 0), 'order_by' => 'jumlah_hadiah desc'));
					// jika iya 
					foreach($cek_sisa_hadiah as $row){
						//cek ada hadiah kosong ga
						$cek_hadiah_kosong = $this->model_global->get_data(array('select' => '*','table' => 'kotak_setup_winner', 'where' => array( 'id_hadiah' => $row['id_hadiah'])));
						//jika ada data
						if($cek_hadiah_kosong) {
							//total hadiah yg di setup
							$tot_hadiah_kosong = count($cek_hadiah_kosong);
							if($tot_hadiah_kosong < $row['jumlah_hadiah']){
								$data["nama_hadiah"] = $row["nama_hadiah"];
								$data["kode_hadiah"] = $row["kode_hadiah"];
								//ketemu hadiah kemudian break
								break;
							}else{
								//jika tidak maka arahkan ke zonk
								$data["nama_hadiah"] = "belum dapat";
								$data["kode_hadiah"] = 18300;
								break;
							}
						} else {
							// ambil hadiahnya
							$data["nama_hadiah"] = $row["nama_hadiah"];
							$data["kode_hadiah"] = $row["kode_hadiah"];
							//ketemu hadiah kemudian break
							break;
						}
					}
					
				} else {
					//jika tidak maka arahkan ke zonk
					$data["nama_hadiah"] = "belum dapat";
					$data["kode_hadiah"] = 18300;
				}
			}
			//print_r($data); exit;
			//jika zonk load ke view zonk
			if($data["kode_hadiah"] != 18300){
				$this->load->view('front/spinner-hadiah',$data); //hadiah
			}else{
				$this->load->view('front/spinner',$data); //zonk
			}
			
			$this->load->view('front/podcast/footerfp');
		} else { //kode tidak ditemukan	
			if($cek_jml['total']>= 2){
				redirect(base_url()."campaign-merch?info= sudah maksimal ikut berpatisipasi#mypoin");
			} else {
				redirect(base_url()."campaign-merch?info= data lo masih kurang#mypoin");
			}	
		}
	}

	public function scan(){
		$this->load->view('front/qr',$data);
	}

	public function confirm($type){
		$this->load->view('front/podcast/header',$data);
		if($type == 'event'){
			$this->load->view('front/form-konfirm-event',$data);	
		} elseif ($type == 'lab'){
			$this->load->view('front/form-konfirm-lab',$data);			
		} else {
			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
			// print_r($data['member']); exit;
			$this->load->view('front/form-konfirm',$data);				
		}
		// buka halaman roulette
		$this->load->view('front/podcast/footerfp');
	}

	public function prosesconfirmhadiah(){
		$id_member = $this->datamember['id'];
		if(empty($id_member)){
			redirect(base_url()."login");
		}
		// cek data hadiah nya
		$cek = $this->model_global->get_data(array('data' => 'row','table' => 'kotak_hadiah', 'where' => array( 'id_kotak_hadiah' =>$_POST['user_id'], 'id_member'=>$this->datamember['id'])));
		if($cek){
			//update datanya dia
			$data_update = array(
				'akun_ig' => $_POST['akun_ig'],
				'alamat' => $_POST['alamat'],
				'hp' => $_POST['no_hp'],
				'nama_user' => $_POST['nama_user']
			);
			$this->model_global->update($data_update, 'kotak_hadiah', array('id_kotak_hadiah' => $_POST['user_id']));
			$cek_jml = $this->db->query("SELECT COUNT(id_kotak_hadiah) as total FROM `kotak_hadiah` where id_member='".$id_member."'")->row_array();
			if($cek_jml['total']==1){
				redirect(base_url()."campaign-merch?info=lo bisa ikutan sekali lagi nih, semangat#mypoin");
			}else{
				redirect(base_url()."campaign-merch?info=lo bisa ikutan lagi phase 2, bulan oktober#mypoin");
			}
		}else{
			redirect(base_url()."campaign-merch?info=Terima kasih telah mengikuti mengikuti program lucky whell#mypoin");
		}
	}

	public function prosesconfirm(){
		$up['lokasi_pembelian']= $_POST['pembelian'];
		$up['type']= $_POST['type'];
		// if($up['type']=='purple'){
		// 	$id_member = $this->datamember['id'];
		// 	$tgl = date('Y-m-d H:i:s');
		// 	$up['id_member'] = $id_member;
		// 	$up['created_date'] = $tgl;
		// 	$up['resi']= $_POST['invoice'];
		// 	$update_resi = $this->model_global->insert($up, 'kotak_confirm');
		// 	redirect(base_url()."campaign-merch?info=Berhasil Kirim, Tunggu Admin Kita Validasi#mypoin");
		// }else{
			//upload file
			if($_FILES['resi'] && $_FILES['resi']['name']!=''){
				$id_member = $this->datamember['id'];
				$tgl = date('Y-m-d H:i:s');
				$up['id_member'] = $id_member;
				$up['created_date'] = $tgl;
				if (!is_dir('uploads/resi/')) {
					mkdir('./uploads/resi/', 0755, true);
				}				
				$ekstensi = 'jpg';
				$type_resi = $_FILES['resi']['type'];
				if($type_resi=='image/png'){ $ekstensi = 'png'; }

				$new_name = $this->datamember['id'].'_resi_'.rand().'.'.$ekstensi;
				$config['upload_path']          = './uploads/resi/';
				$config['allowed_types']        = 'jpeg|jpg|png';
				$config['max_size']          = 1024;
				// $config['max_width']         = 1024;
				// $config['max_height']        = 768;
				$config['file_name'] 			= $new_name;

				$this->load->library('upload', $config);
				//$this->upload->do_upload('resi');
				if (!$this->upload->do_upload('resi')) {
					// Jika gagal, tampilkan error
					$error = $this->upload->display_errors();
					redirect(base_url()."campaign-merch?info=".$error."#mypoin");
				} else {
					$up['resi'] = $new_name;
					$update_resi = $this->model_global->insert($up, 'kotak_confirm');
					redirect(base_url()."campaign-merch?info=Berhasil Kirim, Tunggu Admin Kita Validasi Maksimal 3 x 24 jam#mypoin");
				}
				
			}else{
				redirect(base_url()."campaign-merch?info=Wajib Upload Data#mypoin");
			}
		//}		
	}

	public function hadiah(){
		$id_member = $this->datamember['id'];
		if(empty($id_member)){
			redirect(base_url()."login");
		}
		//cek apakah sudah claim
		// $cek_code = $this->model_global->get_data(array('select' => '*','table' => 'kotak_hadiah', 'where' => array( 'id_member' =>$id_member)));
		//cek code apa ada dan sesuai?
		$cek_code = $this->db->query("SELECT COUNT(id_redeem_kotak) as total FROM `kotak_redeem` where id_member='".$id_member."'")->row_array();
		$cek_jml = $this->db->query("SELECT COUNT(id_kotak_hadiah) as total FROM `kotak_hadiah` where id_member='".$id_member."'")->row_array();
		//cek jika sudah kalim maka lanjut
		if(($cek_code['total'] >= 1)and($cek_jml['total']==0)or($cek_code['total'] >= 2)and($cek_jml['total']==1)){	
			//cek nama hadiah 
			$hadiah= $_GET['data'];
			//cek hadiah
			$tgl = date('Y-m-d H:i:s');
			$data_hadiah = $this->model_global->get_data(array('data' => 'row','table' => 'kotak_data_hadiah', 'where' => array( 'nama_hadiah' =>$hadiah)));
			if($data_hadiah){
				//updat jumlah hadiah
				if($data_hadiah['jumlah_hadiah'] > 0){
					$jml_hadiah_baru = $data_hadiah['jumlah_hadiah']-1;
					//kurangi jumlah hadiah
					$this->model_global->update(array('jumlah_hadiah' => $jml_hadiah_baru), 'kotak_data_hadiah', array('id_hadiah' => $data_hadiah['id_hadiah']));
					
					//kurangi data
					// $data_silver = $this->db->query("SELECT id_redeem_kotak FROM `kotak_redeem` where nama_kotak='silver' and status=1 and id_member='".$this->datamember['id']."'")->row();
					// $this->model_global->update(array('status' => 0), 'kotak_redeem', array('id_redeem_kotak' => $data_silver->id_redeem_kotak));
					// $data_redmax = $this->db->query("SELECT id_redeem_kotak FROM `kotak_redeem` where nama_kotak='redmax' and status=1 and id_member='".$this->datamember['id']."'")->row();
					// $this->model_global->update(array('status' => 0), 'kotak_redeem', array('id_redeem_kotak' => $data_redmax->id_redeem_kotak));
					// $data_purple = $this->db->query("SELECT id_redeem_kotak FROM `kotak_redeem` where nama_kotak='purple' and status=1 and id_member='".$this->datamember['id']."'")->row();
					// $this->model_global->update(array('status' => 0), 'kotak_redeem', array('id_redeem_kotak' => $data_purple->id_redeem_kotak));
				}else{
					redirect(base_url()."login");
				}
			}
			//simpan hadiah 
			$up_hadiah['nama_hadiah'] = $hadiah;
			$up_hadiah['id_member'] = $id_member;
			$up_hadiah['created_date'] = $tgl;
			$insert_id = $this->model_global->insertId($up_hadiah, 'kotak_hadiah');
			echo $insert_id;
		}else{
			redirect(base_url()."campaign-merch?info= sudah ikut sebelumnya");
		}
	}

}