<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */

//-- SOCIAL-MEDIA
define('FB_KEY', '842458194345015');
define('FB_SECRET', 'dc111d16336a8c6d6c12539318c73ad9');
define('FB_CALLBACK', 'facebook/callback');
// define('FB_2_KEY', '726351680777198');
// define('FB_2_SECRET', 'b7c1d4089b010820e1078016a5933392');
// define('FB_2_CALLBACK', 'facebook/callback');
define('FB_2_KEY', '3499385966990227');
define('FB_2_SECRET', '0d9d22a25b5d76adfa3e3145d2b7095e');
define('FB_2_CALLBACK', 'facebook/callback');

// define('TW_KEY', 'RExIZFFHaV93dGJ5RC1FcjhwSHk6MTpjaQ');
// define('TW_SECRET', 'BULzZHqHPQgj_fSKwBCseGieYnSAm_MpoAJykt91G-2lnb0Yt2');
// define('TW_TOKEN', '');
// define('TW_TOKENSECRET', '');
// define('TW_CALLBACK', 'twitter/callback');
define('TW_KEY', 'LR01vn9VX4YsdBW4A4WigCYCZ');
define('TW_SECRET', 'D1kqq38ThQAE28ves5mtGa6tDQT6ZwrNQL8aZsIQmZFVldjVCZ');
define('TW_TOKEN', '97940825-xZCtxZYF7PrSciDPqWY2ZkuC1Dh0iS2snm6kTe2uH');
define('TW_TOKENSECRET', 'to6z0sRy3lzmWDtkRaZ6OqVxunrS1bjdUN8zVJJQ3rDPo');
define('TW_CALLBACK', 'twitter/callback');

define('G_KEY', '803454176006-4ttpk3v6mamqrh9rbie29iqm7ks2tqub.apps.googleusercontent.com');
define('G_SECRET', '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');

// define('G_KEY', '143902880987-es788bkmkvd7d23259m7bovslgqbg2to.apps.googleusercontent.com');
// define('G_SECRET', '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');
// define('G_2_KEY', '537803613132-defd1b2bhv5a0ab03g3k5hukml1c57a6.apps.googleusercontent.com');
// define('G_2_SECRET', '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');