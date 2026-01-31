<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Duoverse extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));
        $this->playlist_menu = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
	
	}
    
	public function index(){
        $data['website'] = $this->website;
        $data['kategori'] = $this->kategori;
        
        //$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
        //end jumlah data event
        $this->db->select('
            m.id_member,
            m.fullname,
            m.instagram,
            SUM(p.jml_poin) AS total_poin
        ');
        $this->db->from('member m');
        $this->db->join('duoverse_poin_member p', 'p.member_id = m.id_member');
        $this->db->group_by(['m.id_member', 'm.fullname', 'm.instagram']);
        $this->db->having('total_poin >', 0);
        $this->db->order_by('total_poin', 'DESC');
        $this->db->limit(10);

        $query = $this->db->get();
        $data['list_point'] = $query->result_array();
        $this->load->view('front/duoverse/home',$data);
	}

    public function sarat_ketentuan(){
        $data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['playlist_menu'] = $this->playlist_menu;
		$data['event_aktif'] = $this->model_global->get_data(array('select' => '*', 'row','table' => 'event', 'where' =>array('periode_end >' => date('Y-m-d H:i:s')), 'order_by'=>'periode_end desc'));
		$data['event_setelahnya'] = $this->model_global->get_data(array('select' => '*', 'row','table' => 'event', 'where' =>array('periode_end <' => date('Y-m-d H:i:s')), 'order_by'=>'periode_end desc'));
		//print_r($data); exit;
		$this->load->view('front/podcast/header',$data);
        $this->load->view('front/duoverse/tnc',$data);
	}
    public function profile(){
        if(empty($this->datamember)){
		    redirect(base_url()."login?to=duoverse/profile");
        }else{
            //cek member
            $data['website'] = $this->website;
            $data['kategori'] = $this->kategori;
            $data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
            //cek reveral apa sudah ada
            $data['member']['my_referal'];
            if($data['member']['my_referal']==""){
                $referal_code = $this->generateRandomString();
                $ac['my_referal'] = $referal_code;
                $update = $this->model_global->update($ac, 'member', array('id_member' => $data['member']['id_member']));
            }else{
                $referal_code = $data['member']['my_referal']; 
            }
            $data['referal_code'] = $referal_code;
            //end jumlah data event
            //$this->load->view('front/podcast/header',$data);
            $this->load->view('front/duoverse/profile',$data);
        }
	}
    public function list(){
        // Hitung total baris (member yang punya poin)
        $this->db->select('m.id_member');
        $this->db->from('member m');
        $this->db->join('duoverse_poin_member p', 'p.member_id = m.id_member');
        $this->db->group_by('m.id_member');
        $total_rows = $this->db->get()->num_rows();

        // Konfigurasi pagination
        $config['base_url'] = base_url('duoverse/list');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        // Styling pagination (Bootstrap-like)
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        // Tentukan offset halaman aktif
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Query data poin per member
        $this->db->select('
            m.id_member,
            m.fullname,
            m.instagram,
            m.pp,
            SUM(p.jml_poin) AS total_poin
        ');
        $this->db->from('member m');
        $this->db->join('duoverse_poin_member p', 'p.member_id = m.id_member');
        $this->db->group_by(['m.id_member', 'm.fullname', 'm.instagram', 'm.pp']);
        $this->db->having('total_poin >', 0);
        $this->db->order_by('total_poin', 'DESC');
        $this->db->limit($config['per_page'], $page);
        $query = $this->db->get();

        // Kirim data ke view
        $data['list_point'] = $query->result_array();
        $data['pagination'] = $this->pagination->create_links();
        //print_r($result); exit;
        $this->load->view('front/duoverse/list',$data);
	}
    public function klaim($referal_code){
        //deklarasikan point
        $tot_point_parent = 20; //user yg share referal
        $tot_point_child = 10; //user yg kalim referal
        if(empty($this->datamember)){
            //set session referal
            $url= base_url("duoverse/klaim/".$referal_code);
            $this->session->set_userdata('memberduoverse', $url);
		    redirect(base_url()."login?to=duoverse/klaim/".$referal_code);
        }else{
            //cek referal
            $cek = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.my_referal' =>$referal_code)));
            if($cek){ //jika ditemukan
                //validasi kalo user sendiri tidak bisa claim
                if($cek['id_member']==$this->datamember['id']){
                    redirect(base_url()."duoverse/profile?error=kode harus di claimsama yang berbeda");
                    exit;
                }
                // validasi jika klaim berulang
                $cekclaim = $this->model_global->get_data(array('data' => 'row','table' => 'duoverse_poin_member a','where' => array('a.type' =>'claim','a.member_id' =>$this->datamember['id'], 'a.referal_code' =>$referal_code)));
                if($cekclaim){
                    redirect(base_url()."duoverse/profile?error=sudah claim sebelumnya");
                    exit;
                }
                //validasi lagi ip
                if (
                    (isset($cek['last_ip']) && $cek['last_ip'] == getip()) ||
                    (isset($cek['last_browser']) && $cek['last_browser'] == getbrowser())
                ) {
                    redirect(base_url()."duoverse/profile?error=indikasi spam coba beberapa saat lagi");
                    exit;
                }
                // validasi jika user login pada ip sama dengan user berbeda sehari hanya bisa sekali
                $today_cek = date('Y-m-d');
                $ip_cek = $cek['last_ip'];
                $id_cek =$this->datamember['id'];
                $this->db->select('dpm.*');
                $this->db->from('duoverse_poin_member dpm');
                $this->db->join('member m', 'm.id_member = dpm.member_id');
                $this->db->where('dpm.type', 'claim');
                $this->db->where('m.last_ip', $ip_cek);
                $this->db->where('dpm.referal_code', $referal_code);
                $this->db->where('DATE(dpm.created_date)', $today_cek);
                $cek_dat = $this->db->get()->num_rows();

                if ($cek_dat > 0) {
                    redirect(base_url()."duoverse/profile?error=akun di lock karena indikasi spam coba beberapa saat lagi");
                    exit;
                }
               
                //cetak point untuk user yg di klaim ($parent)
                $point_parent['member_id'] = $cek['id_member'];
                $point_parent['jml_poin'] = $tot_point_parent;
                $point_parent['referal_code'] = $referal_code;
                $point_parent['type'] = '';
                $point_parent["created_date"] = date('Y-m-d H:i:s');
                $this->model_global->insert($point_parent, 'duoverse_poin_member'); 
                //cetak point untuk user yang ngeclaim
                $point_child['member_id'] = $this->datamember['id'];
                $point_child['jml_poin'] = $tot_point_child;
                $point_child['referal_code'] = $referal_code;
                $point_child['type'] = 'claim';
                $point_child["created_date"] = date('Y-m-d H:i:s');
                $this->model_global->insert($point_child, 'duoverse_poin_member'); 
                redirect(base_url()."duoverse/list?info=berhasil claim");
            } else {
                redirect(base_url()."duoverse/profile?error= kode expired atau tidak ditemukan");
            }
            exit;
        }
        echo $id;
		
	}
    function generateRandomString($length = 13) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

    //mulai hangout
    public function hangout(){
        $data['website'] = $this->website;
		$data['subtitle'] = " | Hangout";
        $data['kota'] = $this->model_global->get_data(array('select' => '*', 'table' => 'outlet_tmp','order_by' => 'nama_kota asc'));
        $data['outlet'] = $this->model_global->get_data(array('select' => '*', 'table' => 'outlet_hangout','where' => array('status' => 1),'order_by' => 'kota asc'));
        $data['playlist_menu'] = $this->playlist_menu;
		//print_r($data); exit;
        $this->load->view('front/podcast/header',$data);
        $this->load->view('front/hangout',$data);
		$this->load->view('front/podcast/footerfp',$data);
    }

}
