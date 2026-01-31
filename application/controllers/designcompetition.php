<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Designcompetition extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->library('session');
		$this->website = $this->model_global->get_data(array('data' => 'row','table' => 'website', 'where' => array( 'id_website' =>1)));

	}
	public function index(){

		$data['website'] = $this->website;
		$data['subtitle'] = " | Design Competition with Dartbotz ";
		$data['design'] = $this->model_global->get_data(array(
			'select' => 'a.*, b.fullname',
			'table' => 'designcompetition a',
			'join' => array('member b','b.id_member = a.id_member'),
			'where' => array('a.status'=>0,'a.approve'=>1),
			'order_by' => 'a.created_date desc'
		));

		$this->load->view('front/podcast/header',$data);
		$this->load->view('front/designcompetition',$data);

	}
	public function upload(){
		$ret['status'] = "false";
		$ret['html'] = "";
		if(empty($this->datamember)){
			$ret['html'] = "<div class='alert alert-danger'>Login First!</div>";
		}else{
			if(isset($_POST['cover'])){
				$_POST['id_member'] = $this->datamember['id'];
				$_POST['approve'] = "0";
				$_POST['status'] = "0";
				$_POST["created_date"] = date('Y-m-d H:i:s');

				$cek3 = $this->model_global->get_data(array('data' => 'row','table' => 'designcompetition', 'where' => array('id_member' => $this->datamember['id'])));
				/*
				if(!empty($cek3)){
					$pending = $this->model_global->get_data(array('data' => 'row','table' => 'designcompetition', 'where' => array('approve'=>'0','id_member' => $this->datamember['id'])));
					$sudah = $this->model_global->get_data(array('data' => 'row','table' => 'designcompetition', 'where' => array('approve'=>'1','id_member' => $this->datamember['id'])));
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
						$ret['html'] = "<div class='alert alert-danger'>Error upload Design : Box!</div>";
					}else{
						if($_FILES['box']['size'] > 5242880){
							$m =  "Sorry, Max. upload Box image 5mb";
							$ret['status'] = "false";
							$ret['html'] = "<div class='alert alert-danger'>".$m."</div>";
							$next = "false";
							echo json_encode($ret);
							return;
						}else{
							if(empty($_FILES['box-cetak']['name'])){
								$ret['html'] = "<div class='alert alert-danger'>Error upload Design : Box Cetak!</div>";
							}else{
								if($_FILES['box-cetak']['size'] > 5242880){
									$m =  "Sorry, Max. upload Box Cetak image 5mb";
									$ret['status'] = "false";
									$ret['html'] = "<div class='alert alert-danger'>".$m."</div>";
									$next = "false";
									echo json_encode($ret);
									return;
								}else{
									if(empty($_FILES['lighter']['name'])){
										$ret['html'] = "<div class='alert alert-danger'>Error upload Design : Lighter!</div>";
									}else{
										if($_FILES['lighter']['size'] > 5242880){
											$m =  "Sorry, Max. upload Lighter image 5mb";
											$ret['status'] = "false";
											$ret['html'] = "<div class='alert alert-danger'>".$m."</div>";
											$next = "false";
											echo json_encode($ret);
											return;
										}else{
											if(empty($_FILES['lighter-cetak']['name'])){
												$ret['html'] = "<div class='alert alert-danger'>Error upload Design : Lighter Cetak!</div>";
											}else{
												if($_FILES['lighter-cetak']['size'] > 5242880){
													$m =  "Sorry, Max. upload Lighter Cetak image 5mb";
													$ret['status'] = "false";
													$ret['html'] = "<div class='alert alert-danger'>".$m."</div>";
													$next = "false";
													echo json_encode($ret);
													return;
												}else{
													if(empty($_FILES['tincase']['name'])){
														$ret['html'] = "<div class='alert alert-danger'>Error upload Design : Tincase!</div>";
													}else{
														if($_FILES['tincase']['size'] > 5242880){
															$m =  "Sorry, Max. upload Tincase image 5mb";
															$ret['status'] = "false";
															$ret['html'] = "<div class='alert alert-danger'>".$m."</div>";
															$next = "false";
															echo json_encode($ret);
															return;
														}else{
															if(empty($_FILES['tincase-cetak']['name'])){
																$ret['html'] = "<div class='alert alert-danger'>Error upload Design : Tincase Cetak!</div>";
															}else{
																if($_FILES['tincase-cetak']['size'] > 5242880){
																	$m =  "Sorry, Max. upload image Tincase Cetak 5mb";
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
													}

												}
											}
										}
									}
								}
							}
						}
					}
				}
				if($next=="true"){
					$_POST['box'] = $this->upload_foto($_FILES['box'],"designcompetition",TRUE,"");
					$_POST['box_cetak'] = $this->upload_foto($_FILES['box-cetak'],"designcompetition",TRUE,"");
					$_POST['lighter'] = $this->upload_foto($_FILES['lighter'],"designcompetition",TRUE,"");
					$_POST['lighter_cetak'] = $this->upload_foto($_FILES['lighter-cetak'],"designcompetition",TRUE,"");
					$_POST['tincase'] = $this->upload_foto($_FILES['tincase'],"designcompetition",TRUE,"");
					$_POST['tincase_cetak'] = $this->upload_foto($_FILES['tincase-cetak'],"designcompetition",TRUE,"");

					$insert_id = $this->model_global->insert($_POST, 'designcompetition');
					if($insert_id){
						$ret['status'] = "true";
						$ret['html'] = "<div class='alert alert-success'>Your Design has been sent successfully, awaiting admin moderation.</div>";
					}
					else{
						$ret['status'] = "false";
						$ret['html'] = "<div class='alert alert-danger'>Error upload Design!</div>";
					}
				}
			}else{
				$ret['html'] = "<div class='alert alert-danger'>Pilih salah satu image untuk dijadikan Cover!</div>";
			}
		}
		echo json_encode($ret);
	}
	public function downloadtemplate(){
		redirect(base_url()."uploads/designcompetition/Design_Template_&_Mockup-20200509T161659Z-001.zip");
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
