<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['appId']   = '726351680777198';
$config['appSecret']  = 'b7c1d4089b010820e1078016a5933392';

$config['facebook_app_id']                = '409129732759557';
$config['facebook_app_secret']            = '53694b948f97b075782811e9dee28340';
$config['facebook_login_redirect_url']    = 'facebook/callback';
$config['facebook_logout_redirect_url']   = 'facebook/logout';
$config['facebook_login_type']            = 'web';
$config['facebook_permissions']           = array('email');
$config['facebook_graph_version']         = 'v3.2';
$config['facebook_auth_on_load']          = TRUE;

$config['fb_config'] = array(
    'app_id'  => FB_KEY,
    'app_secret' => FB_SECRET,
    'default_graph_version' => 'v2.5'
); 

$config['fb_config_2'] = array(
    'app_id'  => FB_2_KEY,
    'app_secret' => FB_2_SECRET,
    'default_graph_version' => 'v2.5'
); 
?>
