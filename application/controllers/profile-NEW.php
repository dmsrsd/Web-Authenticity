<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Profile extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));
		$this->kategori = $this->model_global->get_data(array('select' => '*', 'table' => 'kategori','where' => array('status' => 1), 'order_by' => 'head_kategori asc'));

	}
    public function upload_foto($file,$folder,$thumb=FALSE,$thumb_width){
    	$file_image = "";

    	//$upload_dir = $this->config->item('upload_path');
    	$upload_dir = "uploads/";

		$FILE_MIMES = array('image/jpeg','image/jpg','image/png','image/x-icon','image/gif');
		$FILE_EXTS  = array('.jpeg','.jpg','.png','.ico','.gif');

		if (isset($file) && $file['name'] != "") {
			$file_type 	= $file['type'];
			$file_image = $file['name'];
			$file_size 	= $file['size'];
			if($file_size > 1048576){
				die(json_encode(array('status'=>'error', 'message' => "Sorry, Max. image 1mb")));
			}
			$file_ext 	= strtolower(substr($file_image,strrpos($file_image,".")));

			$temp_name 	= $file['tmp_name'];
			$file_image = str_replace("\\","",$file_image);
			$file_image = str_replace("'","",$file_image);

            $file_edit = str_replace(" ","_",$file_image);
            $random_digit=rand(0000,9999);
            $file_image = $folder.'_'.$random_digit."_".$file_edit;

			$file_path 	= $upload_dir.$folder.'/'.$file_image;

			if (!in_array($file_type, $FILE_MIMES) && !in_array($file_ext, $FILE_EXTS) ) {
				die(json_encode(array('status'=>'error', 'message' => "Sorry, $file_image($file_type) is not allowed to be uploaded")));
			}

			//addafterdeface--------------
			$size = getimagesize($temp_name);
			if(!$size) {
				die(json_encode(array('status'=>'error', 'message' => "Sorry, $file_image($file_type) is not allowed to be uploaded")));
			}

			$valid_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP);

			if(in_array($size[2],  $valid_types)) {
			} else {
				die(json_encode(array('status'=>'error', 'message' => "Sorry, $file_image($file_type) is not allowed to be uploaded")));
			}
			//------------------
			$result = move_uploaded_file($temp_name, $file_path);

			if ($result) {
				if($thumb==TRUE){
					$thumb_path = $upload_dir.$folder.'/thumb/';
					$thumbnail = $thumb_path.$file_image;
					$upload_image = $file_path;
					if($thumb_width==""){
						$thumb_width = 500;
					}else{
						$thumb_width = $thumb_width;
					}
					$info = getimagesize($upload_image);
					$aspectRatio = $info[1] / $info[0];
					$thumb_height = (int)($aspectRatio * $thumb_width);// . "px";
					//$thumb_width .= "px";

					list($width,$height) = getimagesize($upload_image);
					$thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
					switch($file_ext){
						case '.jpg':
							$source = imagecreatefromjpeg($upload_image);
							break;
						case '.jpeg':
							$source = imagecreatefromjpeg($upload_image);
							break;

						case '.png':
							$source = imagecreatefrompng($upload_image);
							break;
						case '.gif':
							$source = imagecreatefromgif($upload_image);
							break;
						default:
							$source = imagecreatefromjpeg($upload_image);
					}
					//$source = imagecreatefrompng($upload_image);
					imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
					switch($file_ext){
						case '.jpg' || '.jpeg':
							imagejpeg($thumb_create,$thumbnail,100);
							break;
						case '.png':
							imagepng($thumb_create,$thumbnail,100);
							break;

						case '.gif':
							imagegif($thumb_create,$thumbnail,100);
							break;
						default:
							imagejpeg($thumb_create,$thumbnail,100);
						break;
					}
				}
				return $file_image;
			}
			else{
				return "";
			}
		}
    }
    public function upload_mp3($file,$folder){

    	$file_image = "";

    	$upload_dir ="uploads/";

		$FILE_MIMES = array('audio/mpeg');
		$FILE_EXTS  = array('.mp3');

		if (isset($file) && $file['name'] != "") {
			$file_type 	= $file['type'];
			$file_image = $file['name'];
			$file_size 	= $file['size'];
			if($file_size > 6291456){
				die(json_encode(array('status'=>'error', 'message' => "Sorry, Max. mp3 6mb")));
			}

			$file_ext 	= strtolower(substr($file_image,strrpos($file_image,".")));
			$temp_name 	= $file['tmp_name'];
			$file_image = str_replace("\\","",$file_image);
			$file_image = str_replace("'","",$file_image);

            $file_edit = str_replace(" ","_",$file_image);
            $random_digit=rand(0000,9999);
            $file_image = $folder.'_'.$random_digit."_".$file_edit;

			$file_path 	= $upload_dir.$folder.'/'.$file_image;

			if (!in_array($file_type, $FILE_MIMES) && !in_array($file_ext, $FILE_EXTS) ) {
				die(json_encode(array('status'=>'error', 'message' => "Sorry, $file_image($file_type) is not allowed to be uploaded")));
			}

			// $result = move_uploaded_file($temp_name, $file_path);
			// if ($result) {
			// 	return $file_image;
			// }
			// else{
			// 	return "";
			// }

			//-- new upload-method
				$upload_path = getcwd().'/'.$upload_dir.$folder.'/'; 
				$upload_path = $upload_dir.$folder.'/'; 

				$config['upload_path']          = $upload_path;
				$config['allowed_types']        = 'm4a|mp3|audio/mp3';
				$config['max_size']             = 5000000;
				$config['file_name']            = $file_image;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('sound')) 
				{
					return "";
				}else{
					return $file_image;
				}

		}
    }
	public function index(){

		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;

			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
			$data['member']['provinsi']='';
			$data['member']['kota']='';
			if($data['member']['id_kota']!=""){
				$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a', 'join' => array('kota b','b.id_kota = a.id_kota'),'where' => array( 'a.id_member' =>$this->datamember['id'])));
			}
			$data['point'] = $this->model_global->get_data(array('select' => '*', 'table' => 'point a', 'join' => array('jenis_point b','b.id_jenis_point = a.id_jenis_point'),'where' => array('a.id_member' => $this->datamember['id'],'a.id_jenis_point !='=>5), 'order_by' => 'a.created_date desc'));
			$data['redeem'] = $this->model_global->get_data(array('select' => '*', 'table' => 'redeemmember', 'where' => array('id_member' => $this->datamember['id']), 'order_by' => 'point asc'));
			$data['order'] = $this->model_global->get_data(array('select' => '*', 'table' => 'order', 'where' => array('id_member' => $this->datamember['id']), 'order_by' => 'created_date desc'));
			$query = $this->db->query("select sum(b.pts) as total from point a left join jenis_point b on b.id_jenis_point = a.id_jenis_point where a.id_member='".$this->datamember['id']."' and a.id_jenis_point!=27  and a.id_jenis_point!=12 ")->result_array();
			$total1 =  $query[0]['total'];
			$query2 = $this->db->query("select sum(point) as total from redeemmember where id_member='".$this->datamember['id']."'")->result_array();
			$total2 =  $query2[0]['total'];

			$query3 = $this->db->query("select sum(point) as total from pointacak  where  id_member='".$this->datamember['id']."'")->result_array();
			$total3 =  $query3[0]['total'];

			$query4 = $this->db->query("select count(id_member) as total from pointband  where  id_member='".$this->datamember['id']."'")->result_array();
			$jum = $this->model_global->get_data(array('data' => 'row','table' => 'jenis_point','where' => array( 'id_jenis_point' =>'27')));
			$total4 =  $query4[0]['total'] * $jum['pts'];


			$data['total_point'] = ($total1 + $total3 + $total4)- $total2 ;
			$data['redeempoint'] = $this->model_global->get_data(array('select' => '*', 'table' => 'redeempoint','where' => array('status' => 1,'qty >'=>0), 'order_by' => 'point asc'));;
			$data['song'] = $this->model_global->get_data(array('select' => '*', 'table' => 'soundroom','where' => array('status !=' => -1,'created_by'=>$this->datamember['id']), 'order_by' => 'created_date desc'));;
			$data['artikel'] = $this->model_global->get_data(array('select' => '*', 'table' => 'artikel','where' => array('status !=' => -1,'created_by'=>$this->datamember['id']), 'order_by' => 'created_date desc'));;

			$data['darbotzorder'] = $this->model_global->get_data(array('select' => '*', 'table' => 'darbotzorder', 'where' => array('id_member' => $this->datamember['id']), 'order_by' => 'created_date desc'));
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/profile',$data);
		}
	}
	public function edit(){

		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;

			$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
			$data['member']['provinsi']='';
			$data['member']['kota']='';
			$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
			if($data['member']['id_kota']!=""){
				$data['member'] = $this->model_global->get_data(array('data' => 'row','table' => 'member a', 'join' => array('kota b','b.id_kota = a.id_kota'),'where' => array( 'a.id_member' =>$this->datamember['id'])));
				$data['kota'] = $this->model_global->get_data(array('data' => 'row','table' => 'kota a','where' => array( 'a.id_kota' =>$data['member']['id_kota'])));
			}
			$data['dob']='';
			if($data['member']['dob']!=""){
				$d = explode("-",$data['member']['dob']);
				$data['dob']=$d[2]."-".$d[1]."-".$d[0];
			}
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/edit',$data);
		}
	}
	public function changepp(){
		$ret['status'] = "false";
		$ret['m'] = "";
		if(empty($this->datamember)){
			$ret['status'] = "false";
			$ret['message'] = "Wrong session, please log in";

		}else{
			$member = $this->model_global->get_data(array('data' => 'row','table' => 'member a','where' => array( 'a.id_member' =>$this->datamember['id'])));
			define('UPLOAD_DIR', 'uploads/pp/');
			$base64img = str_replace('[removed]', '', $_POST['pp']);
			$data = base64_decode($base64img);
			$new = $this->datamember['id']."PP".rand().'.jpg';
			$file = UPLOAD_DIR . $new;
			file_put_contents($file, $data);
			if(file_exists("uploads/pp/".$new)){
				if($member['pp']!=""){
					if(file_exists("uploads/pp/".$member['pp'])){
						unlink("uploads/pp/".$member['pp']);
					}
				}
				$up['pp'] = $new;
				$this->model_global->update($up, 'member', array('id_member' => $this->datamember['id']));
			}
			$ret['status'] = "true";
			$ret['message'] = "Photo berhasil di simpan";
		}
		echo json_encode($ret);
	}
	public function submitedit(){
		if(empty($this->datamember)){
			$ret['status'] = "false";
			$ret['message'] = "Wrong session, please log in";

		}else{
			$ret['status'] = "false";
			$m = "";
			$ret['message'] = "";
			unset($_POST['id_provinsi']);
			unset($_POST['emailx']);
			unset($_POST['confirmpassword']);
			$_POST["modified_date"] = date('Y-m-d H:i:s');
			unset($_POST['pp']);

			$birthDate = $_POST['dob'];
			$birthDate = explode("-", $birthDate);
			$age1 = (date("md", date("U", mktime(0, 0, 0, $birthDate[2], $birthDate[1], $birthDate[0]))) > date("md")
			? ((date("Y") - $birthDate[0]) - 1)
			: (date("Y") - $birthDate[0]));
			$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
			? ((date("Y") - $birthDate[2]) - 1)
			: (date("Y") - $birthDate[2]));

			if($age<17){
				$s = "false";
				$m = "You're not 17 years old yet!";
			}else{
				$d = explode("-",$_POST['dob']);
				$_POST['dob'] = $d[2]."-".$d[1]."-".$d[0];
				if($_POST['password']==""){
					unset($_POST['password']);
					$s = "true";
				}else{
					$adap = strlen($_POST['password']);
					if($adap<6){
						$s = "false";
						$m = "Password harus lebih dari 6 karakter";
					}else{
						$_POST['password'] = $this->encrypt->encode($_POST['password']);
						$s = "true";
					}
				}
			}
			if($s=="true"){
				$_POST['age'] = $age;
				$insert_id = $this->model_global->update($_POST, 'member', array('id_member' => $this->datamember['id']));
				if($insert_id){
					$array = array(
							"id" =>  $this->datamember['id'],
							"fullname" => $_POST['fullname']
						);
					$this->session->set_userdata('membersimply', $array);
					$cekedit = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array('id_member' => $this->datamember['id'],'id_jenis_point'=>'25')));
					if(empty($cekedit)){
						$id_member = $this->datamember['id'];
						$point['id_member'] = $id_member;
						$point['id_jenis_point'] = "25";
						$point["created_date"] = date('Y-m-d H:i:s');
						$this->model_global->insert($point, 'point');
					}
					$ret['status'] = "true";
					$ret['message'] = "Success update profile!";

				}else{
					$ret['status'] = "false";
					$ret['message'] = "Error Proccessing";
				}

			}else{
				$ret['status'] = "false";
				$ret['message'] = $m;
			}
		}
		echo json_encode($ret);

	}
	public function write(){
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/write',$data);
		}
	}
	public function soundroom(){
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			// $data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));

			$data['provinsi'] = $this->db->query("SELECT provinsi FROM kota GROUP BY provinsi ORDER BY provinsi asc")->result_array(); 
			// echo '<pre>';
			// var_dump($data['provinsi']); 
			// echo '</pre>';
			// die();
			
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/uploadsoundroom',$data);
		}
	}
	public function posterchallenge(){
		redirect(base_url()."poster-challenge");
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			$data['website'] = $this->website;
			$data['kategori'] = $this->kategori;
			$data['provinsi'] = $this->model_global->get_data(array('select' => '*', 'table' => 'kota','group_by' => 'provinsi', 'order_by' => 'provinsi asc'));
			$this->load->view('front/podcast/header',$data);
			$this->load->view('front/uploadposterchallenge',$data);
		}
	}
	public function submitarticle(){
		/*$ret['status'] = "true";
		$ret['message'] = "cek tags";
		echo json_encode($ret);
		die();*/
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			if(isset($_POST['submit'])){
				unset($_POST['submit']);
				$ret['status'] = "false";
				$_POST['created_by'] = $this->datamember['id'];
				$_POST['approve'] = "0";
				$_POST['status'] = "0";
				$_POST["created_date"] = date('Y-m-d H:i:s');
				$cek2 = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('slug' => $_POST['slug'])));
				if(!empty($cek2)){
					if($cek2["approve"]=="2"){
						$ret['status'] = "true";
					}else{
						$ret['status'] = "false";
						$next = "false";
						$m = "<b>$_POST[judul]</b> has been used, use another Judul!";
						$ret['message'] = $m;
						echo json_encode($ret);
						return;

					}
				}else{
					/*
					$cek3 = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('created_by' => $this->datamember['id'])));
					if(!empty($cek3)){
						$pending = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('approve'=>'0','created_by' => $this->datamember['id'])));
						$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('approve'=>'1','created_by' => $this->datamember['id'])));
						if(!empty($pending)){
							$m =  "Sorry, You have uploaded a arcile that has not been approved";
							$ret['status'] = "false";
							$ret['message'] = $m;
							$next = "false";
							$sound = "false";
							echo json_encode($ret);
							return;
						}else{
							if(!empty($sudah)){
								$m =  "Sorry, You have uploaded a arcile before";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								$sound = "false";
								echo json_encode($ret);
								return;
							}else{
								$sound = "true";
							}
						}

					}else{
						$sound = "true";
					}
					*/
					$sound = "true";
					if($sound=="true"){
						if(empty($_FILES['image']['name'])){
							unset($_POST['image']);
						}else{
							if($_FILES['image']['size'] > 1048576){
								$m =  "Sorry, Max. upload image 1mb";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								echo json_encode($ret);
								return;
							}else{
								$next = "true";
								$_POST['image'] = $this->upload_foto($_FILES['image'],"article",TRUE,"");
							}
						}
						if(empty($_FILES['thumbnail']['name'])){
							unset($_POST['thumbnail']);
						}else{
							if($_FILES['thumbnail']['size'] > 1048576){
								$m = "Sorry, Max. upload thumbnail 1mb";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								echo json_encode($ret);
								return;
							}else{
								$next = "true";
								$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"article",TRUE,"");
							}
						}
					}
				}
				if($next=="true"){
					$insert_id = $this->model_global->insert($_POST, 'artikel');
					if($insert_id){
						$ret['status'] = "true";
						$ret['message'] = "Your arcile has been sent successfully, awaiting admin moderation.";
					}
					else{
						$ret['status'] = "false";
						$ret['message'] = "Error write article!";
					}
				}

			}else{
				$ret['status'] = "false";
				$ret['message'] = "ERROR";
			}
			echo json_encode($ret);
		}
	}
	public function submitposter(){
		/*$ret['status'] = "true";
		$ret['message'] = "cek tags";
		echo json_encode($ret);
		die();*/
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			if(isset($_POST['submit'])){
				unset($_POST['id_provinsi']);
				unset($_POST['submit']);
				$ret['status'] = "false";
				$_POST['created_by'] = $this->datamember['id'];
				$_POST['approve'] = "0";
				$_POST['status'] = "0";
				$_POST["created_date"] = date('Y-m-d H:i:s');
				$cek2 = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array('slug' => $_POST['slug'])));
				if(!empty($cek2)){
					if($cek2["approve"]=="2"){
						$ret['status'] = "true";
					}else{
						$ret['status'] = "false";
						$next = "false";
						$m = "<b>$_POST[judul]</b> 'Judul' been used, use another 'Judul'!";
						$ret['message'] = $m;
						echo json_encode($ret);
						return;

					}
				}else{
					$cek3 = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array('created_by' => $this->datamember['id'])));
					if(!empty($cek3)){
						$pending = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array('approve'=>'0','created_by' => $this->datamember['id'])));
						$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array('approve'=>'1','created_by' => $this->datamember['id'])));
						if(!empty($pending)){
							$m =  "Sorry, You have uploaded a poster that has not been approved";
							$ret['status'] = "false";
							$ret['message'] = $m;
							$next = "false";
							$sound = "false";
							echo json_encode($ret);
							return;
						}else{
							if(!empty($sudah)){
								$m =  "Sorry, You have uploaded a poster before";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								$sound = "false";
								echo json_encode($ret);
								return;
							}else{
								$sound = "true";
							}
						}

					}else{
						$sound = "true";
					}
					if($sound=="true"){
						if(empty($_FILES['image']['name'])){
							unset($_POST['image']);
						}else{
							if($_FILES['image']['size'] > 1048576){
								$m =  "Sorry, Max. upload image 1mb";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								echo json_encode($ret);
								return;
							}else{
								$next = "true";
								$_POST['image'] = $this->upload_foto($_FILES['image'],"posterchallenge",FALSE,"");
							}
						}
					}
				}
				if($next=="true"){
					$insert_id = $this->model_global->insert($_POST, 'posterchallenge');
					if($insert_id){
						$ret['status'] = "true";
						$ret['message'] = "Your poster has been sent successfully, awaiting admin moderation.";
					}
					else{
						$ret['status'] = "false";
						$ret['message'] = "Error upload poster!";
					}
				}

			}else{
				$ret['status'] = "false";
				$ret['message'] = "ERROR";
			}
			echo json_encode($ret);
		}
	}
	public function submitsound(){
		/*$ret['status'] = "true";
		$ret['message'] = "cek tags";
		echo json_encode($ret);
		die();*/
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			if(isset($_POST['submit'])){
				unset($_POST['id_provinsi']);
				unset($_POST['submit']);
				//print_r($_POST);
				$pno=0;
				/*
				$personil = "";
				foreach($_POST['personil'] as $key){
					$personil.= $key."-".$_POST['position'][$pno].",";
					$pno++;
				}
				unset($_POST['personil']);unset($_POST['position']);
				$personil = rtrim($personil,",");
				$_POST['personil'] = $personil ;
				*/
				$ret['status'] = "false";
				$_POST['created_by'] = $this->datamember['id'];
				$_POST['approve'] = "0";
				$_POST['status'] = "0";
				$_POST["created_date"] = date('Y-m-d H:i:s');
				$cek2 = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array('slug' => $_POST['slug'])));
				if(!empty($cek2)){
					if($cek2["approve"]=="2"){
						$ret['status'] = "true";
					}else{
						$ret['status'] = "false";
						$next = "false";
						$m = "<b>$_POST[judul]</b> has been used, use another Band!";
						$ret['message'] = $m;
						echo json_encode($ret);
						return;

					}
				}else{
					$cek3 = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array('created_by' => $this->datamember['id'])));
					if(!empty($cek3)){
						$pending = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array('approve'=>'0','created_by' => $this->datamember['id'])));
						$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array('approve'=>'1','created_by' => $this->datamember['id'])));
						if(!empty($pending)){
							$m =  "Sorry, You have uploaded a song that has not been approved";
							$ret['status'] = "false";
							$ret['message'] = $m;
							$next = "false";
							$sound = "false";
							echo json_encode($ret);
							return;
						}else{
							if(!empty($sudah)){
								$m =  "Sorry, You have uploaded a song before";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								$sound = "false";
								echo json_encode($ret);
								return;
							}else{
								$sound = "true";
							}
						}

					}else{
						$sound = "true";
					}
					if($sound=="true"){
						if(empty($_FILES['image']['name'])){
							unset($_POST['image']);
						}else{
							if($_FILES['image']['size'] > 1048576){
								$m =  "Sorry, Max. upload image 1mb";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								echo json_encode($ret);
								return;
							}else{
								$next = "true";
								$_POST['image'] = $this->upload_foto($_FILES['image'],"soundroom",FALSE,"");
							}
						}
						if(empty($_FILES['thumbnail']['name'])){
							unset($_POST['thumbnail']);
						}else{
							if($_FILES['thumbnail']['size'] > 1048576){
								$m = "Sorry, Max. upload sound cover 1mb";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								echo json_encode($ret);
								return;
							}else{
								$next = "true";
								$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"soundroom",FALSE,"");
							}
						}
						if(empty($_FILES['sound']['name'])){
							unset($_POST['sound']);
						}else{
							if($_FILES['sound']['size'] > 6291456){
								$m = "Sorry, Max. upload mp3 6mb";
								$ret['status'] = "false";
								$ret['message'] = $m;
								$next = "false";
								echo json_encode($ret);
								return;
							}else{
								$next = "true";
								$_POST['sound'] = $this->upload_mp3($_FILES['sound'],"soundroom");
							}
						}
					}
				}
				if($next=="true"){
					$_POST['thumbnail'] = $_POST['image'];
					$insert_id = $this->model_global->insert($_POST, 'soundroom');
					if($insert_id){
						$ret['status'] = "true";
						$ret['message'] = "Your sound has been sent successfully, awaiting admin moderation.";
					}
					else{
						$ret['status'] = "false";
						$ret['message'] = "Error upload sound!";
					}
				}

			}else{
				$ret['status'] = "false";
				$ret['message'] = "ERROR";
			}
			echo json_encode($ret);
		}
	}
	public function getredeem(){
		$ret['status'] = "false";
		$ret['message'] = "";
		if(!empty($this->datamember)){
			$qsudah = $this->db->query("SELECT COUNT(id_member) as vote FROM `redeemmember` where id_redeempoint='".$_POST['x']."' and id_member='".$this->datamember['id']."'")->result_array();
			$sudah =  $qsudah[0]['vote'];
			if($sudah > 0){
				$ret['message'] = "You have redeemed this item";
			}else{
				$qitem = $this->db->query("SELECT * FROM `redeempoint` where id_redeempoint='".$_POST['x']."'")->result_array();
				$item =  $qitem[0];
				if($item['qty']>0){
					$query = $this->db->query("select sum(b.pts) as total from point a left join jenis_point b on b.id_jenis_point = a.id_jenis_point where a.id_member='".$this->datamember['id']."'")->result_array();
					if($query[0]['total']>=$item['point']){
						$ret['btnv'] = "btnv-".$_POST['x'];
						$ret['status'] = "true";
						$redeem['id_member'] = $this->datamember['id'];
						$redeem['id_redeempoint'] = $_POST['x'];
						$redeem['point'] = $item['point'];
						$redeem["created_date"] = date('Y-m-d H:i:s');
						$this->model_global->insert($redeem, 'redeemmember');

						$total =  $query[0]['total'] - $item['point'];
						$up['qty'] = $item['qty'] - 1;
						$this->model_global->update($up, 'redeempoint', array('id_redeempoint' => $_POST['x']));
						$ret['message'] = "Selamat lo sudah dapatkan ".ucwords($item['nama']."<br> incaranmu! Sisa point lo <b>$total</b>, tambah lagi yuk untuk tukar barang incaran lainnya<br>".ucwords($item['nama'])." ini tersisa $up[qty] lagi");
						$ret['qtot'] = $total;
						$ret['message2'] = $this->website['tnc_redeem'];
					}else{
						$ret['message'] = "Maaf, Point lo belum cukup!";
					}
				}else{
					$ret['message'] = "Maaf, Stok habis!";
				}
			}
		}else{
			$ret['message'] = "Please sign in or sign up before!";
		}
		echo json_encode($ret);
	}
	public function out(){
		@session_start();
		//$this->session->sess_destroy();
		$this->session->set_userdata('membersimply', array());
		unset($_SESSION['verifytnmcmember']);
		redirect(base_url()."login");
	}
}