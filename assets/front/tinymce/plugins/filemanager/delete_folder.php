<?php

session_start();
if($_SESSION["verifytnmcmember"] == "") die('forbiden');
include 'config.php';
include('utils.php');

$path=$_POST['path'];
$path_thumbs=$_POST['path_thumb'];

#if(strpos($path,$upload_dir)===FALSE || strpos($path_thumbs,'thumbs')!==0) die('wrong path');

deleteDir($path);
deleteDir($path_thumbs);

?>
