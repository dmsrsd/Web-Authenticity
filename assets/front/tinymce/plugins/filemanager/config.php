<?php
if($_SESSION["verifytnmcmember"] == "") die('forbidden');
$dirmember = $_SESSION["verifytnmcmember"];
// $root = rtrim($_SERVER['DOCUMENT_ROOT'],'/'); // don't touch this configuration
$root = '';

//**********************
//Path configuration
//**********************
// In this configuration the folder tree is
// root
//   |- tinymce
//   |    |- source <- upload folder
//   |    |- js
//   |    |   |- tinymce
//   |    |   |    |- plugins
//   |    |   |    |-   |- filemanager
//   |    |   |    |-   |-      |- thumbs <- folder of thumbs [must have the write permission]

define('BASEPATH', 'http://www.authenticity.id/'); 
// define('BASEPATH', 'http://cdn.pastisuka.com/');

$base_url       = BASEPATH.'uploads/tinymcemember/'.$dirmember."/"; //Link url to upload file
/* localhost*/
$current_path     = rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/cl/simplici3/uploads/tinymcemember/'.$dirmember."/"; // relative url to upload file location path
$upload_dir   = rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/cl/simplici3/assets/front/tinymce/plugins/filemanager/thumbs/'.$dirmember."/"; // relative url to create thumbs for view from upload file location path
/* END LOCALHOST */
/* PASTISUKA.COM */
// $current_path = rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/../upload/img/tinymce/'; // relative url to upload file location path
// $upload_dir   = rtrim($_SERVER['DOCUMENT_ROOT'],'/').'/assets/plugins/tinymce/plugins/filemanager/thumbs/'; // relative url to create thumbs for view from upload file location path
/* END PASTISUKA.COM */

$MaxSizeUpload=100; //Mb

//**********************
//Image config
//**********************
//set max width pixel or the max height pixel for all images
//If you set dimension limit, automatically the images that exceed this limit are convert to limit, instead
//if the images are lower the dimension is maintained
//if you don't have limit set both to 0
$image_max_width=0;
$image_max_height=0;

//Automatic resizing //
//If you set true $image_resizing the script convert all images uploaded in image_width x image_height resolution
//If you set width or height to 0 the script calcolate automatically the other size
$image_resizing=false;
$image_width=600;
$image_height=0;

//******************
//Permits config
//******************
$delete_file=true;
$create_folder=true;
$delete_folder=true;
$upload_files=true;


//**********************
//Allowed extensions
//**********************
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'); //Images
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv','html','psd','sql','log','fla','xml','ade','adp','ppt','pptx'); //Files
$ext_video = array('mov', 'mpeg', 'mp4', 'avi', 'mpg','wma'); //Videos
$ext_music = array('mp3', 'm4a', 'ac3', 'aiff', 'mid'); //Music
$ext_misc = array('zip', 'rar','gzip'); //Archives


$ext=array_merge($ext_img, $ext_file, $ext_misc, $ext_video,$ext_music); //allowed extensions
?>