<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posterchallenge extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
	public function index(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Poster Challenge ";
		$data['kategori'] = $this->kategori;
		$data['soundroom'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'posterchallenge a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.votes desc'
		));
		$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/posterchallenge',$data);
	}

	public function getposterchallenge(){
		$ret['status'] = "false";
		$ret['message'] = "";
		if(isset($_POST['res'])){
			$data = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array( 'id_posterchallenge' =>$_POST['res'],'approve'=>1)));
			$kota = $this->model_global->get_data(array('data' => 'row','table' => 'kota', 'where' => array( 'id_kota' =>$data['id_kota'])));
			$qtot = $this->db->query("SELECT COUNT(id_resource) as vote FROM `voteposter` where    id_resource='".$_POST['res']."'")->result_array();
			$tot =  $qtot[0]['vote'];
			$desk = substr(str_replace("\n", '',strip_tags($data['deskripsi'])),0,100)." ...";
			$ret['status'] = "true";
			$ret['message'].="<div class='row'>";
			$ret['message'].="<div class='col-sm-6'><img src='".base_url()."uploads/posterchallenge/$data[image]' class='img-thumbnail'></div>";
			$ret['message'].="<div class='col-sm-6'><h3>$data[judul]</h3>";
			$ret['message'].="<b>$kota[kota]</b><br><br>";
			$ret['message'].="Share On :<br><br>";
			$ret['message'].="<a href='javascrip:void(0);' onclick=\"postArtikel('$desk','$data[judul]','".base_url()."uploads/posterchallenge/$data[image]','".base_url()."poster-challenge/$data[slug]')\" class='btn btn-sm btn-primary'><i class='fa fa-facebook'></i> Facebook</a>&nbsp; ";
			$ret['message'].="<a href='javascrip:void(0);' onclick=\"postArtikelTw('$desk','$data[judul]','".base_url()."uploads/posterchallenge/$data[image]','".base_url()."poster-challenge/$data[slug]')\" class='btn btn-sm btn-info'><i class='fa fa-twitter'></i> Twitter</a>";
			$ret['message'].="</div>";
			$ret['message'].="</div>";
		}
		echo json_encode($ret);
	}
	public function read($slug){
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['soundroom'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'posterchallenge a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.votes desc'
		));
		$data['detil'] = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array( 'slug' =>$slug,'approve'=>1)));
		$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));

		if(count($data['detil'])==0){
			redirect(base_url()."poster-challenge");
		}else{
			$desk = substr(str_replace("\n", '',strip_tags($data['detil']['deskripsi'])),0,100)." ...";
			$data['subtitle'] = " | Poster Challenge - ".$data['detil']['judul'];
			$data['website']['meta_description'] = "Upload your poster  - ".$data['detil']['judul'].", ".$desk;
			$data['website']['meta_image'] = base_url()."uploads/posterchallenge/".$data['detil']['image'];
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/posterchallenge',$data);
		}
	}
	public function getpoint(){
		$ret['status'] = "false";
		$ret['message'] = "";
		if(!empty($this->datamember)){
			$maneh = $this->db->query("SELECT COUNT(id_posterchallenge) as vote FROM `posterchallenge` where id_posterchallenge='".$_POST['x']."' and created_by='".$this->datamember['id']."'")->result_array();
			$maneihlin =  $maneh[0]['vote'];
			if($maneihlin > 0){
				$ret['message'] = "You can't vote yourself!";
			}else{
				$qsudah = $this->db->query("SELECT COUNT(id_resource) as vote FROM `voteposter` where id_resource='".$_POST['x']."' and  id_member='".$this->datamember['id']."'")->result_array();
				$sudah =  $qsudah[0]['vote'];
				if($sudah > 0){
					$ret['message'] = "You have voted for this poster!";
				}else{
					$qbrp = $this->db->query("SELECT COUNT(id_resource) as vote FROM `voteposter` where  id_member='".$this->datamember['id']."' and date(created_date)=CURDATE() ")->result_array();
					$berapa =  $qbrp[0]['vote'];
					if($berapa=="2"){
						$ret['message'] = "The vote limit is only 2 times today!";
					}else{
						$ret['btnv'] = "btnv-".$_POST['x'];
						$ret['status'] = "true";
						$ret['message'] = "Thank you for your vote!";
						$point['id_member'] = $this->datamember['id'];
						$point['id_resource'] = $_POST['x'];
						$point["created_date"] = date('Y-m-d H:i:s');
						$this->model_global->insert($point, 'voteposter');
						$qtot = $this->db->query("SELECT COUNT(id_resource) as vote FROM `voteposter` where  id_resource='".$_POST['x']."'")->result_array();
						$tot =  $qtot[0]['vote'];
						$ret['tot'] = "tot-".$_POST['x'];
						$ret['qtot'] = $tot;

						$sr = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array( 'id_posterchallenge' =>$_POST['x'],'status' =>1,'approve'=>1)));
						$voteawal = $sr['votes'] * 1;
						$up['votes'] = $voteawal + 1;
						$this->model_global->update($up, 'posterchallenge', array('id_posterchallenge' => $sr['id_posterchallenge']));

					}
				}
			}
		}else{
			$ret['message'] = "Please sign in or sign up before!";
		}
		echo json_encode($ret);
	}
}