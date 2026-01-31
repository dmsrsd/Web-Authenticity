
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Kotak extends AdminController {
	function __construct() {
        parent::__construct();
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		//$this->load->library('dompdf_gen');
    }

	public function kotakbarcode(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Barcode";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => '*',
			'table' => 'kotak_code',
			'order_by' => 'id_code desc'
		));
		$this->render('new-fitur/kotakkode');
	}
	public function kotakbarcodeNew(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Barcode";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => '*',
			'table' => 'jenis_point',
			'order_by' => 'id_jenis_point desc'
		));
		$this->render('new-fitur/kotakkode-new');
	}
    public function kotakbarcodeProses(){
        $qty = $_POST['qty'];
        $jenis_point = $_POST['jenis_point'];
        $type = $_POST['type'];
        $code = array();
        //lopping sesuai jumlah
        for($i = 1; $i<=$qty; $i++) {
            //save ke db
            $code['code'] = $this->generateRandomString(10,$type);
            $code['type'] = $type;
            $code['id_jenis_point'] = $jenis_point;
            $this->model_global->insert($code, 'kotak_code');
        }
        redirect(base_url('cms/kotak/kotakbarcode?s=true&m=Data Berhasil Diubah'));
    }
    function generateRandomString($length = 10, $type) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        //tentukantype
        if($type=='silver'){
            return 'SLV'.$randomString;
        }else if($type=='redmax'){
            return 'RMX'.$randomString;
        }else{
            return 'PRP'.$randomString;
        }
    }
    public function listresi(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Member Konfirm Resi";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		if($c['userinfo']['_id']==7){//horeca=redmax
			if(empty($_GET['type'])or($_GET['type']!='redmax')){
				redirect(base_url('cms/kotak/listresi?type=redmax'));
			}
		} else if($c['userinfo']['_id']==8) { //event=silver lab=purple
			if(empty($_GET['type'])or($_GET['type']!='silver')){
				redirect(base_url('cms/kotak/listresi?type=silver'));
			}
		} else if($c['userinfo']['_id']==9) { // lab=purple
			if(empty($_GET['type'])){
				redirect(base_url('cms/kotak/listresi?type=purple'));
			}
		} else {
			
		}
		if($_GET['type']){
			$this->template['data'] = $this->model_global->get_data(array(
				'select' => 'a.*,b.fullname as member',
				'table' => 'kotak_confirm a',
				'join' => array('member b','b.id_member = a.id_member'),
				'where' => array('a.status !=' => 2,'a.type'=> $_GET['type']),
				'order_by' => 'a.id_kotak_confirm desc'
			));
		}else{
			$this->template['data'] = $this->model_global->get_data(array(
				'select' => 'a.*,b.fullname as member',
				'table' => 'kotak_confirm a',
				'join' => array('member b','b.id_member = a.id_member'),
				'where' => array('a.status !=' => 2),
				'order_by' => 'a.id_kotak_confirm desc'
			));
		}
		$this->render('new-fitur/kotakconfirm');
	}
    public function exportresi(){
		$c = $this->session->all_userdata();
		if($c['userinfo']['_id']==7){//horeca=redmax
			if(empty($_GET['type'])or($_GET['type']!='redmax')){
				redirect(base_url('cms/kotak/exportresi?type=redmax'));
			}
		} else if($c['userinfo']['_id']==8) { //event=silver
			if(empty($_GET['type'])or($_GET['type']!='silver')){
				redirect(base_url('cms/kotak/exportresi?type=silver'));
			}
		} else if($c['userinfo']['_id']==9) { // lab=purple
			if(empty($_GET['type'])){
				redirect(base_url('cms/kotak/exportresi?type=purple'));
			}
		} else {
		}
		if($_GET['type']!=''){
			// $data['datas'] = $this->model_global->get_data(array(
			// 	'select' => 'a.*,b.fullname as member',
			// 	'table' => 'kotak_confirm a',
			// 	'join' => array('member b','b.id_member = a.id_member'),
			// 	'where' => array('a.status !=' => 2,'a.type'=> $_GET['type']),
			// 	'order_by' => 'a.id_kotak_confirm desc'
			// ));
			$this->db->select('kotak_confirm.*, member.*, kota.kota');
			$this->db->from('kotak_confirm');
			$this->db->join('member', 'member.id_member = kotak_confirm.id_member');
			$this->db->join('kota', 'kota.id_kota = member.id_kota', 'left');
			$this->db->where('kotak_confirm.status !=', '2');
			$this->db->where('kotak_confirm.type', $_GET['type']);
			$this->db->order_by('kotak_confirm.id_kotak_confirm', 'desc');
			if($_GET['type']=='redmax'){
				$data['type'] = "horeca";
			} else if($_GET['type']=='silver'){
				$data['type'] = "event";
			} else{
				$data['type'] = "lab";
			}
		}else{
			// $data['datas'] = $this->model_global->get_data(array(
			// 	'select' => 'a.*,b.fullname as member',
			// 	'table' => 'kotak_confirm a',
			// 	'join' => array('member b','b.id_member = a.id_member'),
			// 	'where' => array('a.status !=' => 2),
			// 	'order_by' => 'a.id_kotak_confirm desc'
			// ));	
			$this->db->select('kotak_confirm.*, member.*, kota.kota');
			$this->db->from('kotak_confirm');
			$this->db->join('member', 'member.id_member = kotak_confirm.id_member');
			$this->db->join('kota', 'kota.id_kota = member.id_kota', 'left');
			$this->db->where('kotak_confirm.status !=', '2');
			$this->db->order_by('kotak_confirm.id_kotak_confirm', 'desc');	
			$data['type'] = "all";
		}
		$data['datas'] = $this->db->get()->result_array();
		//print_r($data['datas']); exit;
		$this->load->view('new-fitur/kotakconfirmexport',$data);
	}
    public function hapusresi($id){
		$this->model_global->update(array('status' => 2), 'kotak_confirm', array('id_kotak_confirm' => $id));
        redirect(base_url('cms/kotak/listresi'));
	}
    public function konfimresi($id){
		//cek data member lengkap
		$data_member = $this->model_global->get_data(array(
			'data' => 'row',
			'select' => 'a.*,b.fullname as member,b.email,b.address,b.hp',
			'table' => 'kotak_confirm a',
			'join' => array('member b','b.id_member = a.id_member'),
			'where' => array('id_kotak_confirm' => $id)
		));
		//cek jika ketemu
		if($data_member){
			//cek jika status masih nol maka buat kode dan kirim email
			if($data_member['status'] == 0){
				//buat type data
				$type =$data_member['type'];
				$jenis_point ='0';
				$to_email = $data_member['email'];
				$code['code'] = $this->generateRandomString(10,$type);
				$url_code = base_url('/unlock?code='.$code['code']);
				$image_name=$id.'-'.$code['code'].'.png';
				$url_barcode = base_url('uploads/barcode/'.$image_name);
				//buat barcode
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE

				$config['cacheable']    = true; //boolean, the default is true
				$config['cachedir']     = './uploads/barcode/'; //string, the default is application/cache/
				$config['errorlog']     = './uploads/barcode/'; //string, the default is application/logs/
				$config['imagedir']     = './uploads/barcode/'; //direktori penyimpanan qr code
				$config['quality']      = true; //boolean, the default is true
				$config['size']         = '1024'; //interger, the default is 1024
				$config['black']        = array(224,255,255); // array, default is array(255,255,255)
				$config['white']        = array(70,130,180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);
				$params['data'] = $url_code; //data yang akan di jadikan QR CODE
				$params['level'] = 'H'; //H=High
				$params['size'] = 10;
				$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
				$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

				//save kode barcode
				$code['type'] = $type;
				$code['id_jenis_point'] = $jenis_point;
				$this->model_global->insert($code, 'kotak_code');

				//kirim email
				$this->load->library('email');

				$config['protocol'] = 'smtp';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['smtp_host'] = 'smtp.zoho.com';
				$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				$config['smtp_timeout'] = '7';
				$config['smtp_user'] = 'info@authenticity.id';
				$config['smtp_pass'] = 'fU5fJx30qLUs';
				// $config['smtp_host'] = 'smtp.gmail.com';
				// $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				// $config['smtp_timeout'] = '7';
				// $config['smtp_user'] = 'gridsf@gramedia-majalah.com';
				// $config['smtp_pass'] = 'zcup oxoy yfug waqs';
				$config['charset'] = 'utf-8';
				$config['mailtype'] = 'html';
				$config['newline'] = "\r\n";
				$config['smtp_crypto'] = 'ssl';
				$this->email->initialize($config);
				$this->email->from("info@authenticity.id", 'Authentic');

				$this->email->to($to_email);
				$this->email->subject('Authentic : Submit kamu diterima');
				

				$em['data_head'] ="Dear <b>".$data_member['member']."</b>, <br><br>
				terima kasih sudah mensubmit foto kamu/foto struk/no invoice.<br>
				Kamu berhak mendapatkan kesempatan <br> Authenticiy Lucky Wheel dari spot: Event/Hangout Place/Authenticity Lab.<br>
				<a href='".$url_code."'>Klik link berikut ini </a> untuk langsung masuk ke Authenticity Lucky Wheel.<br><br>";
				$em['data_barcode'] = $url_barcode;				
				$em['data_footer'] = "Jika link bermasalah, scan QR code untuk me-redeem akses Authenticity Lucky Wheel.";
				$pesan = $this->load->view('new-fitur/email-template',$em,TRUE);
				$this->email->message($pesan);
				$se = $this->email->send();

				$this->response = $this->session->flashdata('responsereset');
				if(!$se){
					show_error($this->email->print_debugger());
					$this->model_global->update(array('status' => 3), 'kotak_confirm', array('id_kotak_confirm' => $id));
					redirect(base_url('cms/kotak/listresi?s=true&m=gagal kirim email bisa confirm lagi nanti!'));
				}
				//update status 
				$this->model_global->update(array('status' => 1), 'kotak_confirm', array('id_kotak_confirm' => $id));
				redirect(base_url('cms/kotak/listresi?s=true&m=Berhasil Konfirm User'));
			}else{
				//kirim email dan generate status 
				echo"kirim email"; exit;
				redirect(base_url('cms/kotak/listresi?s=true&m=Berhasil Konfirm User'));
			}exit;
			
		}else{
			redirect(base_url('cms/kotak/listresi?s=true&m=Data tidak ditemukan'));
		}
	}
    public function memberbarcode(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Member Spinner";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member_nama,b.email,b.address,b.hp as tlp,b.instagram',
			'table' => 'kotak_hadiah a',
			'join' => array('member b','b.id_member = a.id_member'),
			'order_by' => 'a.id_kotak_hadiah desc'
		));
		$this->render('new-fitur/kotakhadiah');
	}
    public function memberbarcodeedit($id){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Edit Data Member Spinner";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array('data' => 'row',
			'select' => 'a.*,b.fullname as member_nama,b.email,b.address,b.hp as tlp,b.instagram',
			'table' => 'kotak_hadiah a',
			'join' => array('member b','b.id_member = a.id_member'),
			'where' => 'a.id_kotak_hadiah = '.$id,
			'order_by' => 'a.id_kotak_hadiah desc'
		));
		print_r($this->template['data']); exit;
		$this->render('new-fitur/kotakhadiahedit');
	}
    public function spinnerexport(){
		// $data['itemdata'] = $this->model_global->get_data(array(
		// 	// 'select' => '*',
		// 	// 'table' => 'kotak_hadiah',
		// 	// 'where' => array('nama_hadiah !=' => 'belum dapat'),
		// 	// 'order_by' => 'id_kotak_hadiah desc'
		// 	'select' => 'kotak_hadiah.*, member.*,kota.kota',
		// 	'table' => 'kotak_hadiah',
		// 	'join' => array('member','member.id_member = kotak_hadiah.id_member'),
		// 	'join2' => array('kota','kota.id_kota = member.id_kota'),
		// 	'where' => array('kotak_hadiah.nama_hadiah !=' => 'belum dapat'),
		// 	'order_by' => 'kotak_hadiah.id_kotak_hadiah desc'
		// ));
		$this->db->select('kotak_hadiah.*, member.*, kotak_hadiah.created_date, kota.kota');
		$this->db->from('kotak_hadiah');
		$this->db->join('member', 'member.id_member = kotak_hadiah.id_member');
		$this->db->join('kota', 'kota.id_kota = member.id_kota', 'left');
		$this->db->where('kotak_hadiah.nama_hadiah !=', 'belum dapat');
		$this->db->order_by('kotak_hadiah.id_kotak_hadiah', 'desc');

		$data['itemdata'] = $this->db->get()->result_array();
		//print_r($data['itemdata']); exit;
		$this->load->view('new-fitur/kotakhadiahexport',$data);
	}
    public function redeem(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Member Redeem";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member,c.code as code',
			'table' => 'kotak_redeem a',
			'join' => array('member b','b.id_member = a.id_member'),
            'join2' => array('kotak_code c','c.id_code = a.id_code'),
			//'group_by' => 'b.id_member',
			'order_by' => 'b.fullname desc'
		));
		$this->render('new-fitur/kotakredeem');
	}
    public function setupwinner($id){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Setup Data Member Winner";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => 'a.*,b.fullname as member,b.email',
			'table' => 'kotak_setup_winner a',
			'where' => array('id_hadiah' => $id),
			'join' => array('member b','b.id_member = a.id_member'),
			//'group_by' => 'b.id_member',
			'order_by' => 'a.id_setup_winner desc'
		));
		$this->render('new-fitur/setuplistwinner');
	}
    public function setupwinnerNew($id){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Barcode";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		// $this->template['member'] = $this->model_global->get_data(array(
		// 	'select' => 'a.id_member,a.fullname,a.email,b.statuss',
		// 	'table' => 'member a',
		// 	'join' => array('kotak_setup_winner b','b.id_member = a.id_member'),
		// 	'where' => array('active !='=>1,'a.status !='=>-1,'a.id_member !='=>"1"),
		// 	'order_by' => 'a.id_member desc'
		// ));
		$this->template['member'] = $this->db->query("SELECT `a`.`id_member`, `a`.`fullname`, `a`.`email`, `b`.`status` FROM (`member` a) LEFT JOIN `kotak_setup_winner` b ON `b`.`id_member` = `a`.`id_member` WHERE `active` != 1 AND `a`.`status` != -1 AND `a`.`id_member` != '1' ORDER BY `a`.`id_member` desc")->result_array();
        $this->template['data_hadiah'] = $this->model_global->get_data(array('data' => 'row',
			'table' => 'kotak_data_hadiah',
			'where' => array('id_hadiah' => $id)
		));
		//print_r($this->template['member']); exit;
		$this->render('new-fitur/setupwinner-new');
	}
    public function setuphadiah(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Hadiah";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => '*',
			'table' => 'kotak_data_hadiah',
			'order_by' => 'urutan desc'
		));
		$this->render('new-fitur/setuphadiah');
	}
    public function setuphadiahNew(){
		$c = $this->session->all_userdata();
		$this->template['datasession'] = $c["userinfo"];
		$this->template["judul"] = "Data Barcode";
		$this->template['website'] = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array('id_website' => 1)));
		$this->template['data'] = $this->model_global->get_data(array(
			'select' => '*',
			'table' => 'kotak_data_hadiah',
			'order_by' => 'id_hadiah desc'
		));
		$this->render('new-fitur/tambahhadiah');
	}
    public function hadiahProses(){
		$nama_hadiah = $_POST['nama_hadiah'];
        $jumlah_hadiah = $_POST['jumlah_hadiah'];
        $urutan = $_POST['urutan'];
        $status = $_POST['status'];
        //save ke db
		$hadiah['nama_hadiah'] = $nama_hadiah;
		$hadiah['jumlah_hadiah'] = $jumlah_hadiah;
		$hadiah['urutan'] = $urutan;
		$hadiah['status'] = $status;
		$this->model_global->insert($hadiah, 'kotak_data_hadiah');

        redirect(base_url('cms/kotak/setuphadiah?s=true&m=Data Berhasil Diubah'));
	}
    public function setupwinnerProses(){
		$id_hadiah = $_POST['id_hadiah'];
		$nama_hadiah = $_POST['nama_hadiah'];
        $id_member = $_POST['id_member'];
        //save ke db
		$hadiah['id_hadiah'] = $id_hadiah;
		$hadiah['nama_hadiah'] = $nama_hadiah;
		$hadiah['id_member'] = $id_member;
		$hadiah['status'] = 1;
		$this->model_global->insert($hadiah, 'kotak_setup_winner');

        redirect(base_url('cms/kotak/setupwinner/'.$id_hadiah.'?s=true&m=Data Berhasil Diubah'));
	}
}
