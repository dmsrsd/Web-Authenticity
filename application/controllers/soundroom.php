<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Soundroom extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}

	public function share($id){
        $year = isset($_GET['year']) ? $_GET['year'] : '2023';

        if (!in_array($year, ['2025','2024', '2023', '2022', '2019'])) {
            $year = '2023';
        }

        switch ($year) {
            case '2025':
                $table = 'soundroom_2025';
                break;
            case '2024':
                $table = 'soundroom_2024';
                break;
            case '2022':
                $table = 'soundroom';
                break;
            case '2019':
                $table = 'soundroom_2019';
                break;
            default:
                $table = 'soundroom_2023';
                break;
        }
		
		// $data['soundroom'] = $this->model_global->get_data(array(
		// 	'data' => 'row',
		// 	'table' => $table,
		// 	'where' => array('id_soundroom'=> $id),
		// 	'limit' => '1'
		// ));
		$data['soundroom'] = $this->model_global->get_data(array(
			'data' => 'row',
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => $table.' a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.id_soundroom'=> $id),
			'limit' => '1'
		));
		//print_r($data['soundroom']); exit;
		$this->load->view('front/soundroom-share',$data);
	}

	public function index(){
		// tentukan tahun dari query string, default 2025
		$year = isset($_GET['year']) ? $_GET['year'] : '2025';

		// jika tahun tidak termasuk list yang diizinkan, redirect ke 2025
		if(!in_array($year, ['2025','2024','2023','2022'])){
			redirect(base_url()."soundroom?year=2025"); // redirect default ke tahun 2025
			return;
		}

        if (!in_array($year, ['2025','2024', '2023', '2022', '2019'])) {
            $year = '2023';
        }

        switch ($year) {
			case '2026':
        		$table = 'soundroom_2025';
        		break;
			case '2025':
                $table = 'soundroom_2025';
                break;
            case '2024':
                $table = 'soundroom_2024';
                break;
            case '2022':
                $table = 'soundroom';
                break;
            case '2019':
                $table = 'soundroom_2019';
                break;
            default:
                $table = 'soundroom_2023';
                break;
        }

		$data['year'] = $year;
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom ";
		$data['kategori'] = $this->kategori;
		$data['soundroom'] = array();
		$data['galtot'] = count($data['soundroom']);
		/*
		//-- soundroom-2019
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
		*/
		$data['soundroomtop'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => $table.' a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1,'a.top3'=>1),
			'where_in' => array('a.rank', array(2, 3, 4)),
			'order_by' => $year == '2023' ? 'a.rank asc' : 'a.top3 asc',
			'limit' => '3'
		));
		if ($year >= 2025){
			$data['soundroom'] = $this->model_global->get_data(array(
				'select' => 'a.*, b.kota,b.provinsi',
				'table' => $table.' a',
				'join' => array('kota b','b.id_kota = a.id_kota'),
				'where' => array('a.status'=>1,'a.approve'=>1,'a.rank !='=>0),
				'order_by' => 'a.top10 desc, a.rank asc',
				'paging' => '12,0'
			));
			// if($_GET['debug']){
			// 	print_r($data['soundroomtop']); exit;
			// }
		}else{
			$data['soundroom'] = $this->model_global->get_data(array(
				'select' => 'a.*, b.kota,b.provinsi',
				'table' => $table.' a',
				'join' => array('kota b','b.id_kota = a.id_kota'),
				'where' => array('a.status'=>1,'a.approve'=>1),
				'where_not_in' => array('a.rank', array(1, 2, 3, 4)),
				'order_by' => $year == '2023' ? 'a.top3 desc, a.rank asc' : 'a.top3 desc',
				'paging' => '12,0'
			));
		}
		$data['galtot'] = $this->db->get_where($table, array('status'=>1, 'approve'=>1))->num_rows();
		$data['galpage'] = ceil($data['galtot']/12);

		$data['video'] = $this->model_global->get_data(array('data' => 'row','table' => 'video', 'where' => array( 'top' =>1,'status'=>1)));
		// $data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		// $data['provinsi'] = $this->model_global->get_data(array('select ' => 'DISTINCT(provinsi)', 'table' => 'kota', 'order_by' => 'provinsi asc'));
		$this->db->distinct();
		$this->db->select('provinsi');
		$this->db->order_by('provinsi', 'asc');
		$data['provinsi'] = $this->db->get('kota')->result_array();
		$this->load->view('front/soundroom-header',$data);
		$this->load->view('front/soundroom-microsite-home',$data);
	}

	public function winner(){
        $year = isset($_GET['year']) ? $_GET['year'] : '2023';

        if (!in_array($year, ['2025','2024','2023', '2022', '2019'])) {
            $year = '2023';
        }

        switch ($year) {
			case '2025':
                $table = 'soundroom_2025';
                break;
			case '2024':
                $table = 'soundroom_2024';
                break;
            case '2022':
                $table = 'soundroom';
                break;
            case '2019':
                $table = 'soundroom_2019';
                break;
            default:
                $table = 'soundroom_2023';
                break;
        }

		$data['year'] = $year;
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom ";
		$data['kategori'] = $this->kategori;
		$data['soundroom'] = array();
		$data['galtot'] = count($data['soundroom']);
		/*
		//-- soundroom-2019
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
		*/

		$data['soundroomtop'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => $table.' a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1,'a.top3'=>1),
			'order_by' => $year == '2023' ? 'a.rank asc' : 'a.top3 asc',
			'limit' => '3'
		));
		$data['soundroom'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => $table.' a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.id_soundroom desc',
			'paging' => '12,0'
		));
		$data['galtot'] = $this->db->get_where($table, array('status'=>1, 'approve'=>1))->num_rows();
		$data['galpage'] = ceil($data['galtot']/12);

		$data['video'] = $this->model_global->get_data(array('data' => 'row','table' => 'video', 'where' => array( 'top' =>1,'status'=>1)));
		// $data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
		// $data['provinsi'] = $this->model_global->get_data(array('select ' => 'DISTINCT(provinsi)', 'table' => 'kota', 'order_by' => 'provinsi asc'));
		$this->db->distinct();
		$this->db->select('provinsi');
		$this->db->order_by('provinsi', 'asc');
		$data['provinsi'] = $this->db->get('kota')->result_array();
		$this->load->view('front/soundroom-header',$data);
		$this->load->view('front/soundroom-microsite-winner',$data);
	}

	public function search(){
        $year = isset($_GET['year']) ? $_GET['year'] : '2023';

        if (!in_array($year, ['2025','2024','2023', '2022', '2019'])) {
            $year = '2023';
        }

        switch ($year) {
			case '2025':
                $table = 'soundroom_2025';
                break;
			case '2024':
                $table = 'soundroom_2024';
                break;
            case '2022':
                $table = 'soundroom';
                break;
            case '2019':
                $table = 'soundroom_2019';
                break;
            default:
                $table = 'soundroom_2023';
                break;
        }

        $data['year'] = $year;
        $data['video'] = array();
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom Search ";
		if(isset($_POST['txtsearch'])){
			$data['search'] = $_POST['txtsearch'];

			$data['soundroom'] = $this->model_global->get_data(array(
				'select' => 'a.*, b.kota,b.provinsi',
				'table' => $table.' a',
				'join' => array('kota b','b.id_kota = a.id_kota'),
				'where' => array('a.status'=>1,'a.approve'=>1),
				'like' => array('a.judul'=>$data['search']),
				'order_by' => 'a.id_soundroom desc',
				'paging' => '12,0'
			));
			$data['galtot'] = $this->db->like('judul', $data['search'])->get_where($table, array('status'=>1, 'approve'=>1))->num_rows();
			$data['galpage'] = ceil($data['galtot']/12);
			$data['galtot'] = count($data['soundroom']);

			// $data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
			$data['provinsi'] = $this->db->query("SELECT provinsi FROM kota GROUP BY provinsi ORDER BY provinsi asc")->result_array();
			$this->load->view('front/soundroom-header',$data);
			$this->load->view('front/soundroom-microsite-search',$data);
		}else{
			redirect(base_url()."soundroom");
		}
	}

	public function getGallery(){
		$data_page = 0;
		if( isset($_POST['data_page']) && $_POST['data_page']!='' ){
			$data_page = intval($_POST['data_page']);
		}

		$data_kota = '';
		if( isset($_POST['search']) && $_POST['search']!='' ){
			$data_kota = $_POST['search'];
		}

		$ret['status'] = "false";
		// $ret['new_page'] = "false";
		$limit = 12;
		$offset = $limit * $data_page;

        $year = isset($_POST['year']) ? $_POST['year'] : '2024';

        if (!in_array($year, ['2025','2024','2023', '2022', '2019'])) {
            $year = '2023';
        }

        switch ($year) {
			case '2025':
                $table = 'soundroom_2025';
                break;
			case '2024':
                $table = 'soundroom_2024';
                break;
            case '2022':
                $table = 'soundroom';
                break;
            case '2019':
                $table = 'soundroom_2019';
                break;
            default:
                $table = 'soundroom_2023';
                break;
        }


		$arr_kota = [];
		if(isset($_POST['search']) && $_POST['search']!=''){
			$prov = $_POST['search'];

			$this->db->order_by('kota asc');
			$cari_kota = $this->db->get_where('kota', array('provinsi'=>$prov));
			if($cari_kota->num_rows()>0){
				foreach($cari_kota->result() as $key=>$dt){
					$arr_kota[] = $dt->id_kota;
				}
			}
		}

		if( isset($_POST['data_filter']) && $_POST['data_filter']!='' ){
			$arr_kota = [];
			$arr_kota[] = intval($_POST['data_filter']);
		}


		$this->db->select('s.*, k.kota, k.provinsi');
		$this->db->from($table.' s');
		$this->db->join('kota k', 'k.id_kota = s.id_kota');
		if(count($arr_kota)>0){
			$this->db->where_in('s.id_kota', $arr_kota);
			// $ret['new_page'] = "true";
		}
		$this->db->where('s.approve', 1);
		$this->db->where('s.status', 1);

		if ($year == '2023' || $year == '2025') {
			$this->db->order_by('s.top3 desc, s.rank asc');
		} else {
			$this->db->order_by('s.top3 desc');
		}

		$galtot = $this->db->get()->num_rows();
		// var_dump($galtot);

		$this->db->select('s.*, k.kota, k.provinsi');
		$this->db->from($table.' s');
		$this->db->join('kota k', 'k.id_kota = s.id_kota');
		if(count($arr_kota)>0){
			$this->db->where_in('s.id_kota', $arr_kota);
			// $ret['new_page'] = "true";
		}
		$this->db->where('s.approve', 1);
		$this->db->where('s.status', 1);

		if ($year == '2023' || $year == '2025') {
			$this->db->order_by('s.top3 desc, s.rank asc');
		} else {
			$this->db->order_by('s.top3 desc');
		}

		$this->db->limit($limit, $offset);
		$soundroom = $this->db->get();
		// var_dump($soundroom->num_rows());
		// die();



		//-- paging --
		$galpage = ceil($galtot/12);
		$next_page = intval($data_page) + 1;
		$ret['next_page'] = $next_page;
		if($next_page >= $galpage){
			$ret['next_page'] = '';
		}

		$soundroom_more = $soundroom->result_array();
		// var_dump( count($soundroom_more) ); die();

		$top15 = range(9, 15);
		$top7 = range(2, 8);

		$html = "";
        if (count($soundroom_more) > 0) {
            foreach($soundroom_more as $key=>$row){
                $link_ig = $link_yt = $link_spotify = '';
                $slug = str_replace(array(' ', '.'), '-', $row['slug']);
                if(isset($row['instagram']) && $row['instagram']!=''){
                    $link_ig = "<a href='".$row['instagram']."' target='_blank'><img src='". base_url() ."assets/front/img/soundroom/instagram.png'></a>";
                }
                if(isset($row['youtube']) && $row['youtube']!=''){
                    $link_yt = "<a href='".$row['youtube']."' target='_blank'> <img src='". base_url() ."assets/front/img/soundroom/youtube.png'> </a>";
                }
                if(isset($row['spotify']) && $row['spotify']!=''){
                    $link_spotify = "<a href='".$row['spotify']."' target='_blank'><img src='". base_url() ."assets/front/img/soundroom/spotify.png'></a>";
                }
                $html .=
                    "<div class='col-lg-2 col-md-4 col-sm-4'>
				<div class='box-soundroom'>";

				if ($row['top3'] == 1 && isset($row['rank'])) {
					if (in_array($row['rank'], $top15)) {
						$html .= "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-15.svg'></div>";
					} elseif (in_array($row['rank'], $top7)) {
						$html .= "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-7.png'></div>";
					} elseif ($row['rank'] == 1) {
						$html .= "<div class='badge-winner'><img class='golden' src='". base_url() ."assets/front/img/soundroom/badge-golden.svg'></div>";
					}
				}
				if ($year >= '2024') { //buat if jika 2024 ke atas bisa share
					if ($year == '2025' && isset($row['top10']) && $row['top10'] == 1) {
						$html .= "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-10.png'></div>";
					}
					$url_share = base_url()."soundroom/share/".$row['id_soundroom']."?year=".$year."&utm_source=sroom24&utm_medium=sroom24visitor&utm_campaign=sr24".$row['judul']."&utm_id=sroom24visitor&utm_term=sroom24visitor";
					$html .= "<div class='box-play'>
							<div class='frame' style=\"display:block;background:url('".base_url()."uploads/soundroom/$row[thumbnail]') center no-repeat; background-size:cover;\">
								<div class='helper'></div>
							</div>
							<div class='overlay-play'>
								<a href='javascript:void(0);' id='play-$row[id_soundroom]' class='icon' onClick=\"jumpPlay('$row[id_soundroom]')\" data-band=\"$slug\" data-slug='$row[slug]' style='left: 30%;'><i class='fa fa-play' ></i> </a>
								<a href='" . $url_share . "' class='icon' style='left: 70%;'><i class='fa fa-share' ></i> </a>
							</div>
							<audio class='audio5' id='a-$row[id_soundroom]' src='".base_url()."uploads/soundroom/$row[sound]'></audio>
							<div class='progress-play' id='prog-$row[id_soundroom]'></div>
						</div>
						<div class='soundroom-data'>
							<div class='row align-items-center'>
								<div class='col-8'>
									<div class='soundroom-data__title'>
										<h1><a href='javascript:void(0);' onClick=\"jumpPlay('$row[id_soundroom]')\">$row[judul]</a></h1>
										<h2 >$row[kota]</h2>";
				}else{
					$html .= "<div class='box-play'>
						<div class='frame' style=\"display:block;background:url('".base_url()."uploads/soundroom/$row[thumbnail]') center no-repeat; background-size:cover;\">
							<div class='helper'></div>
						</div>
						<div class='overlay-play'>
							<a href='javascript:void(0);' id='play-$row[id_soundroom]' class='icon' onClick=\"jumpPlay('$row[id_soundroom]')\" data-band=\"$slug\" data-slug='$row[slug]'><i class='fa fa-play' ></i> </a>
						</div>
						<audio class='audio5' id='a-$row[id_soundroom]' src='".base_url()."uploads/soundroom/$row[sound]'></audio>
						<div class='progress-play' id='prog-$row[id_soundroom]'></div>
					</div>
					<div class='soundroom-data'>
						<div class='row align-items-center'>
							<div class='col-8'>
								<div class='soundroom-data__title'>
									<h1><a href='javascript:void(0);' onClick=\"jumpPlay('$row[id_soundroom]')\">$row[judul]</a></h1>
									<h2 >$row[kota]</h2>";
				}
				if ($row['top3'] == 1 && isset($row['rank']) && in_array($row['rank'], $top15)) {
					$html .= "<p class='badge-winner-text'>Top 15</p>";
				}

				$html .= "</div>
							</div>
							<div class='col-4'>
								<div class='dropup'>
									<a href='#' class='dropdown-toggle text-end d-block' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
										<i class='fa fas fa-ellipsis-h'></i>
									</a>
									<div class='dropdown-menu dropdown-menu-right'>
										<div class='soundroom-data__socmed'>
											".$link_ig.$link_yt.$link_spotify."
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>";
            }
        } else {
            $html .= "
                <div class='col-md-12'>
                    <div class='soundroom-data'>
						<div class='text-center'>
						    <h3>Belum ada band yang ikutan dari kota ini.</h3>
						</div>
                    </div>
                </div>
            ";
        }

		$ret['html'] = $html;
		$ret['status'] = "true";

		echo json_encode($ret);
	}

	public function getBand(){
        $year = isset($_POST['year']) ? $_POST['year'] : '2024';

        if (!in_array($year, ['2025','2024','2023', '2022', '2019'])) {
            $year = '2023';
        }

        switch ($year) {
			case '2025':
                $table = 'soundroom_2025';
                break;
			case '2024':
                $table = 'soundroom_2024';
                break;
            case '2022':
                $table = 'soundroom';
                break;
            case '2019':
                $table = 'soundroom_2019';
                break;
            default:
                $table = 'soundroom_2023';
                break;
        }

		$html = "";
		$where['status']=1;
		$where['approve']=1;
		$where['slug']=$_POST['band'];
		$ret['html'] = $html;
		$ret['status'] = "false";
		$row = $this->model_global->get_data(array('data' => 'row','table' => $table, 'where' => $where));
		if(isset($row['id_soundroom']) && $row['id_soundroom']!=""){
			$kota = $this->model_global->get_data(array('data' => 'row','table' => 'kota', 'where' => array( 'id_kota' =>$row['id_kota'])));
			$qtot = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='10' and id_resource='".$row['id_soundroom']."'")->result_array();
			$ret['vote'] =  $qtot[0]['vote'];
			$ret['vote'] =  $row['votes'];
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
            $slug = str_replace(array(' ', '.'), '-', $row['slug']);
			$top15 = range(9, 15);
			$top7 = range(2, 8);
			$html.="
			<div class='$class '>
				<div class='box-soundroom'>";

			if ($row['top3'] == 1 && isset($row['rank'])) {
				if (in_array($row['rank'], $top15)) {
					$html .= "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-15.svg'></div>";
				} elseif (in_array($row['rank'], $top7)) {
					$html .= "<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-7.png'></div>";
				} elseif ($row['rank'] == 1) {
					$html .= "<div class='badge-winner'><img class='golden' src='". base_url() ."assets/front/img/soundroom/badge-golden.svg'></div>";
				}
			}
			
			$html.="<div class='box-play'>
						<div class='frame' style=\"display:block;background:url('".base_url()."uploads/soundroom/$row[thumbnail]') center no-repeat; background-size:cover;\">
							<div class='helper'></div>
						</div>
						<audio id='a1-$row[id_soundroom]' src='".base_url()."uploads/soundroom/$row[sound]'></audio>
						<div class='progress-play' id='prog1-$row[id_soundroom]'></div>
					</div>
					<div class='soundroom-data text-center'>
						<h1><a id='play-$row[id_soundroom]' href='javascript:void(0);' onClick=\"jumpPlay('$row[id_soundroom]')\" data-band=\"$slug\" data-slug='$row[slug]'>$row[judul]</a></h1>
						<h2>$kota[kota]</h2>
					</div>
				</div>
			</div>

			";

		}
		$ret['html'] = $html;
		$ret['loved'] = $loved;
		$ret['namaband'] = $row['judul'];
		$ret['slug'] = $row['slug'];
		$ret['img'] = base_url()."uploads/soundroom/$row[thumbnail]";
		$ret['sound'] = base_url()."uploads/soundroom/$row[sound]";
		$ret['soundid'] = $row['id_soundroom'];
		echo json_encode($ret);

	}

	public function getPlayList_2019(){
		$ret['firstaudio'] = "";
		$ret['firstband'] = "";
		$ret['firstprogress'] = "";
		$ret['html'] = "";
		$ret['status'] = "false";

		$where['a.status']=1;
		$where['a.approve']=1;
		$where['a.status']=1;
		$where['a.approve']=1;
		$kota = "ALL";
		if($_POST['kota']!="ALL"){
			$where['b.id_kota']=$_POST['kota'];
			$kota = $_POST['kota'];
		}
		if($_POST['start']!='ALL'){
			$next = ($_POST['end']=='ALL') ? 1 : $_POST['end'] + 1;
			$paging = "12,".($next -1) * 12;
		}else{
			$next = 1;
			$paging = "12,0";
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
		$pl=1;

		if(isset($soundroom) && count($soundroom) > 0){
			$ret['status'] = "true";
			$html.="<table width='100%' cellpadding='0' cellspacing='0' class='tbody'>";
			foreach($soundroom as $row){
				$path = "uploads/soundroom/$row[sound]";
				if(file_exists($path)){
					$active="";
					$bp="";
					if($no==5){$active="active";}
					if($no==1){$bp="bp1";}
					$html.= "<tr class='trbody  play-$row[slug] klikplaylist ' id='play-$row[slug]' data-no='$no' data-band='$row[slug]' data-slug='$row[slug]'>
						<td width='150' align='center'>
							<div class='noindex noindex-$row[slug]'>$no</div>
							<div class='playno playno-$row[slug] hide'>
								<a href='javascript:void(0);' onClick=\"currentplaytop(this)\" class='icon $bp pl-$no idpl-$row[id_soundroom]' data-now='$no' data-audio1='a1-$row[id_soundroom]' data-audio='".base_url()."uploads/soundroom/$row[sound]' data-band='$row[slug]' data-slug='$row[slug]' data-progress='prog-$row[id_soundroom]' data-progress1='prog1-$row[id_soundroom]'><i class='fa fa-play'></i></a>
							</div>
						</td>
						<td>$row[judul]</td>
						<td width='200' align='center'>Play</td>
					</tr>
					";
					$no++;
					$pl++;
				}
			}
			$html.="</table>";
		}
		$ret['pl'] = $pl-1;
		$ret['html'] = $html;
		echo json_encode($ret);

	}

	public function getPlayList(){
        $year = isset($_POST['year']) ? $_POST['year'] : '2025';

        if (!in_array($year, ['2025','2024','2023', '2022', '2019'])) {
            $year = '2023';
        }

        switch ($year) {
			case '2025':
                $table = 'soundroom_2025';
                break;
			case '2024':
                $table = 'soundroom_2024';
                break;
            case '2022':
                $table = 'soundroom';
                break;
            case '2019':
                $table = 'soundroom_2019';
                break;
            default:
                $table = 'soundroom_2023';
                break;
        }

		$ret['firstaudio'] = "";
		$ret['firstband'] = "";
		$ret['firstprogress'] = "";
		$ret['html'] = "";
		$ret['status'] = "false";

		// $where['a.status']=1;
		// $where['a.approve']=1;
		// $where['a.status']=1;
		// $where['a.approve']=1;
		$kota = isset($_POST['kota']) ? $_POST['kota'] : 'ALL';
		if($kota !== "ALL" && $kota !== ""){
			$where['b.id_kota'] = $kota;
		}
		$start = isset($_POST['start']) ? $_POST['start'] : 'ALL';
		$end = isset($_POST['end']) ? $_POST['end'] : 'ALL';
		if($start !== 'ALL'){
			$next = ($end === 'ALL') ? 1 : ((int) $end + 1);
			$paging = "12,".($next -1) * 12;
		}else{
			$next = 1;
			$paging = "12,0";
		}
		/*
		$soundroom = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => $where,
			'order_by' => 'a.votes desc',
		));
		*/

		$arr_kota = [];
		if(isset($_POST['search'])){
			$prov = $_POST['id'];

			$this->db->order_by('kota asc');
			$cari_kota = $this->db->get_where('kota', array('provinsi'=>$prov));
			if($cari_kota->num_rows()>0){
				foreach($cari_kota->result() as $key=>$dt){
					$arr_kota[] = $dt->id_kota;
				}
			}
		}

		if($kota !== "ALL" && $kota !== ""){
			$arr_kota[] = $kota;
		}

		$this->db->select('s.*, k.kota, k.provinsi');
		$this->db->from($table.' s');
		$this->db->join('kota k', 'k.id_kota = s.id_kota');
		if(count($arr_kota)>0){
			$this->db->where_in('s.id_kota', $arr_kota);
		}
        if (isset($_POST['artist']) && $_POST['artist'] != '') {
            $this->db->like('s.judul', $_POST['artist']);
        }
		$this->db->where('s.approve', 1);
		$this->db->where('s.status', 1);
		if(isset($_POST['genre']) && $_POST['genre'] != '' && $year == '2023' ){
			$this->db->where('s.gendre', $_POST['genre']);
		}
		if(isset($_POST['genre']) && $_POST['genre'] != '' && $year == '2024' ){
			$this->db->where('s.gendre', $_POST['genre']);
		}
		if(isset($_POST['genre']) && $_POST['genre'] != '' && $year == '2025' ){
			$this->db->where('s.gendre', $_POST['genre']);
		}

		if ($year == '2023') {
			$this->db->order_by('s.top3 desc, s.rank asc');
		} elseif ($year == '2024') {
			$this->db->order_by('s.top3 desc, s.rank asc');
		} elseif ($year == '2025') {
			//$this->db->group_by('sjudul');
			$this->db->order_by('s.top3 desc, s.rank asc');
		} else {
			$this->db->order_by('s.top3 desc');
		}
		//tambahan karena ga kuat load semua data
		//$this->db->limit(500, 0); 
		$soundroom = $this->db->get()->result_array();

		$html="";
		$no=1;
		$pl=1;

		if(isset($soundroom) && count($soundroom) > 0){
            $this->load->library('mp3file');
            $this->load->library('mp3info');
            $lib_version = 1;
			//$lib_version = 2;
			$ret['status'] = "true";
			// $top15 = range(9, 15);
			// $top7 = range(2, 8);
			$top15 = range(14, 16);
			$top12 = range(2, 13);
			$top7 = range(2, 8);
			$html.="<table width='100%' cellpadding='0' cellspacing='0' class='tbody'>";
			foreach($soundroom as $row){
				$filename = isset($row['sound']) ? (string) $row['sound'] : '';
				$path = "uploads/soundroom/".$filename;
				$fullpath = FCPATH.$path;
				$duration = '-';
				if($filename !== '' && is_file($fullpath)){
                    if ($lib_version == 1) {
                        $stats = $this->mp3file->set_file(FCPATH.'uploads/soundroom/'.$row['sound'])->get_metadata();
                        $duration = isset($stats['Length mm:ss']) ? $stats['Length mm:ss'] : '-';

                        if ($duration == '-') {
                            $length = (int) (isset($stats['Length']) ? $stats['Length'] : '0');

                            if ($length > 0) {
                                $menit = floor($length / 60);
                                $detik = $length - ($menit * 60);

                                if ($detik > 60) {
                                    $menit = $menit + 1;
                                    $detik = $detik - 60;
                                }

                                $duration = $menit.':'.$detik;
                            }
                        }
                    } else {
                        $this->mp3info->resetMetadata();
                        $stats = $this->mp3info->getMetadata(FCPATH.'uploads/soundroom/'.$row['sound'], true);
                        $duration = '-';

                        if ($stats) {
                        	$minutes = floor($stats->duration % 60);

                        	if (strlen($minutes) == 1) {
                        		$minutes = '0'.$minutes;
                        	}

                            $duration = floor($stats->duration / 60).':'.$minutes;
                        }
                    }

					$active="";
					$bp="";
                    $slug = str_replace(array(' ', '.'), '-', $row['slug']);
					if($no==5){$active="active";}
					if($no==1){$bp="bp1";}
					$html.= "<tr class='trbody  play-$slug klikplaylist ' id='play-$slug' data-no='$no' data-band='$slug' data-slug='$row[slug]'>
						<td width='150' align='center'>
							<div class='noindex noindex-$slug'>$no</div>
							<div class='playno playno-$slug hide'>
								<a href='javascript:void(0);' onClick=\"currentplaytop(this)\" class='icon $bp pl-$no idpl-$row[id_soundroom]' data-now='$no' data-audio1='a1-$row[id_soundroom]' data-audio='".base_url()."uploads/soundroom/$row[sound]' data-band='$slug' data-slug='$row[slug]' data-progress='prog-$row[id_soundroom]' data-progress1='prog1-$row[id_soundroom]'><i class='fa fa-play'></i></a>
							</div>
						</td>
						<td>
							<div class='d-flex align-items-center'>
								$row[judul]";
					if ($year >= '2024') { //buat if jika 2024 ke atas
						if ($row['top3'] == 1 && isset($row['rank'])) {
							if ($row['rank'] == 1) {
								$html .= "<div class='badge-winner badge-winner--table'><img class='golden' src='". base_url() ."assets/front/img/soundroom/badge-12.png'></div>";
							}else{
								$html .= "<div class='badge-winner badge-winner--table'><img src='". base_url() ."assets/front/img/soundroom/badge-12.png'></div>";
							}
						}
					}else{
						if ($row['top3'] == 1 && isset($row['rank'])) {
							if (in_array($row['rank'], $top15)) {
								$html .= "<div class='badge-winner badge-winner--table'><img src='". base_url() ."assets/front/img/soundroom/badge-15.svg'></div>";
							} elseif (in_array($row['rank'], $top7)) { //dimatikan sementara
								$html .= "<div class='badge-winner badge-winner--table'><img src='". base_url() ."assets/front/img/soundroom/badge-7.png'></div>";
							} elseif ($row['rank'] == 1) {
								$html .= "<div class='badge-winner badge-winner--table'><img class='golden' src='". base_url() ."assets/front/img/soundroom/badge-golden.svg'></div>";
							}
						}
					}

							$html.= "</div>
						</td>
						<td width='200' align='center'>".$duration."</td>
					</tr>
					";
					$no++;
					$pl++;
				}
			}
			$html.="</table>";
		}
		$ret['pl'] = $pl-1;
		$ret['html'] = $html;
		echo json_encode($ret);
	}

	public function getPlayList2(){
		$ret['firstaudio'] = "";
		$ret['firstband'] = "";
		$ret['firstprogress'] = "";
		$ret['html'] = "";
		$ret['status'] = "false";
		$ret['pesan'] = "";

		$where['a.status']=1;
		$where['a.approve']=1;
		$kota = "ALL";
		if($_POST['kota']!="ALL"){
			$where['b.id_kota']=$_POST['kota'];
			$kota = $_POST['kota'];
		}
		if($_POST['start']!='ALL'){
			$next = ($_POST['end']=='ALL') ? 1 : $_POST['end'] + 1;
			$paging = "12,".($next -1) * 12;
		}else{
			$next = 1;
			$paging = "12,0";
		}
		$ret['next'] = $next;
		$ret['kota'] = $kota;
		if(isset($_POST['search'])){
			$soundroom = $this->model_global->get_data(array(
				'select' => 'a.*, b.kota,b.provinsi',
				'table' => 'soundroom a',
				'join' => array('kota b','b.id_kota = a.id_kota'),
				'where' => $where,
				'like' => array('a.judul'=> $_POST['search']),
				'order_by' => 'a.votes desc',
				'paging'=>$paging
			));
		}else{
			$soundroom = $this->model_global->get_data(array(
				'select' => 'a.*, b.kota,b.provinsi',
				'table' => 'soundroom a',
				'join' => array('kota b','b.id_kota = a.id_kota'),
				'where' => $where,
				'order_by' => 'a.votes desc',
				'paging'=>$paging
			));

		}
		$nv = 0;
		$okvote = "";
		$page = 0 ;
		$vote = "btn-votelogin btn-blue ";
		if(isset($soundroom) && count($soundroom) > 0){
			$ret['status'] = "true";
			foreach($soundroom as $row){
				$query = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$row[id_soundroom]' and id_jenis_point='10'")->result_array();
				$total =  $query[0]['vote'];
				$total =  $row['votes'];
				if(empty($this->datamember)){
					$vote = "btn-votelogin btn-blue ";
				}else{
					$qsudah = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$row[id_soundroom]' and id_jenis_point='10' and id_member='".$this->datamember['id']."'")->result_array();
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
				$ret['html'].= "
				<div class='col-md-2 col-sm-4 by-$row[id_kota] all-soundroom'>
					<div class='box-soundroom'>
						<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-15.svg'></div>
						<div class='box-play'>
							<div class='frame'>
								<div class='helper'><img src='".base_url()."uploads/soundroom/$row[thumbnail]' class='img-responsive' style='widths:100%;'></div>
							</div>
							<div class='overlay-play'>
								<a href='javascript:void(0);' id='play-$row[id_soundroom]' onClick='togglePlay()' class='icon' data-audio='a-$row[id_soundroom]' data-progress='prog-$row[id_soundroom]'><i class='fa fa-play' ></i> </a>
							</div>
							<audio id='a-$row[id_soundroom]' src='".base_url()."uploads/soundroom/$row[sound]'></audio>
							<div class='progress-play' id='prog-$row[id_soundroom]'></div>
							<div class='progress-srek'></div>
						</div>
						<div class='soundroom-data'>
							<h1><a href='".base_url()."soundroom/$row[slug]'>$row[judul]</a></h1>
							<h2>$row[kota]<br><b><span id='tot-$row[id_soundroom]'>$total</span> Votes</b></h2>
						</div>
						<div class='row'>
							<div class='col-md-12'>
								<a class='btn btn-md btn-block $vote' id='btnv-$row[id_soundroom]' data-res='$row[id_soundroom]'><i class='fa fa-plus'></i> Vote &amp; Share</a>
							</div>
						</div>
					</div>
				</div>

				";
				$nv++;
			}
		}else{
			$ret['pesan'] = "<div align='center' class='alert alert-warning'>Tidak ada data </div>";
		}
		echo json_encode($ret);
	}

	public function mechanism(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom ";
		$data['kategori'] = $this->kategori;
		$this->load->view('front/soundroom-header',$data);
		$this->load->view('front/soundroom-microsite-mechanism',$data);
	}

	public function video(){
		$data['website'] = $this->website;
		$data['subtitle'] = " | Soundroom ";
		$data['kategori'] = $this->kategori;
		$data['top'] = $this->model_global->get_data(array('data' => 'row','table' => 'video', 'where' => array( 'top' =>1,'status'=>1)));
		$data['video'] = $this->model_global->get_data(array('select' => '*', 'table' => 'video','order_by' => 'id_video desc','where'=>array('top'=>0)));

		$this->load->view('front/soundroom-header',$data);
		$this->load->view('front/soundroom-microsite-video',$data);
	}

	public function vote(){
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

		$this->load->view('front/soundroom-header',$data);
		$this->load->view('front/soundroom-microsite-vote',$data);
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
		$this->load->view('front/soundroom',$data);
	}

 	public function getGalleryLoader(){
		$response = array();
		$items = array();
		$row = $this->model_global->get_data(array(
			'select' => 'a.*, b.kota,b.provinsi',
			'table' => 'soundroom a',
			'join' => array('kota b','b.id_kota = a.id_kota'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.top3 desc'
		));
		$nv = 0;
		$okvote = "";
		$page = 0 ;
		if(isset($row) && count($row) > 0): foreach($row as $r):
			$query = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='$r[id_soundroom]' and id_jenis_point='10'")->result_array();
			$total =  $query[0]['vote'];
			$total =  $r['votes'];
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
					<div class='badge-winner'><img src='". base_url() ."assets/front/img/soundroom/badge-15.svg'></div>
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
		$jenispoint = ($_POST['x']==$_POST['dtp']) ? "28" : "10";
		$updatevotes = ($_POST['x']==$_POST['dtp']) ? "votes5" : "votes";
		$top5 = ($_POST['x']==$_POST['dtp']) ? "1" : "";

		if(!empty($this->datamember)){
			$maneh = $this->db->query("SELECT COUNT(id_soundroom) as vote FROM `soundroom` where id_soundroom='".$_POST['x']."' and created_by='".$this->datamember['id']."'")->result_array();
			$maneihlin =  $maneh[0]['vote'];
			if($maneihlin > 0){
				$ret['message'] = "You can't vote yourself!";
			}else{
				$qsudah = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_resource='".$_POST['x']."' and id_jenis_point='$jenispoint' and id_member='".$this->datamember['id']."'")->result_array();
				$sudah =  $qsudah[0]['vote'];
				if($sudah > 0){
					$ret['message'] = "You have voted for this contestant!";
				}else{
					$qbrp = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='$jenispoint' and id_member='".$this->datamember['id']."' and date(created_date)=CURDATE() ")->result_array();
					$berapa =  $qbrp[0]['vote'];
					if($berapa=="2"){
						$ret['message'] = "The vote limit is only 2 times today!";
					}else{
						$ret['btnv'] = "btnv-".$_POST['x'];
						$ret['status'] = "true";
						$ret['message'] = "Thank you for your vote!";
						$point['id_member'] = $this->datamember['id'];
						$point['id_resource'] = $_POST['x'];
						$point['id_jenis_point'] = "$jenispoint";
						$point["created_date"] = date('Y-m-d H:i:s');
						$this->model_global->insert($point, 'point');
						$qtot = $this->db->query("SELECT COUNT(id_resource) as vote FROM `point` where id_jenis_point='$jenispoint' and id_resource='".$_POST['x']."'")->result_array();
						$tot =  $qtot[0]['vote'];
						$ret['tot'] = "tot-".$_POST['x'];
						$ret['qtot'] = $tot;

						$sr = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array( 'id_soundroom' =>$_POST['x'],'status' =>1,'approve'=>1)));
						$voteawal = $sr[$updatevotes] * 1;
						$up[$updatevotes] = $voteawal + 1;
						$this->model_global->update($up, 'soundroom', array('id_soundroom' => $sr['id_soundroom'],'top5'=>$top5));

					}
				}
			}
		}else{
			$ret['message'] = "Please sign in or sign up before!";
		}
		echo json_encode($ret);
	}

	//-- tambahan 2022
	public function filter_byprovinsi(){
			$ret["status"] = "false";
			$arr_kota = array();

			if(isset($_POST['search'])){
				$prov = $_POST['id'];

				$this->db->order_by('kota asc');
				$cari_kota = $this->db->get_where('kota', array('provinsi'=>$prov));
				if($cari_kota->num_rows()>0){
					foreach($cari_kota->result() as $key=>$dt){
						$arr_kota[] = $dt->id_kota;
					}
				}

				if(count($arr_kota)>0){
					// $ret["data"] = $arr_kota;

					$ret['firstaudio'] = "";
					$ret['firstband'] = "";
					$ret['firstprogress'] = "";
					$ret['html'] = "";

					$where['a.status']=1;
					$where['a.approve']=1;
					$where['a.status']=1;
					$where['a.approve']=1;
					$kota = "ALL";

					$this->db->select('soundroom.*, kota.kota, kota.provinsi');
					$this->db->from('soundroom');
					$this->db->join('kota', 'kota.id_kota = soundroom.id_kota');
					$this->db->where_in('soundroom.id_kota', $arr_kota);
					$this->db->where('soundroom.approve', 1);
					$this->db->where('soundroom.approve', 1);
					$this->db->order_by('soundroom.votes desc');
					$soundroom = $this->db->get()->result_array();

					$html="";
					$no=1;
					$pl=1;
					if(isset($soundroom) && count($soundroom) > 0){
						$ret['status'] = "true";
						$html.="<table width='100%' cellpadding='0' cellspacing='0' class='tbody'>";
						foreach($soundroom as $row){
							$path = "uploads/soundroom/$row[sound]";
							if(file_exists($path)){
								$active="";
								$bp="";
								if($no==5){$active="active";}
								if($no==1){$bp="bp1";}
								$html.= "<tr class='trbody  play-$row[slug] klikplaylist ' id='play-$row[slug]' data-no='$no' data-band='$row[slug]' data-slug='$row[slug]'>
									<td width='150' align='center'>
										<div class='noindex noindex-$row[slug]'>$no</div>
										<div class='playno playno-$row[slug] hide'>
											<a href='javascript:void(0);' onClick=\"currentplaytop(this)\" class='icon $bp pl-$no idpl-$row[id_soundroom]' data-now='$no' data-audio1='a1-$row[id_soundroom]' data-audio='".base_url()."uploads/soundroom/$row[sound]' data-band='$row[slug]' data-slug='$row[slug]' data-progress='prog-$row[id_soundroom]' data-progress1='prog1-$row[id_soundroom]'><i class='fa fa-play'></i></a>
										</div>
									</td>
									<td>$row[judul]</td>
									<td width='200' align='center'>Play</td>
								</tr>
								";
								$no++;
								$pl++;
							}
						}
						$html.="</table>";

						$ret["status"] = "true";
					}
					$ret['pl'] = $pl-1;
					$ret['html'] = $html;
				}
			}
			echo json_encode($ret);
		}

    
	
	public function check_music_metadata(){

        $file = isset($_GET['file']) ? $_GET['file'] : '';
        $version = isset($_GET['version']) ? $_GET['version'] : '2';
        $file = (string) $file;
        $file = basename(str_replace('\\', '/', $file));
        $path = "uploads/soundroom/".$file;
        $fullpath = FCPATH.$path;

        if (!empty($file)) {
        	$download = false;

            if ($download == true && !file_exists($path)) {
                $url = base_url('uploads/soundroom/'.$file);
                file_put_contents($path, fopen($url, 'r'));
            }

	        if (is_file($fullpath)) {
	            if ($version == 1) {
	                $this->load->library('mp3file');
	                $stats = (array) $this->mp3file->set_file($fullpath)->get_metadata();
	            } else {
	                $this->load->library('mp3info');
	                $this->mp3info->resetMetadata();
	                $stats = (array) $this->mp3info->getMetadata($fullpath, true);

	                if ($stats && isset($stats['duration'])) {
	                	$minutes = floor($stats['duration'] % 60);

                    	if (strlen($minutes) == 1) {
                    		$minutes = '0'.$minutes;
                    	}

	                	$stats['durationFormatted'] = floor($stats['duration'] / 60).':'.$minutes;
	                }
	            }

	            print('<pre>'.print_r($stats, true).'</pre>');
	            exit;
	        }
        }

        echo 'KO';
        exit;
    }

	public function landing_2026() {
		$data['website'] = $this->website;
		
		// 1. Load library pagination
		$this->load->library('pagination');

		// 2. Konfigurasi Pagination
		// Pastikan base_url sesuai dengan route controller/method kamu
		$config['base_url'] = base_url('soundroom/landing_2026'); 
		$config['total_rows'] = $this->db->count_all('soundroom_2026');
		$config['per_page'] = 8; // Karena grid kita 4 kolom, angka kelipatan 4 (8, 12, 16) sangat disarankan
		$config['uri_segment'] = 3; // Sesuaikan jika segment URL kamu berbeda

		// Styling agar pagination cocok dengan Bootstrap (sesuai UI tema kamu)
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		// 3. Ambil data dengan limit berdasarkan halaman (offset)
		$page = (int)$this->uri->segment(3);
		$no = $page + 1;

		$data['no'] = $no;
		
		$this->db->order_by('id_soundroom', 'DESC');
		$this->db->limit($config['per_page'], $page);
		$data['bands'] = $this->db->get('soundroom_2026')->result_array();
		
		// 4. Kirim link pagination ke view
		$data['links'] = $this->pagination->create_links();
		
		$this->load->view('front/soundroom-header', $data);
		$this->load->view('front/soundroom-landing-2026', $data);
		$this->load->view('front/podcast/footerfp');
	}
}
