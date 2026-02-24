<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session','database',"excel","encrypt");
$autoload['helper'] = array('url','cookie',"html","form","array","informasi","dev");
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('model_global','authmodel'); 
 
/* End of file autoload.php */
/* Location: ./application/config/autoload.php */