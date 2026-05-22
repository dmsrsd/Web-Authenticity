<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['default_controller'] = "podcast";

// $route['distrik'] = "distrik/index";
$route['campaign/([a-zA-Z0-9\-]+)'] = 'campaign/index/$1';
// $route['api-login'] = "api/login";
// $route['v2/api/index'] = "apiv2/index";
// $route['v2/api/masuk'] = "apiv2/masuk";
//untuk campaighn purple duo 16-08-2024
$route['purple-duo'] = 'purpleduo/index';
$route['purple-duo-home'] = 'purpleduo/register';
$route['kirim-purple-duo'] = 'purpleduo/submit_register';
$route['pertanyaan/(:num)'] = 'purpleduo/pertanyaan/$1';
$route['kirim-pertanyaan/(:num)'] = 'purpleduo/submit_pertanyaan/$1';
$route['caracter'] = 'purpleduo/caracter';
$route['card/(:num)'] = 'purpleduo/card/$1';

//end campaighn


$route['api/login'] = 'apicoba/api_login';
$route['api/resetpass'] = 'apicoba/api_resetpassword';
$route['api/register'] = 'apicoba/api_register';
$route['api/provinsi'] = 'apicoba/api_provinsi';
$route['api/kota'] = 'apicoba/api_kota';


$route['podcast/naik-kelas'] = "podcast/naikkelas";
$route['campaign-merch'] = 'podcast/merch';
$route['campaign-merchmember'] = 'podcast/merch_member';
// $route['podcast/naik-clas'] = "podcast/naikkelas";
$route['accept-cookie'] = "podcast/acceptcookie";
// $route['submit-visitor'] = "podcast/submitvisitor";
$route['lab'] = "store";
$route['lab-detail/([a-zA-Z0-9\-]+)'] = "store/detail/$1";

// $route['tnc-rewards'] = "tnc/tncrewards";
$route['Merchon'] = "merchon";
$route['tentang'] = "tnc/tentang";
$route['privacy'] = "tnc/privacy";
$route['register'] = "login/register";
$route['register-thanks'] = "login/registerthanks";
$route['register-thanks-tts'] = "login/registerthanks";
$route['article'] = 'artikel';
$route['read/([a-zA-Z0-9\-]+)'] = 'artikel/read/$1';
$route['contributor/([a-zA-Z0-9\-]+)'] = 'contributor/read/$1';
$route['tag/([a-zA-Z0-9\-]+)'] = 'artikel/tag/$1';
$route['category/([a-zA-Z0-9\-]+)/all'] = 'artikel/headcategory/$1';
$route['category/([a-zA-Z0-9\-]+)/([a-zA-Z0-9\-]+)'] = 'artikel/category/$1/$2';
// $route['rewards/what-band-are-you'] = 'rewards/band';
// $route['rewards/what-band-are-you-share'] = 'rewards/bandshare';
// $route['rewards/on-ground'] = 'rewards/qr';
// $route['rewards/qr-special'] = 'rewards/qrspecial';
// $route['rewards/se/([a-zA-Z0-9\-]+)'] = 'rewards/landingqrspecial/$1';
$route['search'] = 'home/search';
$route['reset-password'] = 'login/resetform';

// $route['order/([a-zA-Z0-9\-]+)'] = 'order/detail/$1';
// $route['ini-asli-gue'] = 'iniasligue';
// $route['design-competition-with-darbotz'] = 'designcompetition';
// $route['design-competition-download-template'] = 'designcompetition/downloadtemplate';
//$route['design-competition-download-template'] = 'uploads/designcompetition/Design_Template_&_Mockup-20200509T161659Z-001.zip';

// $route['new-campaign'] = 'newcampaign';
// $route['new-campaign-download-template'] = 'newcampaign/downloadtemplate';

// $route['memorirasamatraman'] = 'newcampaign';
// $route['memorirasamatraman-download-template'] = 'newcampaign/downloadtemplate';

$route['authentic-store'] = 'store';
$route['authentic-store/([a-zA-Z0-9\-]+)'] = 'store/read/$1';

//$route['soundroom'] = 'soundroom';
//$route['soundroom/tiga'] = 'soundroom/tiga';
//$route['soundroom/([a-zA-Z0-9\-]+)'] = 'soundroom/read/$1';
$route['soundroom/getsoundroom'] = 'soundroom/getsoundroom';
$route['soundroom/getpoint'] = 'soundroom/getpoint';
$route['soundroom/getPlayList2'] = 'soundroom/getPlayList2';
/*
$route['soundroom2'] = 'soundroom2';
$route['soundroom2/getPlayList'] = 'soundroom2/getPlayList';
$route['soundroom2/getBand'] = 'soundroom2/getBand';
$route['soundroom-mechanism'] = 'soundroom2/mechanism';
$route['soundroom-vote'] = 'soundroom2/vote';
$route['soundroom-video'] = 'soundroom2/video';
*/
$route['soundroom'] = 'soundroom';
$route['soundroom/getPlayList'] = 'soundroom/getPlayList';
$route['soundroom/getBand'] = 'soundroom/getBand';
$route['soundroom-mechanism'] = 'soundroom/mechanism';
$route['soundroom-vote'] = 'soundroom/vote';
$route['soundroom-video'] = 'soundroom/video';

$route['poster-challenge'] = 'posterchallenge';
$route['poster-challenge/([a-zA-Z0-9\-]+)'] = 'posterchallenge/read/$1';
$route['profile/poster-challenge'] = 'profile/posterchallenge';

// $route['twitter/callback'] = 'login/twitter_callback';
// $route['facebook/callback'] = 'login/facebook_callback';
// $route['facebook/removedata'] = 'login/facebook_logout';
$route['google/callback'] = 'login/google_callback';
// $route['dev/member'] = 'login/member_cek';

$route['webadmin'] = 'cms/auth';
$route['webadmin/auth/in'] = 'cms/auth/in';
$route['webadmin/auth/out'] = 'cms/auth/out';
$route['webadmin/dashboard'] = 'cms/dashboard';
$route['webadmin/dashboard/([a-zA-Z0-9\-]+)'] = 'cms/dashboard/reroute';
$route['webadmin/logic/delete/([a-zA-Z0-9\-]+)/([a-zA-Z0-9\-]+)'] = 'logic/delete/$1/$2';

$route['sp'] = 'sp/auth';
$route['sp/auth/in'] = 'sp/auth/in';
$route['sp/auth/out'] = 'sp/auth/out';
$route['sp/dashboard'] = 'sp/dashboard';
$route['sp/dashboard/([a-zA-Z0-9\-]+)'] = 'sp/dashboard/reroute';
$route['sp/logic/delete/([a-zA-Z0-9\-]+)/([a-zA-Z0-9\-]+)'] = 'logic/delete/$1/$2';

$route['event'] = 'event/index';
$route['event-detail/(:any)'] = 'event/detail/$1';
// $route['event/(:any)'] = 'event/detail/$1';
// mulai event duoverse
// $route['duoverse'] = 'duoverse/index';
// $route['duoverse/profile'] = 'duoverse/profile';
// $route['duoverse/klaim/(:any)'] = 'duoverse/klaim/$1';
// $route['duoverse/list'] = 'duoverse/list';
// $route['duoverse/list/(:num)'] = 'duoverse/list';
// $route['duoverse-circle'] = "duoverse/sarat_ketentuan";
// $route['duoverse/screnning'] = 'duoverse/redirect_cek';
//selesai even
$route['hangout'] = "duoverse/hangout";
/*
$route['404_override'] = 'home';
$route['db_override'] = 'home';
$route['genearl_override'] = 'home';
$route['php_override'] = 'home';
$route['translate_uri_dashes'] = FALSE;
$route['400_override'] = 'home/respon_400';
*/
/* End of file routes.php */
/* Location: ./application/config/routes.php */


$route['404_override'] = 'home/respon_400';
$route['db_override'] = 'home/respon_400';
$route['genearl_override'] = 'home/respon_400';
$route['php_override'] = 'home/respon_400';
$route['translate_uri_dashes'] = FALSE;

$route['soundroom-2026'] = 'soundroom/landing_2026';