<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Newcampaign extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));

	}
	public function index(){

		$data['website'] = $this->website;
		$data['subtitle'] = " | New Campaign ";
		$data['design'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.fullname',
			'table' => 'newcampaign a',
			'join' => array('member b','b.id_member = a.id_member'),
			'where' => array('a.status'=>1,'a.approve'=>1),
			'order_by' => 'a.created_date desc'
		));
		$this->load->view('front/podcast/header',$data);
		//$this->load->view('front/podcast/header',$data);
		$this->load->view('front/newcampaign',$data);

	}
	public function upload(){
		$ret['status'] = "false";
		$ret['html'] = "";
		if(empty($this->datamember)){
			$ret['html'] = "<div class='alert alert-danger'>Login First!</div>";
		}else{
			$_POST['id_member'] = $this->datamember['id'];
			$_POST['approve'] = "0";
			$_POST['status'] = "0";
			$_POST["created_date"] = date('Y-m-d H:i:s');

			$cek3 = $this->model_global->get_data(array('data' => 'row','table' => 'newcampaign', 'where' => array('id_member' => $this->datamember['id'])));
			/*
			if(!empty($cek3)){
				$pending = $this->model_global->get_data(array('data' => 'row','table' => 'newcampaign', 'where' => array('approve'=>'0','id_member' => $this->datamember['id'])));
				$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'newcampaign', 'where' => array('approve'=>'1','id_member' => $this->datamember['id'])));
				if(!empty($pending)){
					$m =  "Sorry, You have uploaded a Design Competition  that has not been approved";
					$ret['html'] = "<div class='alert alert-danger'>".$m."</div>";
					$next = "false";
					$sound = "false";
					echo json_encode($ret);
					return;
				}else{
					if(!empty($sudah)){
						$m =  "Sorry, You have uploaded a Design Competition before";
						$ret['html'] = "<div class='alert alert-danger'>".$m."</div>";
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
				if(empty($_FILES['box']['name'])){
					$ret['html'] = "<div class='alert alert-danger'>Error upload!</div>";
				}else{
					if($_FILES['box']['size'] > 5242880){
						$m =  "Sorry, Max. upload image 5mb";
						$ret['status'] = "false";
						$ret['html'] = "<div class='alert alert-danger'>".$m."</div>";
						$next = "false";
						echo json_encode($ret);
						return;
					}else{
						$next = "true";
					}
				}
			}
			if($next=="true"){
				$_POST['box'] = $this->upload_foto($_FILES['box'],"newcampaign",TRUE,"");

				$insert_id = $this->model_global->insert($_POST, 'newcampaign');
				if($insert_id){
					$ret['status'] = "true";
					$ret['html'] = "<div class='alert alert-success'>Your Image has been sent successfully, awaiting admin moderation.</div>";
				}
				else{
					$ret['status'] = "false";
					$ret['html'] = "<div class='alert alert-danger'>Error upload Image!</div>";
				}
			}
		}
		echo json_encode($ret);
	}
	public function downloadtemplate(){
		redirect(base_url()."uploads/newcampaign/download.zip");
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
			if($file_size > 5242880){
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
			ini_set('memory_limit', '-1');
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
}
