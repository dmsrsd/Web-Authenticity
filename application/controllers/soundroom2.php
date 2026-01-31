<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Soundroom2 extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
	public function index(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom ";
		$data['kategori'] = $this->kategori;
		$data['soundroom'] = array();
		$data['galtot'] = count($data['soundroom']);

		$data['soundroomtop'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1,'a.top5'=>1),
			'order_by' => 'a.votes5 desc',
			'limit' => '5'
		));
		$data['soundroom'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.votes desc',
		));

		$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		$this->load->view('front/soundroom-header',$data);
		$this->load->view('front/soundroom-microsite-home',$data);
	}


	public function getBand(){
		$html = "";
		$where['status']=1;
		$where['approve']=1;
		$where['slug']=$_POST['band'];
		$ret['html'] = $html;
		$ret['status'] = "false";
		$row = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => $where));
		if($row['id_soundroom']!=""){
			$kota = $this->model_global->get_data(array('data' => 'row','table' => 'kota', 'where' => array( 'id_kota' =>$row['id_kota'])));
			$qtot = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='10' and id_resource='".$row['id_soundroom']."'")->result_array();
			$ret['vote'] =  $qtot[0]['vote'];
			$total =  $qtot[0]['vote'];
			$ret['kota'] =  $kota['kota'];
			$ret['status'] = "true";

			$okvote = "";
			$class = " ";
			$loved = "";

			if(empty($this->datamember)){
				$vote = "btn-votelogin btn-blue ";
			}else{
				$qsudah = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$row[id_soundroom]' and id_jenis_point='10' and id_member='".$this->datamember['id']."'")->result_array();
				$sudah =  $qsudah[0]['vote'];
				if($sudah > 0){
					$vote = "btn-votehave btn-red ";
					$loved = "true";
				}else{
					$qbrp = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='10' and id_member='".$this->datamember['id']."'  and date(created_date)=CURDATE() ")->result_array();
					$berapa =  $qbrp[0]['vote'];
					if($berapa=="2"){
						$vote = "btn-blue btn-votemax";
					}else{
						$vote = "btn-blue btn-vote";
						$okvote = "ok";
					}
				}
			}
			$html.="
			<div class='$class '>
				<div class='box-soundroom'>
					<div class='box-play'>
						<div class='frame' style=\"display:block;background:url('".base_url()."uploads/soundroom/$row[thumbnail]') center no-repeat; background-size:cover;\">
							<div class='helper'></div>
						</div>
					</div>
					<br>
					<div class='soundroom-data'>
						<h1><a href='".base_url()."soundroom/$row[slug]'>$row[judul]</a></h1>
						<h2>$kota[kota]<br><b><span id='tot-$row[id_soundroom]'>$total</span> Votes</b></h2>
					</div>
					<div class='row'>
						<div class='col-md-12'>
							<a class='btn btn-md btn-block $vote' id='btnv-$row[id_soundroom]' data-res='$row[id_soundroom]'><i class='fa fa-plus'></i> Vote &amp; Share</a>
						</div>
					</div>
				</div>
			</div>

			";

		}
		$ret['html'] = $html;
		$ret['loved'] = $loved;
		$ret['namaband'] = $row['judul'];
		$ret['img'] = base_url()."uploads/soundroom/$row[thumbnail]";
		echo json_encode($ret);

	}
	public function getPlayList(){
		$ret['firstaudio'] = "";
		$ret['firstband'] = "";
		$ret['firstprogress'] = "";
		$ret['html'] = "";
		$ret['status'] = "false";

		$where['a.status']=1;
		$where['a.approve']=1;
		if($_POST['kota']=="ALL"){

		}
		$soundroom = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => $where,
			'order_by' => 'a.votes desc',
		));
		$html="";
		$no=1;
		if(isset($soundroom) && count($soundroom) > 0){
			$ret['status'] = "true";
			$html.="<table width='100%' cellpadding='0' cellspacing='0' class='tbody'>";
			foreach($soundroom as $row){
				$active="";
				$bp="";
				if($no==5){$active="active";}
				if($no==1){$bp="bp1";}
				$html.= "<tr class='trbody  play-$row[slug] klikplaylist ' id='play-$row[slug]' data-no='$no' data-band='$row[slug]'>
					<td width='150' align='center'>
						<div class='noindex noindex-$row[slug]'>$no</div>
						<div class='playno playno-$row[slug] hide'>
							<a href='javascript:void(0);' onClick=\"currentplaytop(this)\" class='icon $bp' data-audio='".base_url()."uploads/soundroom/$row[sound]' data-band='$row[slug]' data-progress='prog-$row[id_soundroom]'><i class='fa fa-play'></i></a>
						</div>
					</td>
					<td>$row[judul]</td>
					<td width='200' align='center'>Play</td>
				</tr>
				";
				$no++;
			}
			$html.="</table>";
		}
		$ret['html'] = $html;
		echo json_encode($ret);

	}
	public function mechanism(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom ";
		$data['kategori'] = $this->kategori;
		$this->load->view('front/soundroom-header',$data);
		$this->load->view('front/soundroom-microsite-mechanism',$data);
	}
	public function indexold(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom ";
		$data['kategori'] = $this->kategori;
		$data['soundroom'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.votes desc',
			//'paging' => '12,0'
		));
		$data['galtot'] = count($data['soundroom']);
		$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/soundroom',$data);
	}
	public function dua(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom ";
		$data['kategori'] = $this->kategori;
		$data['soundroom'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.votes desc'
		));
		$data['galtot'] = count($data['soundroom']);
		$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		$this->load->view('front/podcast/header',$data);
		//$this->load->view('front/soundroom',$data);
		$this->load->view('front/soundroom2',$data);
	}

 	public function getGalleryLoader(){
		$response = array();
		$items = array();
		$row = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.votes desc'
		));
		$nv = 0;
		$okvote = "";
		$page = 0 ;
		if(isset($row) && count($row) > 0): foreach($row as $r):
			$query = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$r[id_soundroom]' and id_jenis_point='10'")->result_array();
			$total =  $query[0]['vote'];
			if(empty($this->datamember)){
				$vote = "btn-votelogin btn-blue ";
			}else{
				$qsudah = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$r[id_soundroom]' and id_jenis_point='10' and id_member='".$this->datamember['id']."'")->result_array();
				$sudah =  $qsudah[0]['vote'];
				if($sudah > 0){
					$vote = "btn-votehave btn-red ";
				}else{
					$qbrp = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='10' and id_member='".$this->datamember['id']."'  and date(created_date)=CURDATE() ")->result_array();
					$berapa =  $qbrp[0]['vote'];
					if($berapa=="2"){
						$vote = "btn-blue btn-votemax";
					}else{
						$vote = "btn-blue btn-vote";
						$okvote = "ok";
					}
				}
			}
			if( $nv % 12 ==0){
				$page++;
			}
			$thumb = base_url()."uploads/soundroom/".$r['thumbnail'];
			$img = base_url()."uploads/soundroom/".$r['thumbnail'];

			$html = "<article class='col-sm-3 lazyItem'><div class='lazyContent'>";
			$html.= "
			<div class=' by-$r[id_kota] all-soundroom page-$page'>
				<div class='box-soundroom'>
					<div class='box-play'>
						<div class='frame'>
							<div class='helper'><img src='".base_url()."uploads/soundroom/$r[thumbnail]' class='img-responsive' style='widths:100%;'></div>
						</div>
						<div class='overlay-play'>
							<a href='javascript:void(0);' id='play-$r[id_soundroom]' onClick='togglePlay()' class='icon' data-audio='a-$r[id_soundroom]' data-progress='prog-$r[id_soundroom]'><i class='fa fa-play' ></i> </a>
						</div>
						<audio id='a-$r[id_soundroom]' src='".base_url()."uploads/soundroom/$r[sound]'></audio>
						<div class='progress-play' id='prog-$r[id_soundroom]'></div>
						<div class='progress-srek'></div>
					</div>
					<div class='soundroom-data'>
						<h1><a href='".base_url()."soundroom/$r[slug]'>$r[judul]</a></h1>
						<h2>$r[kota]<br><b><span id='tot-$r[id_soundroom]'>$total</span> Votes</b></h2>
					</div>
					<div class='row'>
						<div class='col-md-12'>
							<a class='btn btn-md btn-block $vote' id='btnv-$r[id_soundroom]' data-res='$r[id_soundroom]'><i class='fa fa-plus'></i> Vote &amp; Share</a>
						</div>
					</div>
				</div>
			</div>

			";
			$html.= "</article>";
			$items[] = array("html"=>$html);

		$nv++;
		endforeach; endif;
		$response['items'] = $items;
		echo json_encode($response);
	}

	public function getsoundroom(){
		$ret['status'] = "false";
		$ret['message'] = "";
		if(isset($_POST['res'])){
			$data = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array( 'id_soundroom' =>$_POST['res'],'approve'=>1)));
			$kota = $this->model_global->get_data(array('data' => 'row','table' => 'kota', 'where' => array( 'id_kota' =>$data['id_kota'])));
			$qtot = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='10' and id_resource='".$_POST['res']."'")->result_array();
			$tot =  $qtot[0]['vote'];
			$desk = substr(str_replace("\n", '',strip_tags($data['deskripsi'])),0,100)." ...";
			$ret['status'] = "true";
			$ret['message'].="<div class='row'>";
			$ret['message'].="<div class='col-sm-6'><img src='".base_url()."uploads/soundroom/$data[thumbnail]' class='img-thumbnail'></div>";
			$ret['message'].="<div class='col-sm-6'><h3>$data[judul]</h3>";
			$ret['message'].="<b>$kota[kota]</b><br><br>";
			$ret['message'].="Share On :<br><br>";
			$ret['message'].="<a href='javascrip:void(0);' onclick=\"postArtikel('$desk','$data[judul]','".base_url()."uploads/soundroom/$data[thumbnail]','".base_url()."soundroom/$data[slug]')\" class='btn btn-sm btn-primary'><i class='fa fa-facebook'></i> Facebook</a>&nbsp; ";
			$ret['message'].="<a href='javascrip:void(0);' onclick=\"postArtikelTw('$desk','$data[judul]','".base_url()."uploads/soundroom/$data[thumbnail]','".base_url()."soundroom/$data[slug]')\" class='btn btn-sm btn-info'><i class='fa fa-twitter'></i> Twitter</a>";
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
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.votes desc'
		));
		$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		$data['detil'] = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array( 'slug' =>$slug,'approve'=>1)));

		if(count($data['detil'])==0){
			redirect(base_url()."soundroom");
		}else{
			$desk = substr(str_replace("\n", '',strip_tags($data['detil']['deskripsi'])),0,100)." ...";
			$data['subtitle'] = " | Soundroom - ".$data['detil']['judul'];
			$data['website']['meta_description'] = "Play this soundroom - ".$data['detil']['judul'].", ".$desk;
			$data['website']['meta_image'] = base_url()."uploads/soundroom/".$data['detil']['thumbnail'];
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/soundroom',$data);
		}
	}
	public function getpoint(){
		$ret['status'] = "false";
		$ret['message'] = "";
		if(!empty($this->datamember)){
			$maneh = $this->db->query("SELECT COUNT(id_soundroom) as vote FROM `soundroom` where id_soundroom='".$_POST['x']."' and created_by='".$this->datamember['id']."'")->result_array();
			$maneihlin =  $maneh[0]['vote'];
			if($maneihlin > 0){
				$ret['message'] = "You can't vote yourself!";
			}else{
				$qsudah = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='".$_POST['x']."' and id_jenis_point='10' and id_member='".$this->datamember['id']."'")->result_array();
				$sudah =  $qsudah[0]['vote'];
				if($sudah > 0){
					$ret['message'] = "You have voted for this contestant!";
				}else{
					$qbrp = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='10' and id_member='".$this->datamember['id']."' and date(created_date)=CURDATE() ")->result_array();
					$berapa =  $qbrp[0]['vote'];
					if($berapa=="2"){
						$ret['message'] = "The vote limit is only 2 times today!";
					}else{
						$ret['btnv'] = "btnv-".$_POST['x'];
						$ret['status'] = "true";
						$ret['message'] = "Thank you for your vote!";
						$point['id_member'] = $this->datamember['id'];
						$point['id_resource'] = $_POST['x'];
						$point['id_jenis_point'] = "10";
						$point["created_date"] = date('Y-m-d H:i:s');
						$this->model_global->insert($point, 'point');
						$qtot = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='10' and id_resource='".$_POST['x']."'")->result_array();
						$tot =  $qtot[0]['vote'];
						$ret['tot'] = "tot-".$_POST['x'];
						$ret['qtot'] = $tot;

						$sr = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array( 'id_soundroom' =>$_POST['x'],'status' =>1,'approve'=>1)));
						$voteawal = $sr['votes'] * 1;
						$up['votes'] = $voteawal + 1;
						$this->model_global->update($up, 'soundroom', array('id_soundroom' => $sr['id_soundroom']));

					}
				}
			}
		}else{
			$ret['message'] = "Please sign in or sign up before!";
		}
		echo json_encode($ret);
	}
}