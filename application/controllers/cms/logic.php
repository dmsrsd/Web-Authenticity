<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logic extends AdminController {

	function __construct() {
        parent::__construct();
    }

	function url_get_contents ($Url) {
		if (!function_exists('curl_init')){
			die('CURL is not installed!');
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	public function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

		//folder path setup
		$target_path = $target_folder;
		$thumb_path = $thumb_folder;

		//file name setup
		$filename_err = explode(".",$_FILES[$field_name]['name']);
		$filename_err_count = count($filename_err);
		$file_ext = $filename_err[$filename_err_count-1];
		if($file_name != ''){
			$fileName = $file_name.'.'.$file_ext;
		}else{
			$fileName = $_FILES[$field_name]['name'];
		}

		//upload image path
		$upload_image = $target_path.basename($fileName);

		//upload image
		if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
		{
			//thumbnail creation
			if($thumb == TRUE)
			{
				$thumbnail = $thumb_path.$fileName;
				list($width,$height) = getimagesize($upload_image);
				$thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
				switch($file_ext){
					case 'jpg':
						$source = imagecreatefromjpeg($upload_image);
						break;
					case 'jpeg':
						$source = imagecreatefromjpeg($upload_image);
						break;

					case 'png':
						$source = imagecreatefrompng($upload_image);
						break;
					case 'gif':
						$source = imagecreatefromgif($upload_image);
						break;
					default:
						$source = imagecreatefromjpeg($upload_image);
				}

				imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
				switch($file_ext){
					case 'jpg' || 'jpeg':
						imagejpeg($thumb_create,$thumbnail,100);
						break;
					case 'png':
						imagepng($thumb_create,$thumbnail,100);
						break;

					case 'gif':
						imagegif($thumb_create,$thumbnail,100);
						break;
					default:
						imagejpeg($thumb_create,$thumbnail,100);
				}

			}

			return $fileName;
		}
		else
		{
			return false;
		}
	}
	public function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 80)
	{
		// Obtain image from given source file.
		if (!$image = @imagecreatefromjpeg($sourceImage))
		{
			return false;
		}

		// Get dimensions of source image.
		list($origWidth, $origHeight) = getimagesize($sourceImage);

		if ($maxWidth == 0)
		{
			$maxWidth  = $origWidth;
		}

		if ($maxHeight == 0)
		{
			$maxHeight = $origHeight;
		}

		// Calculate ratio of desired maximum sizes and original sizes.
		$widthRatio = $maxWidth / $origWidth;
		$heightRatio = $maxHeight / $origHeight;

		// Ratio used for calculating new image dimensions.
		$ratio = min($widthRatio, $heightRatio);

		// Calculate new image dimensions.
		$newWidth  = (int)$origWidth  * $ratio;
		$newHeight = (int)$origHeight * $ratio;

		// Create final image with new dimensions.
		$newImage = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
		imagejpeg($newImage, $targetImage, $quality);

		// Free up the memory.
		imagedestroy($image);
		imagedestroy($newImage);

		return true;
	}

    public function upload_foto($file,$folder,$thumb=FALSE,$thumb_width=500){
    	$file_image = "";

    	//$upload_dir = $this->config->item('upload_path');
    	$upload_dir = "uploads/";

		$FILE_MIMES = array('image/jpeg','image/jpg','image/png','image/x-icon','image/gif');
		$FILE_EXTS  = array('.jpeg','.jpg','.png','.ico','.gif');

		if (isset($file) && $file['name'] != "") {
			$file_type 	= $file['type'];
			$file_image = $file['name'];
			$file_size 	= $file['size'];
			if($file_size > 3048576){
				die(json_encode(array('status'=>'error', 'message' => "Sorry, Max. image 1mb")));
			}
			$file_ext 	= strtolower(substr($file_image,strrpos($file_image,".")));

			$temp_name 	= $file['tmp_name'];
			$file_image = str_replace("\\","",$file_image);
			$file_image = str_replace("'","",$file_image);

            $file_edit = str_replace(" ","_",$file_image);
            $random_digit=rand(0000,9999);
            $file_image = $folder.'_'.$random_digit."_".$file_edit;
			if (!is_dir($upload_dir.$folder.'/')) {
				mkdir($upload_dir.$folder.'/', 0775, TRUE);

			}

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
					$thumb_height = (int)($aspectRatio * $thumb_width) . "px";
					$thumb_width .= "px";

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

		$FILE_MIMES = array('audio/mpeg', 'audio/mp3');
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

			/*
			$result = move_uploaded_file($temp_name, $file_path);
			if ($result) {
				return $file_image;
			}
			else{
				return "";
			}
			*/

			//-- new upload-method
				$upload_path = getcwd().'/'.$upload_dir.$folder.'/';
				$upload_path = $upload_dir.$folder.'/';
				// var_dump($upload_path);

				$config['upload_path']          = $upload_path;
				$config['allowed_types']        = 'm4a|mp3|audio/mp3';
				$config['max_size']             = 5000000;
				$config['file_name']            = $file_image;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('sound'))
				{
					return "";
					// $tes = $this->upload->display_errors('','');
					// $tes = $this->upload->data();
					// $tes = $file_image;
					// var_dump($tes);
				}else{
					return $file_image;
					// echo ' - sukses';
				}
				// die();


		}
    }

    public function upload_filedata($file,$folder){

    	$file_image = "";

    	$upload_dir ="uploads/";

		$FILE_MIMES = array('image/jpeg','image/jpg','image/png');
		$FILE_EXTS  = array('.jpeg','.jpg','.png');

		if (isset($file) && $file['name'] != "") {
			$file_type 	= $file['type'];
			$file_image = $file['name'];
			$file_size 	= $file['size'];
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

			$result = move_uploaded_file($temp_name, $file_path);

			if ($result) {
				return $file_image;
			}
			else{
				return "test";
			}
		}
    }

    public function multiple_upload($multifile,$folder){
        $return = array();

        if(isset($multifile)){
            $multifile = $this->reArrayFiles($multifile);
            $a = 0;
            foreach($multifile as $file){
                $file_image = "";

                $upload_dir = $this->config->item('upload_path');

                $FILE_MIMES = array('image/jpeg','image/jpg','image/png');
                $FILE_EXTS  = array('.jpeg','.jpg','.png');

                if (isset($file) && $file['name'] != "") {
                    $file_type  = $file['type'];
                    $file_image = $file['name'];
                    $file_size  = $file['size'];
                    $file_ext   = strtolower(substr($file_image,strrpos($file_image,".")));
                    $temp_name  = $file['tmp_name'];
                    $file_image = str_replace("\\","",$file_image);
                    $file_image = str_replace("'","",$file_image);

                    $file_edit = str_replace(" ","_",$file_image);
                    $random_digit=rand(0000,9999);
                    $file_image = $folder.'_'.$random_digit."_".$file_edit;

                    $file_path  = $upload_dir.$folder.'/'.$file_image;

                    if (!in_array($file_type, $FILE_MIMES) && !in_array($file_ext, $FILE_EXTS) ) {
                        die(json_encode(array('status'=>'error', 'message' => "Sorry, $file_image($file_type) is not allowed to be uploaded")));
                    }

                    $result = move_uploaded_file($temp_name, $file_path);

                    if ($result) {
                        array_push($return, $file_image);
                    }
                }
                $a++;
            }
        }
        return $return;
    }

	public function genv(){
		$st['status'] = "true";
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$res = "";
		for ($i = 0; $i < 10; $i++) {
		$res .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		$st['kode']  = $res;
		echo json_encode($st);
	}
	public function homeProses(){
		$update = $this->model_global->update($_POST, 'website', array('id_website' => 1));
		if($update){
			redirect($this->template['url'].'about');
		}
		else{
			redirect(base_url());
		}
    }
	public function voucherProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'voucher', array('id_voucher' => $id));
            if($update){
                redirect($this->template['url'].'voucher-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'voucher-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');
            $insert_id = $this->model_global->insert($_POST, 'voucher');
            if($insert_id){
                redirect($this->template['url'].'voucher-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'voucher-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function eoProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'eo', array('id_eo' => $id));
            if($update){
                redirect($this->template['url'].'eo-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'eo-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');
            $insert_id = $this->model_global->insert($_POST, 'eo');
            if($insert_id){
                redirect($this->template['url'].'eo-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'eo-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function websiteProses(){

		if(empty($_FILES['logo']['name'])){ unset($_POST['logo']); }else{
			unlink("uploads/".$_POST['image_1']);
			$_POST['logo'] = $this->upload_foto($_FILES['logo']);
		}
		unset($_POST['image_1']);
		if(empty($_FILES['meta_favicon']['name'])){ unset($_POST['meta_favicon']); }else{
			unlink("uploads/".$_POST['image_2']);
			$_POST['meta_favicon'] = $this->upload_foto($_FILES['meta_favicon']);
		}
		unset($_POST['image_2']);
		if(empty($_FILES['soundroombanner']['name'])){ unset($_POST['soundroombanner']); }else{
			unlink("uploads/".$_POST['image_3']);
			$_POST['soundroombanner'] = $this->upload_foto($_FILES['soundroombanner']);
		}
		unset($_POST['image_3']);

		$update = $this->model_global->update($_POST, 'website', array('id_website' => 1));
		if($update){
			redirect($this->template['url'].'website');
		}
		else{
			redirect(base_url());
		}
    }
	public function headkategoriProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['banner']['name'])){
				unset($_POST['banner']);
			}else{
				unlink("uploads/headkategori/".$_POST['banner_awal']);
				$_POST['banner'] = $this->upload_foto($_FILES['banner'],"headkategori",FALSE);
			}
			unset($_POST['banner_awal']);


            $update = $this->model_global->update($_POST, 'headkategori', array('id_kategori' => $id));
            if($update){
                redirect($this->template['url'].'headkategori-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'headkategori-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
    }
	public function bannerProses(){
		if(empty($_FILES['banner_ladies']['name'])){
			unset($_POST['banner_ladies']);
		}else{
			unlink("uploads/home/".$_POST['image_1']);
			$_POST['banner_ladies'] = $this->upload_foto($_FILES['banner_ladies'],"home");
		}
		unset($_POST['image_1']);

		if(empty($_FILES['banner1']['name'])){
			unset($_POST['banner1']);
		}else{
			unlink("uploads/home/".$_POST['image_2']);
			$_POST['banner1'] = $this->upload_foto($_FILES['banner1'],"home");
		}
		unset($_POST['image_2']);

		if(empty($_FILES['banner2']['name'])){
			unset($_POST['banner2']);
		}else{
			unlink("uploads/home/".$_POST['image_3']);
			$_POST['banner2'] = $this->upload_foto($_FILES['banner2'],"home");
		}
		unset($_POST['image_3']);

		if(empty($_FILES['banner3']['name'])){
			unset($_POST['banner3']);
		}else{
			unlink("uploads/home/".$_POST['image_4']);
			$_POST['banner3'] = $this->upload_foto($_FILES['banner3'],"home");
		}
		unset($_POST['image_4']);

		if(empty($_FILES['banner_ladies_mobile']['name'])){
			unset($_POST['banner_ladies_mobile']);
		}else{
			unlink("uploads/home/".$_POST['image_5']);
			$_POST['banner_ladies_mobile'] = $this->upload_foto($_FILES['banner_ladies_mobile'],"home");
		}
		unset($_POST['image_5']);

		$update = $this->model_global->update($_POST, 'ever_website', array('id_website' => 1));
		if($update){
			redirect($this->template['url'].'banner');
		}
		else{
			redirect(base_url());
		}
    }

	public function submitarticle(){
		if(empty($this->datamember)){
			redirect(base_url()."login");
		}else{
			if(isset($_POST['submit'])){
				unset($_POST['submit']);
				$_POST['created_by'] = $this->datamember['id'];
				$_POST['approve'] = "0";
				$_POST['status'] = "1";
				$_POST["created_date"] = date('Y-m-d H:i:s');
				if(empty($_FILES['image']['name'])){
					unset($_POST['image']);
				}else{
					if($_FILES['image']['size'] > 1048576){
						$m =  "Sorry, Max. upload image 1mb";
						$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
						redirect(base_url().'profile/write');
					}else{
						$_POST['image'] = $this->upload_foto($_FILES['image'],"article",TRUE,"");
					}
				}
				if(empty($_FILES['thumbnail']['name'])){
					unset($_POST['thumbnail']);
				}else{
					if($_FILES['thumbnail']['size'] > 1048576){
						$m = "Sorry, Max. upload image 1mb";
						$this->session->set_flashdata('response', array('status' => 'error', 'message' => $m));
						redirect(base_url().'profile/write');
					}else{
						$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"article",TRUE,"");
					}
				}
				print_r($_POST);
			}else{
				redirect(base_url().'profile/write');
			}
		}
	}
	public function designcompetitionProses(){
		//unset($_POST['submit']);
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            $source = $this->model_global->get_data(array('data' => 'row','table' => 'designcompetition', 'where' => array('id_designcompetition' => $id)));


            unset($_POST['action']);
            unset($_POST['_id']);

			unset($_POST['img_awal']);

            $_POST["modified_date"] = date('Y-m-d H:i:s');
			if($_POST["approve"]=="1"){
				$cekedit = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array('id_member' => $source['id_member'],'id_jenis_point'=>'30')));
				if(empty($cekedit)){
					$id_member = $source['id_member'];
					$point['id_member'] = $id_member;
					$point['id_jenis_point'] = "30";
					$point["created_date"] = date('Y-m-d H:i:s');
					$this->model_global->insert($point, 'point');
				}
			}
            $update = $this->model_global->update($_POST, 'designcompetition', array('id_designcompetition' => $id));
            if($update){
                redirect($this->template['url'].'designcompetition-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'designcompetition-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');


            $insert_id = $this->model_global->insert($_POST, 'designcompetition');
            if($insert_id){
                redirect($this->template['url'].'designcompetition-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan&k='.$_GET['k']);
            }
            else{
                redirect($this->template['url'].'designcompetition-new?_id='.$id.'&s=false&m=Data Gagal Disimpan&k='.$_GET['k']);
            }
        }
    }
	public function newcampaignProses(){
		//unset($_POST['submit']);
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            $source = $this->model_global->get_data(array('data' => 'row','table' => 'newcampaign', 'where' => array('id_newcampaign' => $id)));


            unset($_POST['action']);
            unset($_POST['_id']);

			unset($_POST['img_awal']);

            $_POST["modified_date"] = date('Y-m-d H:i:s');
			if($_POST["approve"]=="1"){
				$cekedit = $this->model_global->get_data(array('data' => 'row','table' => 'point', 'where' => array('id_member' => $source['id_member'],'id_jenis_point'=>'30')));
				if(empty($cekedit)){
					$id_member = $source['id_member'];
					$point['id_member'] = $id_member;
					$point['id_jenis_point'] = "31";
					$point["created_date"] = date('Y-m-d H:i:s');
					$this->model_global->insert($point, 'point');
				}
			}
            $update = $this->model_global->update($_POST, 'newcampaign', array('id_newcampaign' => $id));
            if($update){
                redirect($this->template['url'].'newcampaign-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'newcampaign-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');


            $insert_id = $this->model_global->insert($_POST, 'newcampaign');
            if($insert_id){
                redirect($this->template['url'].'newcampaign-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan&k='.$_GET['k']);
            }
            else{
                redirect($this->template['url'].'newcampaign-new?_id='.$id.'&s=false&m=Data Gagal Disimpan&k='.$_GET['k']);
            }
        }
    }
	public function posterchallengeProses(){
		//unset($_POST['submit']);
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            $source = $this->model_global->get_data(array('data' => 'row','table' => 'posterchallenge', 'where' => array('id_posterchallenge' => $id)));


            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/posterchallenge/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"posterchallenge",TRUE,"");
			}
			unset($_POST['img_awal']);

            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'posterchallenge', array('id_posterchallenge' => $id));
            if($update){
                redirect($this->template['url'].'posterchallenge-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'posterchallenge-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"posterchallenge",TRUE,"");
			}

            $insert_id = $this->model_global->insert($_POST, 'posterchallenge');
            if($insert_id){
                redirect($this->template['url'].'posterchallenge-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan&k='.$_GET['k']);
            }
            else{
                redirect($this->template['url'].'posterchallenge-new?_id='.$id.'&s=false&m=Data Gagal Disimpan&k='.$_GET['k']);
            }
        }
    }
	public function soundroomProses(){
		//unset($_POST['submit']);
        $table = 'soundroom';
        $year = '';

        if (isset($_GET['_year']) && $_GET['_year'] == '2025') {
            $year = '2025';
            $table = 'soundroom_2025';
		} elseif (isset($_GET['_year']) && $_GET['_year'] == '2024') {
            $year = '2024';
            $table = 'soundroom_2024';
		} elseif (isset($_GET['_year']) && $_GET['_year'] == '2023') {
            $year = '2023';
            $table = 'soundroom_2023';
		} elseif (isset($_GET['_year']) && $_GET['_year'] == '2019') {
			$year = '2019';
			$table = 'soundroom_2019';
		}

        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            $source = $this->model_global->get_data(array('data' => 'row','table' => $table, 'where' => array('id_soundroom' => $id)));
			switch($_POST['approve']){
				case "0":
					$this->db->delete("point", array('id_resource' => $id,'id_member' => $_POST['created_by'],'id_jenis_point' => "9"));
				break;
				case "2":
					$this->db->delete("point", array('id_resource' => $id,'id_member' => $_POST['created_by'],'id_jenis_point' => "9"));
				break;
				case "1":
					$this->db->delete("point", array('id_resource' => $id,'id_member' => $_POST['created_by'],'id_jenis_point' => "9"));
					$point['id_resource'] = $id;
					$point['id_member'] = $_POST['created_by'];
					$point['id_jenis_point'] = "9";
					$point["created_date"] = $source['created_date'];
					$this->model_global->insert($point, 'point');
				break;
			}

            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/soundroom/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"soundroom",TRUE,"");
			}
			unset($_POST['img_awal']);
			if(empty($_FILES['thumbnail']['name'])){
				unset($_POST['thumbnail']);
			}else{
				unlink("uploads/soundroom/".$_POST['img_awal_thumbnail']);
				$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"soundroom",TRUE,"");
			}
			unset($_POST['img_awal_thumbnail']);
			if(empty($_FILES['sound']['name'])){
				unset($_POST['sound']);
			}else{
				if($_POST['img_awal_sound']!=''){
					unlink("uploads/soundroom/".$_POST['img_awal_sound']);
				}
				$_POST['sound'] = $this->upload_mp3($_FILES['sound'],"soundroom");
			}
			unset($_POST['img_awal_sound']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

			//-- tambahan 2022
				if(isset($_POST['image']) && $_POST['image']!=''){
					$_POST['thumbnail'] = $_POST['image'];
				}

				if($_POST['top3']==''){
					unset($_POST['top3']);
				}

				// if($_POST['rejected_info']!=''){
				// 	$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('id_member' => $_POST['created_by'])));
				// 	if(!empty($cek)){
				// 		$to_email = $cek['email'];
				// 		$this->load->library('email');
				// 		$config['protocol'] = 'smtp';
				// 		$config['mailpath'] = '/usr/sbin/sendmail';
				// 		$config['smtp_host'] = 'smtp.zoho.com';
				// 		$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
				// 		$config['smtp_timeout'] = '7';
				// 		$config['smtp_user'] = 'noreply@simplyauthentic.id';
				// 		$config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
				// 		//sendinblue
                //         // $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                //         // $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                //         // $config['smtp_timeout'] = '7';
                //         // $config['smtp_user'] = 'admin@simplyauthentic.id';
                //         // $config['smtp_pass'] = '13rBws6z9I7WvtDq';
				// 		$config['charset'] = 'utf-8';
				// 		$config['mailtype'] = 'html';
				// 		$config['newline'] = "\r\n";
				// 		$config['smtp_crypto'] = 'ssl';
				// 		$this->email->initialize($config);
				// 		$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
				// 		$this->email->to($to_email);
				// 		$this->email->subject('Submission rejected');

				// 		$em['data'] ="Hi <b>".ucwords($cek['fullname'])."</b>, <br><br>
				// 		Mohon maaf, musik lo belum berhasil masuk karena <b>".$_POST['rejected_info']."</b>
				// 		<br /><br />
				// 		Pastiin data dan musik lo udah sesuai ya. Kita tunggu sampai 25 Juli 2023!<br /><br />
				// 		<a href='https://authenticity.id/profile/soundroom' target='blank'>JOIN ULANG DISINI</a>";

				// 		$pesan = $this->load->view('front/email-template-rejected',$em,TRUE);
				// 		$this->email->message($pesan);
				// 		@$se = $this->email->send();
				// 	}
				// }
			//---tambahan 2024 untuk kirim email ketika di approved
			/*
			if($_POST['approve']==1){
				$cek = $this->model_global->get_data(array('data' => 'row','table' => 'member', 'where' => array('id_member' => $_POST['created_by'])));
				if(!empty($cek)){
					$to_email = $cek['email'];
					$this->load->library('email');
					$config['protocol'] = 'smtp';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['smtp_host'] = 'smtp.zoho.com';
					$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
					$config['smtp_timeout'] = '7';
					$config['smtp_user'] = 'noreply@simplyauthentic.id';
					$config['smtp_pass'] = 'Simple-Tapi-t4k-simpels';
					//sendinblue
					// $config['smtp_host'] = 'smtp-relay.sendinblue.com';
					// $config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
					// $config['smtp_timeout'] = '7';
					// $config['smtp_user'] = 'admin@simplyauthentic.id';
					// $config['smtp_pass'] = '13rBws6z9I7WvtDq';
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['smtp_crypto'] = 'ssl';
					$this->email->initialize($config);
					$this->email->from("noreply@simplyauthentic.id", 'Simply Authentic');
					$this->email->to($to_email);
					$this->email->subject('Submission Aproved');

					$em['data'] ="Hi <b>".ucwords($cek['fullname'])."</b>, <br><br>
					Selamat, karya lo sudah masuk ke Soundroom.<br />
					Semoga lo berkesempatan manggung di Pestapora ya.<br />
					Biar banyak yang dukung, 
					<a href='".base_url('soundroom/share/'.$id.'?year='.$year.'&utm_source=sroom24&utm_medium=sroom24submitter&utm_campaign=sr24'.urlencode($_POST['judul']).'&utm_id=sroom24visitor&utm_term=sroom24visitor')."' target='blank'> download dan share konten ini </a> ke story lo ya. 
					<br /><br />
					".base_url('soundroom/share/'.$id.'?year='.$year.'&utm_source=sroom24&utm_medium=sroom24submitter&utm_campaign=sr24'.urlencode($_POST['judul']).'&utm_id=sroom24visitor&utm_term=sroom24visitor')."";
					//echo $em['data']; exit;
					$pesan = $this->load->view('front/email-template-rejected',$em,TRUE);
					$this->email->message($pesan);
					@$se = $this->email->send();
				}
			}
			*/
            $update = $this->model_global->update($_POST, $table, array('id_soundroom' => $id));
            if($update){
                if ($year != '') {
                    redirect($this->template['url'].'soundroom-new?_id='.$id.'&_year='.$year.'&s=true&m=Data Berhasil Diubah');
                } else {
                    redirect($this->template['url'].'soundroom-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
                }
            }
            else{
                if ($year != '') {
                    redirect($this->template['url'].'soundroom-new?_id='.$id.'&_year='.$year.'&s=false&m=Data Gagal Diubah');
                } else {
                    redirect($this->template['url'].'soundroom-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
                }
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_thumbnail']);
			unset($_POST['img_awal_sound']);
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"soundroom",TRUE,"");
			}
			if(empty($_FILES['thumbnail']['name'])){
				unset($_POST['thumbnail']);
			}else{
				$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"soundroom",TRUE,"");
			}
			if(empty($_FILES['sound']['name'])){
				unset($_POST['sound']);
			}else{
				$_POST['sound'] = $this->upload_mp3($_FILES['sound'],"soundroom");
			}

			$_POST['thumbnail'] = $_POST['image'];
			if($_POST['top3']==''){
				unset($_POST['top3']);
			}

            $insert_id = $this->model_global->insert($_POST, $table);
            if($insert_id){
                if ($year != '') {
                    redirect($this->template['url'].'soundroom-new?_id='.$id.'&_year='.$year.'&s=true&m=Data Berhasil Disimpan&k='.$_GET['k']);
                } else {
                    redirect($this->template['url'].'soundroom-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan&k='.$_GET['k']);
                }
            }
            else{
                if ($year != '') {
                    redirect($this->template['url'].'soundroom-new?_id='.$id.'&_year='.$year.'&s=false&m=Data Gagal Disimpan&k='.$_GET['k']);
                } else {
                    redirect($this->template['url'].'soundroom-new?_id='.$id.'&s=false&m=Data Gagal Disimpan&k='.$_GET['k']);
                }
            }
        }
    }
	public function writeProses(){
		//unset($_POST['submit']);
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){

            $id = $_POST['_id'];
			$source = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('id_artikel' => $id)));
			switch($_POST['approve']){
				case "0":
					$this->db->delete("point", array('id_resource' => $id,'id_member' => $_POST['created_by'],'id_jenis_point' => "8"));
				break;
				case "2":
					$this->db->delete("point", array('id_resource' => $id,'id_member' => $_POST['created_by'],'id_jenis_point' => "8"));
				break;
				case "1":
					$this->db->delete("point", array('id_resource' => $id,'id_member' => $_POST['created_by'],'id_jenis_point' => "8"));
					$point['id_resource'] = $id;
					$point['id_member'] = $_POST['created_by'];
					$point['id_jenis_point'] = "8";
					$point["created_date"] = $source['created_date'];
					$this->model_global->insert($point, 'point');
				break;
			}

            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/article/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"article",TRUE,"");
			}
			unset($_POST['img_awal']);
			if(empty($_FILES['thumbnail']['name'])){
				unset($_POST['thumbnail']);
			}else{
				unlink("uploads/article/".$_POST['img_awal_thumbnail']);
				$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"article",TRUE,"");
			}
			unset($_POST['img_awal_thumbnail']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'artikel', array('id_artikel' => $id));
            if($update){
                redirect($this->template['url'].'write-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'write-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_thumbnail']);
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"article",TRUE,"");
			}
			if(empty($_FILES['thumbnail']['name'])){
				unset($_POST['thumbnail']);
			}else{
				$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"article",TRUE,"");
			}
            $insert_id = $this->model_global->insert($_POST, 'artikel');
            if($insert_id){
                redirect($this->template['url'].'write-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'write-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function artikelProses(){
		$_POST["created_by"] = "1";
		if($_POST['id_kontributor']==""){
			unset($_POST['id_kontributor']);
		}
		//unset($_POST['submit']);
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/article/".$_POST['img_awal']);
				unlink("uploads/article/thumb/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"article",TRUE,"");
			}
			unset($_POST['img_awal']);
			if(empty($_FILES['thumbnail']['name'])){
				unset($_POST['thumbnail']);
			}else{
				unlink("uploads/article/".$_POST['img_awal_thumbnail']);
				unlink("uploads/article/thumb/".$_POST['img_awal_thumbnail']);
				$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"article",TRUE,"");
			}
			unset($_POST['img_awal_thumbnail']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'artikel', array('id_artikel' => $id));
            if($update){
                redirect($this->template['url'].'artikel-new?_id='.$id.'&s=true&m=Data Berhasil Diubah&k='.$_GET['k']);
            }
            else{
                redirect($this->template['url'].'artikel-new?_id='.$id.'&s=false&m=Data Gagal Diubah&k='.$_GET['k']);
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_thumbnail']);
            $_POST["created_date"] = date('Y-m-d H:i:s');
            $_POST["modified_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"article",TRUE,"");
			}
			if(empty($_FILES['thumbnail']['name'])){
				unset($_POST['thumbnail']);
			}else{
				$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"article",TRUE,"");
			}
            $insert_id = $this->model_global->insert($_POST, 'artikel');
            if($insert_id){
                redirect($this->template['url'].'artikel-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan&k='.$_GET['k']);
            }
            else{
                redirect($this->template['url'].'artikel-new?_id='.$id.'&s=false&m=Data Gagal Disimpan&k='.$_GET['k']);
            }
        }
    }
	public function pointProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

            $update = $this->model_global->update($_POST, 'jenis_point', array('id_jenis_point' => $id));
            if($update){
                redirect($this->template['url'].'point-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'point-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
            $insert_id = $this->model_global->insert($_POST, 'jenis_point');
            if($insert_id){
                redirect($this->template['url'].'point-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'point-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function kontributorProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/contributor/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"contributor",TRUE);
			}
			unset($_POST['img_awal']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'kontributor', array('id_kontributor' => $id));
            if($update){
                redirect($this->template['url'].'kontributor-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'kontributor-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"contributor",TRUE);
			}
            $insert_id = $this->model_global->insert($_POST, 'kontributor');
            if($insert_id){
                redirect($this->template['url'].'kontributor-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'kontributor-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function redeempointProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/redeem/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"redeem",FALSE);
			}
			unset($_POST['img_awal']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'redeempoint', array('id_redeempoint' => $id));
            if($update){
                redirect($this->template['url'].'redeempoint-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'redeempoint-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"redeem",FALSE);
			}
            $insert_id = $this->model_global->insert($_POST, 'redeempoint');
            if($insert_id){
                redirect($this->template['url'].'redeempoint-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'redeempoint-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }

	public function ticketProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
			$old = $this->model_global->get_data(array('data' => 'row','table' => 'ticket', 'where' => array('id_ticket' => $id)));
            unset($_POST['action']);
            unset($_POST['_id']);


			$gen = "game-clm-".$_POST['slug']."-clm-".rand(0000,9999);
			$gen2 = "purchase-clm-".$_POST['slug']."-clm-".rand(0000,9999);
			$_POST["qrgame"] = $gen.".png";
			$_POST["qrpurchase"] = $gen2.".png";
			unlink("uploads/ticket/qr/".$old['qrgame']);
			unlink("uploads/ticket/qr/".$old['qrpurchase']);
			file_put_contents("uploads/ticket/qr/".$gen.".png", $this->url_get_contents(base_url()."ticket/genqr/".$gen."/547x547"));
			file_put_contents("uploads/ticket/qr/".$gen2.".png", $this->url_get_contents(base_url()."ticket/genqr/".$gen2."/547x547"));

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/ticket/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"ticket",FALSE);
			}
			unset($_POST['img_awal']);
			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				unlink("uploads/ticket/".$_POST['img_awal_mobile']);
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"ticket",FALSE);
			}
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'ticket', array('id_ticket' => $id));
            if($update){
                redirect($this->template['url'].'ticket-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'ticket-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			//unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');
			$gen = "game-clm-".$_POST['slug']."-clm-".rand(0000,9999);
			$gen2 = "purchase-clm-".$_POST['slug']."-clm-".rand(0000,9999);
			$_POST["qrgame"] = $gen.".png";
			$_POST["qrpurchase"] = $gen2.".png";
			file_put_contents("uploads/ticket/qr/".$gen.".png", $this->url_get_contents(base_url()."ticket/genqr/".$gen."/547x547"));
			file_put_contents("uploads/ticket/qr/".$gen2.".png", $this->url_get_contents(base_url()."ticket/genqr/".$gen2."/547x547"));
			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"ticket",FALSE);
			}
			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"ticket",FALSE);
			}
            $insert_id = $this->model_global->insert($_POST, 'ticket');
            if($insert_id){
                redirect($this->template['url'].'ticket-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'ticket-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function kategoriProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['banner']['name'])){
				unset($_POST['banner']);
			}else{
				unlink("uploads/kategori/".$_POST['banner_awal']);
				$_POST['banner'] = $this->upload_foto($_FILES['banner'],"kategori",FALSE);
			}
			unset($_POST['banner_awal']);

            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'kategori', array('id_kategori' => $id));
            if($update){
                redirect($this->template['url'].'kategori-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'kategori-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['banner_awal']);
            $_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['banner']['name'])){
				unset($_POST['banner']);
			}else{
				$_POST['banner'] = $this->upload_foto($_FILES['banner'],"kategori",FALSE);
			}

            $insert_id = $this->model_global->insert($_POST, 'kategori');
            if($insert_id){
                redirect($this->template['url'].'kategori-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'kategori-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function darbotzProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['banner']['name'])){
				unset($_POST['banner']);
			}else{
				unlink("uploads/darbotz/".$_POST['img_awal']);
				$_POST['banner'] = $this->upload_foto($_FILES['banner'],"darbotz",FALSE);
			}
			unset($_POST['img_awal']);

			if(empty($_FILES['banner2']['name'])){
				unset($_POST['banner2']);
			}else{
				unlink("uploads/darbotz/".$_POST['img_awal2']);
				$_POST['banner2'] = $this->upload_foto($_FILES['banner2'],"darbotz",FALSE);
			}
			unset($_POST['img_awal2']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'darbotz', array('id_darbotz' => $id));
            if($update){
                redirect($this->template['url'].'darbotz-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'darbotz-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal2']);
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['banner']['name'])){
				unset($_POST['banner']);
			}else{
				$_POST['banner'] = $this->upload_foto($_FILES['banner'],"darbotz",FALSE);
			}

			if(empty($_FILES['banner2']['name'])){
				unset($_POST['banner2']);
			}else{
				$_POST['banner2'] = $this->upload_foto($_FILES['banner2'],"darbotz",FALSE);
			}
            $insert_id = $this->model_global->insert($_POST, 'darbotz');
            if($insert_id){
                redirect($this->template['url'].'darbotz-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'darbotz-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function darbotzproductProses(){
		$rc = array();
		$product = array();
		$ind = 0;
		$id = $_POST['_id'];
		foreach($_POST['product'] as $key=>$val){
			if(empty($_FILES['imaged-'.$ind]['name'])){
				$image = $val[2];
			}else{
				unlink("uploads/darbotz/".$val[2]);
				$image = $this->upload_foto($_FILES['imaged-'.$ind],"darbotz",FALSE);
			}
			$isi = array('nama'=>$val[0],'deskripsi'=>$val[1],'image'=>$image);
			array_push($product,$isi);
			$ind++;
		}
		$old = $this->model_global->get_data(array('data' => 'row','table' => 'darbotz', 'where' => array('id_darbotz' => $id)));
		if($old['product']!=""){
			$decold = json_decode($old['product']);
			$imgnew = array();
			foreach($product as $key=>$value){
				array_push($imgnew,$value['image']);
			}
			foreach($decold as $key=>$value){
				if(!in_array($value->image,$imgnew)){
					unlink("uploads/darbotz/".$value->image);
				}
			}
		}
		//print_r($rc);
		//echo "----------<br>";
		$dec = json_encode($product);

		$up['product'] = $dec;
		$update = $this->model_global->update($up, 'darbotz', array('id_darbotz' => $id));
		if($update){
			redirect($this->template['url'].'darbotz-product?_id='.$id.'&s=true&m=Data Berhasil Diubah');
		}
		else{
			redirect($this->template['url'].'darbotz-product?_id='.$id.'&s=false&m=Data Gagal Diubah');
		}
	}

	public function storeproductProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/store/".$_POST['img']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"store",FALSE);
			}
			unset($_POST['img']);


            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'storeproduct', array('id_storeproduct' => $id));
            if($update){
                redirect($this->template['url'].'storeproduct-new?_id='.$id.'&s=true&m=Data Berhasil Diubah&p='.$_GET['p']);
            }
            else{
                redirect($this->template['url'].'storeproduct-new?_id='.$id.'&s=false&m=Data Gagal Diubah&p='.$_GET['p']);
            }
        }
        else{
			unset($_POST['img']);

            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"store",FALSE);
			}

            $insert_id = $this->model_global->insert($_POST, 'storeproduct');
            if($insert_id){
				$id = $this->db->insert_id();
                redirect($this->template['url'].'storeproduct-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan&p='.$_POST['id_store']);
            }
            else{
				$id = '';
                redirect($this->template['url'].'storeproduct-new?_id='.$id.'&s=false&m=Data Gagal Disimpan&p='.$_POST['id_store']);
            }
        }
    }
	public function storeproductbuttonProses(){
		$rc = array();
		$button2 = array();
		$ind = 0;
		$id = $_POST['_id'];
		foreach($_POST['button2'] as $key=>$val){
			if(empty($_FILES['imaged-'.$ind]['name'])){
				$image = $val[2];
			}else{
				unlink("uploads/store/".$val[2]);
				$image = $this->upload_foto($_FILES['imaged-'.$ind],"store",FALSE);
			}
			$isi = array('button'=>$val[0],'url'=>$val[1],'image'=>$image);
			array_push($button2,$isi);
			$ind++;
		}
		$old = $this->model_global->get_data(array('data' => 'row','table' => 'storeproduct', 'where' => array('id_storeproduct' => $id)));
		if($old['button2']!=""){
			$decold = json_decode($old['button2']);
			$imgnew = array();
			foreach($button2 as $key=>$value){
				array_push($imgnew,$value['image']);
			}
			foreach($decold as $key=>$value){
				if(!in_array($value->image,$imgnew)){
					unlink("uploads/store/".$value->image);
				}
			}
		}
		//print_r($rc);
		//echo "----------<br>";
		$dec = json_encode($button2);

		$up['button2'] = $dec;
		$update = $this->model_global->update($up, 'storeproduct', array('id_storeproduct' => $id));
		if($update){
			redirect($this->template['url'].'storeproduct-button?_id='.$id.'&s=true&m=Data Berhasil Diubah');
		}
		else{
			redirect($this->template['url'].'storeproduct-button?_id='.$id.'&s=false&m=Data Gagal Diubah');
		}
	}

	public function storeProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['logo']['name'])){
				unset($_POST['logo']);
			}else{
				unlink("uploads/store/".$_POST['img_logo']);
				$_POST['logo'] = $this->upload_foto($_FILES['logo'],"store",FALSE);
			}
			unset($_POST['img_logo']);

			if(empty($_FILES['background']['name'])){
				unset($_POST['background']);
			}else{
				unlink("uploads/store/".$_POST['img_background']);
				$_POST['background'] = $this->upload_foto($_FILES['background'],"store",FALSE);
			}
			unset($_POST['img_background']);

			if(empty($_FILES['thumbnail']['name'])){
				unset($_POST['thumbnail']);
			}else{
				unlink("uploads/store/".$_POST['img_thumbnail']);
				$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"store",FALSE);
			}
			unset($_POST['img_thumbnail']);

            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'store', array('id_store' => $id));
            if($update){
                redirect($this->template['url'].'store-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'store-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_logo']);
			unset($_POST['img_background']);
			unset($_POST['img_thumbnail']);

            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['logo']['name'])){
				unset($_POST['logo']);
			}else{
				$_POST['logo'] = $this->upload_foto($_FILES['logo'],"store",FALSE);
			}

			if(empty($_FILES['background']['name'])){
				unset($_POST['background']);
			}else{
				$_POST['background'] = $this->upload_foto($_FILES['background'],"store",FALSE);
			}

			if(empty($_FILES['thumbnail']['name'])){
				unset($_POST['thumbnail']);
			}else{
				$_POST['thumbnail'] = $this->upload_foto($_FILES['thumbnail'],"store",FALSE);
			}

            $insert_id = $this->model_global->insert($_POST, 'store');
            if($insert_id){
                redirect($this->template['url'].'store-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'store-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function slideProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/slide/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"slide",FALSE);
			}
			unset($_POST['img_awal']);

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				unlink("uploads/slide/".$_POST['img_awal_mobile']);
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"slide",FALSE);
			}
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'slide', array('id_slide' => $id));
            if($update){
                redirect($this->template['url'].'slide-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'slide-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_mobile']);
            //$_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"slide",FALSE);
			}

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"slide",FALSE);
			}
            $insert_id = $this->model_global->insert($_POST, 'slide');
            if($insert_id){
                redirect($this->template['url'].'slide-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'slide-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function slidestoreProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/store/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"store",FALSE);
			}
			unset($_POST['img_awal']);

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				unlink("uploads/store/".$_POST['img_awal_mobile']);
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"store",FALSE);
			}
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'slide', array('id_slide' => $id));
            if($update){
                redirect($this->template['url'].'slidestore-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'slidestore-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"store",FALSE);
			}

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"store",FALSE);
			}
            $insert_id = $this->model_global->insert($_POST, 'slide');
            if($insert_id){
                redirect($this->template['url'].'slidestore-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'slidestore-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function slideiagProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/iniasligue/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"iniasligue",FALSE);
			}
			unset($_POST['img_awal']);

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				unlink("uploads/iniasligue/".$_POST['img_awal_mobile']);
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"iniasligue",FALSE);
			}
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'slide', array('id_slide' => $id));
            if($update){
                redirect($this->template['url'].'slideiag-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'slideiag-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"iniasligue",FALSE);
			}

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"iniasligue",FALSE);
			}
            $insert_id = $this->model_global->insert($_POST, 'slide');
            if($insert_id){
                redirect($this->template['url'].'slideiag-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'slideiag-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function slidepodcastProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$old_img = isset($_POST['img_awal']) ? trim((string)$_POST['img_awal']) : '';
				if ($old_img !== '' && is_file("uploads/podcast/".$old_img)) { @unlink("uploads/podcast/".$old_img); }
				$_POST['image'] = $this->upload_foto($_FILES['image'],"podcast",FALSE);
			}
			unset($_POST['img_awal']);

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				$old_mob = isset($_POST['img_awal_mobile']) ? trim((string)$_POST['img_awal_mobile']) : '';
				if ($old_mob !== '' && is_file("uploads/podcast/".$old_mob)) { @unlink("uploads/podcast/".$old_mob); }
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"podcast",FALSE);
			}
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'slide', array('id_slide' => $id));
            if($update){
                redirect($this->template['url'].'slidepodcast-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'slidepodcast-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"podcast",FALSE);
			}

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"podcast",FALSE);
			}
            $insert_id = $this->model_global->insert($_POST, 'slide');
            if($insert_id){
                redirect($this->template['url'].'slidepodcast-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'slidepodcast-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }
	public function podcastProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$old_file = isset($_POST['img_awal']) ? trim((string)$_POST['img_awal']) : '';
				if ($old_file !== '' && is_file("uploads/podcast/".$old_file)) { @unlink("uploads/podcast/".$old_file); }
				$_POST['image'] = $this->upload_foto($_FILES['image'],"podcast",FALSE);
			}
			unset($_POST['img_awal']);

            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'podcast', array('id_podcast' => $id));
            if($update){
                redirect($this->template['url'].'podcast-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'podcast-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"podcast",FALSE);
			}

            $insert_id = $this->model_global->insert($_POST, 'podcast');
            if($insert_id){
                redirect($this->template['url'].'podcast-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'podcast-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }

	public function slidedistrictcampiagnProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/districtcampaign/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"districtcampaign",FALSE);
			}
			unset($_POST['img_awal']);

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				unlink("uploads/districtcampaign/".$_POST['img_awal_mobile']);
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"districtcampaign",FALSE);
			}
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'slide_district_campaign', array('id_slide' => $id));
            if($update){
                redirect($this->template['url'].'slidedistrictcampaign-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'slidedistrictcampaign-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
			unset($_POST['img_awal_mobile']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"districtcampaign",FALSE);
			}

			if(empty($_FILES['image_mobile']['name'])){
				unset($_POST['image_mobile']);
			}else{
				$_POST['image_mobile'] = $this->upload_foto($_FILES['image_mobile'],"districtcampaign",FALSE);
			}
            $insert_id = $this->model_global->insert($_POST, 'slide_district_campaign');
            if($insert_id){
                redirect($this->template['url'].'slidedistrictcampaign-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'slidedistrictcampaign-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }

	public function districtCampaignProses(){
		$is_homevideo = $_POST['is_homevideo'];
		if(isset($is_homevideo)){
			$_POST['is_homevideo'] = 1;
		}else{
			$_POST['is_homevideo'] = 0;
		}

        if(isset($_POST['action']) && $_POST['action'] == 'edit'){

            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);


			if(empty($_FILES['main_banner']['name'])){
				unset($_POST['main_banner']);
			}else{
				unlink("uploads/districtcampaign/".$_POST['main_banner_awal']);
				$_POST['main_banner'] = $this->upload_foto($_FILES['main_banner'],"districtcampaign",FALSE);
			}
			if(empty($_FILES['mini_banner']['name'])){
				unset($_POST['mini_banner']);
			}else{
				if(file_exists("uploads/districtcampaign/".$_POST['mini_banner_awal'])){
					unlink("uploads/districtcampaign/".$_POST['mini_banner_awal']);
				}

				$_POST['mini_banner'] = $this->upload_foto($_FILES['mini_banner'],"districtcampaign",FALSE);
			}

			unset($_POST['mini_banner_awal']);
			unset($_POST['main_banner_awal']);

            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'district_campaign', array('id' => $id));
            if($update){
                redirect($this->template['url'].'districtcampaign-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'districtcampaign-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['main_banner_awal']);
			unset($_POST['mini_banner_awal']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['main_banner']['name'])){
				unset($_POST['main_banner']);
			}else{
				$_POST['main_banner'] = $this->upload_foto($_FILES['main_banner'],"districtcampaign",FALSE);
			}
			if(empty($_FILES['mini_banner']['name'])){
				unset($_POST['mini_banner']);
			}else{
				$_POST['mini_banner'] = $this->upload_foto($_FILES['mini_banner'],"districtcampaign",FALSE);
			}

            $insert_id = $this->model_global->insert($_POST, 'district_campaign');
            if($insert_id){
                redirect($this->template['url'].'districtcampaign-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'districtcampaign-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }

	public function sectionProses(){

		$show_at_homepage = $_POST['show_at_homepage'];
		$show_at_menu = $_POST['show_at_menu'];
		if(isset($show_at_homepage)){
			$_POST['show_at_homepage'] = 1;
		}else{
			$_POST['show_at_homepage'] = 0;
		}

		if(isset($show_at_menu)){
			$_POST['show_at_menu'] = 1;
		}else{
			$_POST['show_at_menu'] = 0;
		}

        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);




            $_POST["modified_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['mini_banner']['name'])){
				unset($_POST['mini_banner']);
			}else{
				if(file_exists("uploads/section/".$_POST['mini_banner_awal'])){
					unlink("uploads/section/".$_POST['mini_banner_awal']);
				}

				$_POST['mini_banner'] = $this->upload_foto($_FILES['mini_banner'],"section",FALSE);
			}

			if(empty($_FILES['landing_banner']['name'])){
				unset($_POST['landing_banner']);
			}else{
				if(file_exists("uploads/section/".$_POST['landing_banner_awal'])){
					unlink("uploads/section/".$_POST['landing_banner_awal']);
				}

				$_POST['landing_banner'] = $this->upload_foto($_FILES['landing_banner'],"section",FALSE);
			}

			unset($_POST['mini_banner_awal']);
			unset($_POST['landing_banner_awal']);

            $update = $this->model_global->update($_POST, 'web_section', array('id' => $id));
            if($update){
                redirect($this->template['url'].'section-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'section-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{

            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['mini_banner']['name'])){
				unset($_POST['mini_banner']);
			}else{
				$_POST['mini_banner'] = $this->upload_foto($_FILES['mini_banner'],"section",FALSE);
			}

			if(empty($_FILES['landing_banner']['name'])){
				unset($_POST['landing_banner']);
			}else{
				$_POST['landing_banner'] = $this->upload_foto($_FILES['landing_banner'],"section",FALSE);
			}

            $insert_id = $this->model_global->insert($_POST, 'web_section');
            if($insert_id){
                redirect($this->template['url'].'section-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'section-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }

	public function produkProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image_produk']['name'])){
				unset($_POST['image_produk']);
			}else{
				unlink("uploads/produk/".$_POST['img_awal1']);
				unlink("uploads/produk/thumb/".$_POST['img_awal1']);
				$_POST['image_produk'] = $this->upload_foto($_FILES['image_produk'],"produk",TRUE);
			}
			unset($_POST['img_awal1']);

			if(empty($_FILES['image_hover']['name'])){
				unset($_POST['image_hover']);
			}else{
				unlink("uploads/produk/".$_POST['img_awal2']);
				unlink("uploads/produk/thumb/".$_POST['img_awal2']);
				$_POST['image_hover'] = $this->upload_foto($_FILES['image_hover'],"produk",TRUE);
			}
			unset($_POST['img_awal2']);

			if(empty($_FILES['image3']['name'])){
				unset($_POST['image3']);
			}else{
				unlink("uploads/produk/".$_POST['img_awal3']);
				unlink("uploads/produk/thumb/".$_POST['img_awal3']);
				$_POST['image3'] = $this->upload_foto($_FILES['image3'],"produk",TRUE);
			}
			unset($_POST['img_awal3']);

			if(empty($_FILES['image4']['name'])){
				unset($_POST['image4']);
			}else{
				unlink("uploads/produk/".$_POST['img_awal4']);
				unlink("uploads/produk/thumb/".$_POST['img_awal4']);
				$_POST['image4'] = $this->upload_foto($_FILES['image4'],"produk",TRUE);
			}
			unset($_POST['img_awal4']);

            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'produk', array('id_produk' => $id));
            if($update){
                redirect($this->template['url'].'produk-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'produk-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal1']);
			unset($_POST['img_awal2']);
			unset($_POST['img_awal3']);
			unset($_POST['img_awal4']);
            //$_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');
			//banner_desktop
			//banner_mobile
			//pr1_desktop
			//pr1_mobile
			//pr2_desktop
			//pr2_mobile

			/*DETIL*/
			if(empty($_FILES['image_produk']['name'])){
				unset($_POST['image_produk']);
			}else{
				$_POST['image_produk'] = $this->upload_foto($_FILES['image_produk'],"produk",TRUE);
			}
			if(empty($_FILES['image_hover']['name'])){
				unset($_POST['image_hover']);
			}else{
				$_POST['image_hover'] = $this->upload_foto($_FILES['image_hover'],"produk",TRUE);
			}
			if(empty($_FILES['image3']['name'])){
				unset($_POST['image3']);
			}else{
				$_POST['image3'] = $this->upload_foto($_FILES['image3'],"produk",TRUE);
			}
			if(empty($_FILES['image4']['name'])){
				unset($_POST['image4']);
			}else{
				$_POST['image4'] = $this->upload_foto($_FILES['image4'],"produk",TRUE);
			}

            $insert_id = $this->model_global->insert($_POST, 'produk');
            if($insert_id){
                redirect($this->template['url'].'produk-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan&k='.$_GET['k']);
            }
            else{
                redirect($this->template['url'].'produk-new?_id='.$id.'&s=false&m=Data Gagal Disimpan&k='.$_GET['k']);
            }
        }
    }
	public function fotoProses(){
		$cb = $_GET['cb'];
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/gallery/".$_POST['img_awal']);
				unlink("uploads/gallery/thumb/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"gallery",TRUE);
			}
			unset($_POST['img_awal']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'foto', array('id_foto' => $id));
            if($update){
                redirect($this->template['url'].'foto-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'foto-new?_id='.$id.'&s=true&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
            //$_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"gallery",TRUE);
			}
            $insert_id = $this->model_global->insert($_POST, 'foto');
            if($insert_id){
                redirect($this->template['url'].'foto-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'foto-new?_id='.$id.'&s=true&m=Data Gagal Disimpan');
            }
        }
    }
	public function videoProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				unlink("uploads/video/".$_POST['img_awal']);
				$_POST['image'] = $this->upload_foto($_FILES['image'],"video",TRUE);
			}
			unset($_POST['img_awal']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');

            $update = $this->model_global->update($_POST, 'video', array('id_video' => $id));
            if($update){
                redirect($this->template['url'].'video-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'video-new?_id='.$id.'&s=true&m=Data Gagal Diubah');
            }
        }
        else{
			unset($_POST['img_awal']);
            //$_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');

			if(empty($_FILES['image']['name'])){
				unset($_POST['image']);
			}else{
				$_POST['image'] = $this->upload_foto($_FILES['image'],"video",TRUE);
			}
            $insert_id = $this->model_global->insert($_POST, 'video');
            if($insert_id){
                redirect($this->template['url'].'video-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'video-new?_id='.$id.'&s=true&m=Data Gagal Disimpan');
            }
        }
    }
	public function orderProses(){
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $update = $this->model_global->update($_POST, 'order', array('id_order' => $id));

            if($update){
				redirect($this->template['url'].'order-detil?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'order-detil?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
    }

	public function userspProses(){
		if(isset($_POST['password'])){
			$_POST['password'] = md5($_POST['password']);
		}else{
			unset($_POST['password']);
		}
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
			$id = $_POST['_id'];
			$ada = $this->model_global->get_data(array('data' => 'row','table' => 'usersp', 'where' => array('username' => $_POST['username'],'id_usersp !='=>$id)));
			if(count($ada)>0){
				redirect($this->template['url'].'usersp-new?_id='.$id.'&s=false&m=Username sudah digunakan');
			}else{
				unset($_POST['action']);
				unset($_POST['_id']);
				$_POST["modified_date"] = date('Y-m-d H:i:s');
				$update = $this->model_global->update($_POST, 'usersp', array('id_usersp' => $id));

				if($update){
					redirect($this->template['url'].'usersp-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
				}
				else{
					redirect($this->template['url'].'usersp-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
				}
			}
        }
        else{
			$ada = $this->model_global->get_data(array('data' => 'row','table' => 'usersp', 'where' => array('username' => $_POST['username'])));
			if(count($ada)>0){
				redirect($this->template['url'].'usersp-new?_id='.$id.'&s=false&m=Username sudah digunakan');
			}else{
				//$_POST["modified_date"] = '';
				$_POST["created_date"] = date('Y-m-d H:i:s');
				$_POST['status']='1';
				$insert_id = $this->model_global->insert($_POST, 'usersp');
				if($insert_id){
					redirect($this->template['url'].'usersp-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
				}
				else{
					redirect($this->template['url'].'usersp-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
				}
			}
        }
    }
	public function userProses(){
		if(isset($_POST['password'])){
			$_POST['password'] = md5($_POST['password']);
		}else{
			unset($_POST['password']);
		}
        if(isset($_POST['action']) && $_POST['action'] == 'edit'){
            $id = $_POST['_id'];
            unset($_POST['action']);
            unset($_POST['_id']);
            $_POST["modified_date"] = date('Y-m-d H:i:s');
            $update = $this->model_global->update($_POST, 'user', array('id_user' => $id));

            if($update){
				redirect($this->template['url'].'user-new?_id='.$id.'&s=true&m=Data Berhasil Diubah');
            }
            else{
                redirect($this->template['url'].'user-new?_id='.$id.'&s=false&m=Data Gagal Diubah');
            }
        }
        else{
            //$_POST["modified_date"] = '';
            $_POST["created_date"] = date('Y-m-d H:i:s');
			$_POST['status']='1';
            $insert_id = $this->model_global->insert($_POST, 'user');
            if($insert_id){
                redirect($this->template['url'].'user-new?_id='.$id.'&s=true&m=Data Berhasil Disimpan');
            }
            else{
                redirect($this->template['url'].'user-new?_id='.$id.'&s=false&m=Data Gagal Disimpan');
            }
        }
    }

	public function upslug($table){
		$data = $this->model_global->get_data(array('select' => '*', 'table' => $table));
		if(isset($data) && count($data) > 0): foreach($data as $row):
			$field = strtolower(trim($row['nama']));
			$slugs = str_replace(" ","-",$field);
			$lat['slug'] = $slugs;
			$this->model_global->update($lat, $table,array('id_'.$table => $row['id_'.$table]));

		endforeach; endif;
	}

    public function deletesoft($table,$id){
		$id_field = 'id_'.$table;
		$table_array = array('web_section','district_campaign');
		if(in_array($table,$table_array)){
			$id_field = 'id';
		}
    	$delete = $this->model_global->delete($table, array( $id_field => $id));

    	if($delete){
			if(isset($_GET['_id'])){
				redirect($this->template['url'].$_GET['part']."?_id=".$_GET['_id']);
			}else{
				if(isset($_GET['k'])){
					redirect($this->template['url'].$_GET['part']."?k=".$_GET['k']);
				}else{
					redirect($this->template['url'].$_GET['part']);
				}
			}
    	}
    	else{
    		redirect(base_url());
    	}
    }
    public function delete($table,$id){
    	//$delete = $this->model_global->delete($table, array('id_'.$table => $id));
		switch($table){
			case "artikel";
				$data = $this->model_global->get_data(array('data' => 'row','table' => 'artikel', 'where' => array('id_artikel' => $id)));
				unlink("uploads/article/".$data['image']);
				unlink("uploads/article/".$data['thumbnail']);
				unlink("uploads/article/thumb/".$data['image']);
				unlink("uploads/article/thumb/".$data['thumbnail']);
			break;
			case "kontributor";
				$data = $this->model_global->get_data(array('data' => 'row','table' => 'kontributor', 'where' => array('id_kontributor' => $id)));
				unlink("uploads/contributor/".$data['image']);
			break;
			case "redeempoint";
				$data = $this->model_global->get_data(array('data' => 'row','table' => 'redeempoint', 'where' => array('id_redeempoint' => $id)));
				unlink("uploads/redeem/".$data['image']);
			break;
			case "soundroom";
				$data = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom', 'where' => array('id_soundroom' => $id)));
				unlink("uploads/soundroom/".$data['sound']);
				unlink("uploads/soundroom/".$data['image']);
				unlink("uploads/soundroom/".$data['thumbnail']);
			break;
            case "soundroom_2023";
                $data = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom_2023', 'where' => array('id_soundroom' => $id)));

                if(file_exists("uploads/soundroom/".$data['sound'])){
                    unlink("uploads/soundroom/".$data['sound']);
                }

                if(file_exists("uploads/soundroom/".$data['image'])){
                    unlink("uploads/soundroom/".$data['image']);
                }

                if(file_exists("uploads/soundroom/".$data['thumbnail'])){
                    unlink("uploads/soundroom/" . $data['thumbnail']);
                }
            break;
            case "soundroom_2024";
                $data = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom_2024', 'where' => array('id_soundroom' => $id)));

                if(file_exists("uploads/soundroom/".$data['sound'])){
                    unlink("uploads/soundroom/".$data['sound']);
                }

                if(file_exists("uploads/soundroom/".$data['image'])){
                    unlink("uploads/soundroom/".$data['image']);
                }

                if(file_exists("uploads/soundroom/".$data['thumbnail'])){
                    unlink("uploads/soundroom/" . $data['thumbnail']);
                }
            break;
			case "soundroom_2025";
                $data = $this->model_global->get_data(array('data' => 'row','table' => 'soundroom_2025', 'where' => array('id_soundroom' => $id)));

                if(file_exists("uploads/soundroom/".$data['sound'])){
                    unlink("uploads/soundroom/".$data['sound']);
                }

                if(file_exists("uploads/soundroom/".$data['image'])){
                    unlink("uploads/soundroom/".$data['image']);
                }

                if(file_exists("uploads/soundroom/".$data['thumbnail'])){
                    unlink("uploads/soundroom/" . $data['thumbnail']);
                }
            break;
            case "slidepodcast";
               $table = 'slide';
            break;
		}

		$id_field = 'id_'.$table;
		if($table == 'slide_district_campaign'){
			$id_field = 'id_slide';
		} elseif($table == 'soundroom_2025'){
            $id_field = 'id_soundroom';
		} elseif($table == 'soundroom_2024'){
            $id_field = 'id_soundroom';
        } elseif($table == 'soundroom_2023'){
            $id_field = 'id_soundroom';
        }

    	$delete = $this->db->delete($table, array($id_field => $id));
    	if($delete){
			if(isset($_GET['_id'])){
				redirect($this->template['url'].$_GET['part']."?_id=".$_GET['_id']);
			}else{
				if(isset($_GET['k'])){
					redirect($this->template['url'].$_GET['part']."?k=".$_GET['k']);
				}else{
					redirect($this->template['url'].$_GET['part']);
				}
			}
    	}
    	else{
    		redirect(base_url());
    	}
    }

    public function setlatest($id,$part){
		$up['latest'] = "0";
		$this->model_global->update($up, "video", array('latest' => '1'));
		$up['latest'] = "1";
		$this->model_global->update($up, "video", array('id_video' => $id));
		redirect($this->template['url'].$part);
	}
    public function delete_ajax($table,$id){
		$res["status_ajx"] = "true";
		$res["hasil"] = "-----";
		$gd = $this->model_global->get_data(array('data' => 'row','table' => "".$table,  'where' => array('id_'.$table => $id)));
		switch($gd['status']){
			case "1";
				$up['status']="0";
				$this->model_global->update($up, "".$table, array('id_'.$table => $id));
				$res["hasil"] = "Tidak Aktif";
			break;
			case "0";
				$up['status']="1";
				$this->model_global->update($up, "".$table, array('id_'.$table => $id));
				$res["hasil"] = "Aktif";
			break;
		}
		$res["seta"] = $up['status'];

		echo json_encode($res);
    }
    public function set_top($table,$id){
		$res["status_ajx"] = "true";
		$res["hasil"] = "-----";
		$gd = $this->model_global->get_data(array('data' => 'row','table' => "".$table,  'where' => array('id_'.$table => $id)));
		$up['top']="0";
		$this->model_global->update($up, "".$table, array());
		$up['top']="1";
		$this->model_global->update($up, "".$table, array('id_'.$table => $id));
		$res["hasil"] = "Aktif";

		echo json_encode($res);
    }

    public function validate_slug($table, $column, $slug, $id = 0) {
        if ($id != 0)
            $this->cimongo->where_ne('_id', new MongoId($id));

        $this->cimongo->like($column, $slug);

        $this->cimongo->order_by(array($column => 'desc'));
        $this->cimongo->limit(1);
        $res = $this->cimongo->get($table);
        if ($res->num_rows() == 0) {
            return $slug;
        } else {
            $row = $res->row_array();
            $slug = $row[$column];
            preg_match('/^(.+)([0-9]+)$/', $slug, $found);
            if (empty($found)) {
                return $slug.'-1';
            } else {
                return $slug.'-'.((int)$found+1);
            }
        }
    }

}
