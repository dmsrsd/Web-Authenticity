<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Artikel extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
	public function index(){
		$data['website'] = $this->website;
		$data['artikel'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategori,b.head_kategori,b.slug as slugkat',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status'=>1),
			'order_by' => 'a.created_date desc'
		));
		$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		
		$data['subtitle'] = " | Article ";
		$data['website']['meta_description'] = "Article ";
		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/article-all',$data);
	}
	public function getpoint(){
		if(!empty($this->datamember)){
			$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array( 'id_resource' =>$_POST['x'],'id_member' =>$this->datamember['id'],'id_jenis_point'=>'3')));
			if(count($sudah)==0){
				$point['id_member'] = $this->datamember['id'];
				$point['id_resource'] = $_POST['x'];
				$point['id_jenis_point'] = "3";
				$point["created_date"] = date('Y-m-d H:i:s');
				$this->model_global->insert($point, 'point');
			}
		}
	}
	public function read($slug){
		$data['website'] = $this->website;
		$data['kategori'] = $this->kategori;
		$data['artikel'] = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array( 'slug' =>$slug,'status' =>1)));
		
		$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		$coltags = "";
		if(count($data['artikel'])<1){
			$data['relatedartikel'] = array();
		}else{
			$viewawal = $data['artikel']['views'] * 1;
			$up['views'] = $viewawal + 1;
			$this->model_global->update($up, 'artikel', array('id_artikel' => $data['artikel']['id_artikel']));
			if($data['artikel']['tags']!=""){
				$coltags = "";
				$ptags = explode(",",$data['artikel']['tags']);
				$no =1;
				foreach($ptags as $t){
					if($no==1){$spar = "AND";}else{$spar="OR";}
					$coltags.= " $spar a.tags like '%$t%'";
					$no++;
				}
			}
			$data['relatedartikel'] = $this->db->query("
					SELECT a.*,b.nama as kategori,b.head_kategori,b.slug as slugkat FROM artikel a
					inner join kategori b on b.id_kategori = a.id_kategori
					where a.status='1'   and a.id_kategori=".$data['artikel']['id_kategori']."")->result_array();
		}
		if(count($data['artikel'])==0){
			redirect(base_url());
		}else{
			if($data['artikel']['created_by']!="1"){
				if($data['artikel']['approve']!="1"){
					redirect(base_url());
				}
			}
			if(!empty($this->datamember)){
				$data['sudah'] = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array( 'id_resource' =>$data['artikel']['id_artikel'],'id_member' =>$this->datamember['id'],'id_jenis_point'=>'3')));
			}else{
				$data['sudah'] = 0;
			}
			$data['subtitle'] = " | ".$data['artikel']['judul'];
			$data['website']['meta_description'] = $data['artikel']['deskripsi_singkat'];
			$data['website']['meta_image'] = base_url()."uploads/article/thumb/".$data['artikel']['thumbnail'];

			$kat = $this->model_global->get_data(array('data' => 'row','table' => 'kategori', 'where' => array( 'id_kategori' =>$data['artikel']['id_kategori'])));
			$data['kontributor'] = $this->model_global->get_data(array('data' => 'row','table' => 'kontributor', 'where' => array( 'id_kontributor' =>$data['artikel']['id_kontributor'])));
			$data['bread'] = "<b><a href='".base_url()."category/$kat[head_kategori]/all'>CLASIFIED ".strtoupper($kat['head_kategori'])."</a></b> | <a href='".base_url()."category/$kat[head_kategori]/$kat[slug]'>".strtoupper($kat['nama'])."</a>";
			
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/article-read',$data);
		}
	}
	public function headcategory($slug){
		$data['website'] = $this->website;
		$kat = $this->uri->segment(2);
		$data['headkategori'] = $this->model_global->get_data(array('data' => 'row','table' => 'headkategori', 'where' => array( 'slug' =>$kat)));
		$data['kategori'] = $this->website = $this->model_global->get_data(array('data' => 'row','table' => 'kategori', 'where' => array( 'slug' =>$slug)));
		$data['artikel'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategori,b.head_kategori,b.slug as slugkat',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status'=>1,'b.head_kategori'=>$slug),
			'order_by' => 'a.created_date desc'
		));
		$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		
		//if(count($data['artikel'])==0){
			//redirect(base_url());
		//}else{
			$data['subtitle'] = " | Classified ".ucwords($slug);
			$data['website']['meta_description'] = "Classified ".ucwords($slug);
			$this->load->view('front/podcast/header',$data);
			$valhead = $this->headkategori[$slug];
			$len = strlen($valhead);
			$lenr = $len - 4;
			$val1 = substr($valhead,0,4);
			$val2 = substr($valhead,4,$lenr);
			switch($valhead){
				case "Classified Echoes":
					$totval = $val1."<span style='color:#FF1731;'>".$val2."</span>";
				break;
				case "Classified Space":
					$totval = $val1."<span style='color:#000000;'>".$val2."</span>";
				break;
				case "Classified Edge":
					$totval = "<span style='color:#FF1731;'>".$val1."</span>".$val2;
				break;
			}
			$data['bread'] = "<a href='javascript:void(0);'>$val1$val2</a>";
			$this->load->view('front/article-byhead',$data);
		//}
	}
	public function category($cat,$slug){
		$data['website'] = $this->website;
		$data['headkategori'] = $this->website = $this->model_global->get_data(array('data' => 'row','table' => 'headkategori', 'where' => array( 'slug' =>$cat)));
		$data['kategori'] = $this->website = $this->model_global->get_data(array('data' => 'row','table' => 'kategori', 'where' => array( 'slug' =>$slug)));
		$data['artikel'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategori,b.head_kategori,b.meta_description,b.slug as slugkat',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'where' => array('a.status'=>1,'b.head_kategori'=>$cat,'b.slug'=>$slug),
			'order_by' => 'a.created_date desc'
		));
		$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		
		//if(count($data['artikel'])==0){
			//redirect(base_url());
		//}else{
			$data['subtitle'] = " | Classified ".ucwords($cat)." - ".@$data['kategori']['kategori'];
			$data['website']['meta_description'] = @$data['kategori']['meta_description'];
			$valhead = $this->headkategori[$cat];
			$len = strlen($valhead);
			$lenr = $len - 4;
			$val1 = substr($valhead,0,4);
			$val2 = substr($valhead,4,$lenr);
			switch($valhead){
				case "Classified Echoes":
					$totval = $val1."<span style='color:#FF1731;'>".$val2."</span>";
				break;
				case "Classified Space":
					$totval = $val1."<span style='color:#000000;'>".$val2."</span>";
				break;
				case "Classified Edge":
					$totval = "<span style='color:#FF1731;'>".$val1."</span>".$val2;
				break;
			}
			$data['bread'] = "<a href='".base_url()."category/$cat/all' >$val1$val2</a> | <a href='".base_url()."category/$cat/".@$data['kategori']['slug']."'>".@$data['kategori']['nama']."</a>";
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/article-bycat',$data);
		//}
	}
	public function tag($tag){
		$data['website'] = $this->website;
		$data['artikel'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.nama as kategori,b.head_kategori,b.meta_description,b.slug as slugkat',
			'table' => 'artikel a',
			'join' => array('kategori b','b.id_kategori = a.id_kategori'),
			'like' => array('a.tags'=>$tag),
			'where' => array('a.status'=>1),
			'order_by' => 'a.created_date desc'
		));
		$data['playlist_menu'] = $this->model_global->get_data(array('select' => '*', 'table' => 'web_section','where' => array('status' => 1, 'show_at_menu'=>1), 'order_by'=>'order_number asc'));
		
		//if(count($data['artikel'])==0){
			//redirect(base_url());
		//}else{
			$data['subtitle'] = " | By Tag : ".ucwords($tag);
			$data['website']['meta_description'] = "Classified | By Tag : ".ucwords($tag);
			$data['bread'] = "<a href='".base_url()."tag/".strtolower($tag)."'>".ucwords($tag)."</a>";
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/article-byhead',$data);
		//}
	}
}