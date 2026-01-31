<?php
date_default_timezone_set('Asia/Jakarta');

header('Access-Control-Allow-Origin: https://www.authenticity.id,https://authenticity.id,103.10.128.14,127.0.0.1,103.58.103.188,103.58.103.189,104.17.3.81,104.17.188.24,43.231.128.193');
//CSP only works in modern browsers Chrome 25+, Firefox 23+, Safari 7+
$headerCSP = "Content-Security-Policy:".
        //"connect-src 'self' https://sdk-06.moengage.com/ 'unsafe-inline' ;". // XMLHttpRequest (AJAX request), WebSocket or EventSource.
        "default-src 'self' data: https://*.moengage.com https://app-cdn.moengage.com/ https://moe-email-campaigns.s3.amazonaws.com/ https://image.moengage.com/ https://image-eu.moengage.com/ https://image-ap1.moengage.com/ https://image-04.moengage.com/ https://image.moengage.com/all-campaign-images-moe-dc-100/ https://sdk-01.moengage.com/ https://sdk-02.moengage.com/ https://sdk-03.moengage.com/ https://sdk-04.moengage.com/ https://sdk-06.moengage.com/ https://fonts.bunny.net/ lh3.googleusercontent.com googleusercontent.com https://demo-1.conversionsapigateway.com https://mpc-prod-17-s6uit34pua-wl.a.run.app https://cdn.shopimgs.com/ https://www.facebook.com/ https://www.googleadservices.com/ https://www.google.com/ https://analytics.google.com/ https://www.google-analytics.com https://image-06.moengage.com/ https://sdk-06.moengage.com/ https://cdn.moengage.com/ https://stats.g.doubleclick.net/ http://staging.doku.com/Suite/CheckStatus https://www.googleadservices.com https://www.google-analytics.com/ https://www.googletagmanager.com/ https://www.facebook.com/ https://connect.facebook.net/ https://platform.twitter.com/ code.jquery.com https://ssl.google-analytics.com/ https://web.facebook.com/ https://fonts.gstatic.com/ https://analytics.google.com/ https://cdn.shopimgs.com/ https://www.google.com/ https://td.doubleclick.net/ https://analytics.tiktok.com/ 'unsafe-inline' ;". // Default policy for loading html elements
        //"frame-ancestors 'self' ;". //allow parent framing - this one blocks click jacking and ui redress
        //"frame-src 'self' 'unsafe-inline' https://platform.twitter.com https://web.facebook.com https://staticxx.facebook.com/ ;". // vaid sources for frames
        //"media-src 'self' ".//*.example.com;". // vaid sources for media (audio and video html tags src)
        //"object-src 'none'; ". // valid object embed and applet tags src
        //"report-uri https://example.com/violationReportForCSP.php;". //A URL that will get raw json data in post that lets you know what was violated and blocked
        "frame-src 'self' 'unsafe-eval' https://*.moengage.com https://app-cdn.moengage.com/ https://moe-email-campaigns.s3.amazonaws.com/ https://image.moengage.com/ https://image-eu.moengage.com/ https://image-ap1.moengage.com/ https://image-04.moengage.com/ https://image.moengage.com/all-campaign-images-moe-dc-100/ https://sdk-01.moengage.com/ https://sdk-02.moengage.com/ https://sdk-03.moengage.com/ https://sdk-04.moengage.com/ https://sdk-06.moengage.com/ https://fonts.bunny.net/ lh3.googleusercontent.com googleusercontent.com https://demo-1.conversionsapigateway.com https://mpc-prod-17-s6uit34pua-wl.a.run.app https://cdn.shopimgs.com/ https://www.facebook.com/ https://www.googleadservices.com/ https://www.google.com/ https://analytics.google.com/ https://www.google-analytics.com https://cdn.moengage.com/ https://image-06.moengage.com/ https://sdk-06.moengage.com/ https://cdn.moengage.com/ https://app.midtrans.com/  https://app.sandbox.midtrans.com/ https://bid.g.doubleclick.net/ https://connect.facebook.net/ https://syndication.twitter.com/settings http://www.youtube.com/ https://analytics.google.com/ https://staticxx.facebook.com/ https://www.facebook.com/ https://platform.twitter.com/ https://web.facebook.com/ https://cdn.shopimgs.com/ https://www.google.com/ https://td.doubleclick.net/ https://www.googletagmanager.com/ https://td.doubleclick.net/ https://analytics.tiktok.com/ 'unsafe-inline';". // allows js from self, jquery and google analytics.  Inline allows inline js
        "script-src 'self' 'unsafe-eval' https://*.moengage.com https://app-cdn.moengage.com/ https://moe-email-campaigns.s3.amazonaws.com/ https://image.moengage.com/ https://image-eu.moengage.com/ https://image-ap1.moengage.com/ https://image-04.moengage.com/ https://image.moengage.com/all-campaign-images-moe-dc-100/ https://sdk-01.moengage.com/ https://sdk-02.moengage.com/ https://sdk-03.moengage.com/ https://sdk-04.moengage.com/ https://sdk-06.moengage.com/ https://fonts.bunny.net/ lh3.googleusercontent.com googleusercontent.com https://demo-1.conversionsapigateway.com https://mpc-prod-17-s6uit34pua-wl.a.run.app https://cdn.shopimgs.com/ https://www.facebook.com/ https://www.googleadservices.com/ https://www.google.com/ https://analytics.google.com/ https://www.google-analytics.com https://image-06.moengage.com/ https://sdk-06.moengage.com/ https://cdn.moengage.com/ https://cdn.moengage.com/ https://app-cdn.moengage.com/ https://app.midtrans.com/snap/snap.js https://app.sandbox.midtrans.com/snap/snap.js https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js http://www.googleadservices.com/pagead/conversion_async.js https://www.tagmanager.google.com https://www.googleadservices.com https://googleads.g.doubleclick.net/ https://www.googleadservices.com/pagead/conversion_async.js https://www.google-analytics.com/analytics.js https://www.googletagmanager.com/ https://platform.twitter.com/ https://analytics.google.com/ https://connect.facebook.net/ https://platform.twitter.com/ https://cdn.shopimgs.com/ code.jquery.com https://ssl.google-analytics.com/ https://js-agent.newrelic.com/ https://www.google.com/ https://td.doubleclick.net/ https://analytics.tiktok.com/ 'unsafe-inline';". // allows js from self, jquery and google analytics.  Inline allows inline js
        "style-src 'self'  data: https://*.moengage.com https://app-cdn.moengage.com/ https://moe-email-campaigns.s3.amazonaws.com/ https://image.moengage.com/ https://image-eu.moengage.com/ https://image-ap1.moengage.com/ https://image-04.moengage.com/ https://image.moengage.com/all-campaign-images-moe-dc-100/ https://sdk-01.moengage.com/ https://sdk-02.moengage.com/ https://sdk-03.moengage.com/ https://sdk-04.moengage.com/ https://sdk-06.moengage.com/ https://fonts.bunny.net/ lh3.googleusercontent.com googleusercontent.com https://demo-1.conversionsapigateway.com https://mpc-prod-17-s6uit34pua-wl.a.run.app https://cdn.shopimgs.com/ https://www.facebook.com/ https://www.googleadservices.com/ https://www.google.com/ https://analytics.google.com/ https://www.google-analytics.com https://cdn.moengage.com/ https://app-cdn.moengage.com/ https://fonts.bunny.net/ https://image-06.moengage.com/ https://sdk-06.moengage.com/ https://fonts.googleapis.com/ https://www.googletagmanager.com/ https://td.doubleclick.net/ 'unsafe-inline' ;".// allows css from self and inline allows inline css
        "connect-src 'self'  data: https://*.moengage.com https://app-cdn.moengage.com/ https://moe-email-campaigns.s3.amazonaws.com/ https://image.moengage.com/ https://image-eu.moengage.com/ https://image-ap1.moengage.com/ https://image-04.moengage.com/ https://image.moengage.com/all-campaign-images-moe-dc-100/ https://sdk-01.moengage.com/ https://sdk-02.moengage.com/ https://sdk-03.moengage.com/ https://sdk-04.moengage.com/ https://sdk-06.moengage.com/ https://fonts.bunny.net/ lh3.googleusercontent.com googleusercontent.com https://demo-1.conversionsapigateway.com https://mpc-prod-17-s6uit34pua-wl.a.run.app https://cdn.shopimgs.com/ https://www.facebook.com/ https://www.googleadservices.com/ https://www.google.com/ https://analytics.google.com/ https://www.google-analytics.com https://sdk-01.moengage.com/ https://sdk-02.moengage.com/ https://sdk-03.moengage.com/ https://sdk-04.moengage.com/ https://sdk-06.moengage.com/ https://image-06.moengage.com/ https://sdk-06.moengage.com/ https://fonts.googleapis.com/ https://www.googletagmanager.com/ https://td.doubleclick.net/ https://analytics.tiktok.com/ 'unsafe-inline' ;".// allows css from self and inline allows inline css        
        "img-src 'self'  data: https://*.moengage.com https://app-cdn.moengage.com/ https://moe-email-campaigns.s3.amazonaws.com/ https://image.moengage.com/ https://image-eu.moengage.com/ https://image-ap1.moengage.com/ https://image-04.moengage.com/ https://image.moengage.com/all-campaign-images-moe-dc-100/ https://sdk-01.moengage.com/ https://sdk-02.moengage.com/ https://sdk-03.moengage.com/ https://sdk-04.moengage.com/ https://sdk-06.moengage.com/ https://fonts.bunny.net/ lh3.googleusercontent.com googleusercontent.com https://demo-1.conversionsapigateway.com https://mpc-prod-17-s6uit34pua-wl.a.run.app https://cdn.shopimgs.com/ https://www.facebook.com/ https://www.googleadservices.com/ https://www.google.com/ https://analytics.google.com/ https://www.google-analytics.com https://s3.amazonaws.com/ https://image-06.moengage.com/ https://sdk-06.moengage.com/ https://cdn.moengage.com/ https://moe-email-campaigns.s3.amazonaws.com/ https://image.moengage.com/ https://i.ytimg.com/ https://www.google.co.id/ https://googleads.g.doubleclick.net https://www.google.co.id https://stats.g.doubleclick.net/ https://www.google.com/ https://www.google-analytics.com/ https://www.facebook.com/ https://analytics.google.com/ https://web.facebook.com/ https://cdn.shopimgs.com/ https://www.google.com/ https://td.doubleclick.net/ https://www.googletagmanager.com/ https://analytics.tiktok.com/ 'unsafe-inline' ;";// allows css from self and inline allows inline css
		//"script-src-elem 'self' 'unsafe-eval' https://connect.facebook.net/en_US/all.js https://www.googletagmanager.com/ 'unsafe-inline';";
//Sends the Header in the HTTP response to instruct the Browser how it should handle content and what is whitelisted
//Its up to the browser to follow the policy which each browser has varying support
header($headerCSP);
//X-Frame-Options is not a standard (note the X- which stands for extension not a standard)
//This was never officially created but is supported by a lot of the current browsers in use in 2015 and will block iframing of your website
header('X-Frame-Options: SAMEORIGIN');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
	//define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
define('ENVIRONMENT', 'production');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
// var_dump(ENVIRONMENT);
// die();
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}
#ini_set('display_errors', 1);
ini_set('display_errors', 0);
/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */
	$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you do,
 * use an absolute (full) server path.
 * For more info please see the user guide:
 *
 * https://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 */
	$application_folder = 'application';

/*
 *---------------------------------------------------------------
 * VIEW DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want to move the view directory out of the application
 * directory, set the path to it here. The directory can be renamed
 * and relocated anywhere on your server. If blank, it will default
 * to the standard location inside your application directory.
 * If you do move this, use an absolute (full) server path.
 *
 * NO TRAILING SLASH!
 */
	$view_folder = '';


/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here. For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT: If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller. Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 */
	// The directory name, relative to the "controllers" directory.  Leave blank
	// if your controller is not in a sub-directory within the "controllers" one
	// $routing['directory'] = '';

	// The controller class file name.  Example:  mycontroller
	// $routing['controller'] = '';

	// The controller function you wish to be called.
	// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 */
	// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

	// Set the current directory correctly for CLI requests
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (($_temp = realpath($system_path)) !== FALSE)
	{
		$system_path = $_temp.DIRECTORY_SEPARATOR;
	}
	else
	{
		// Ensure there's a trailing slash
		$system_path = strtr(
			rtrim($system_path, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		).DIRECTORY_SEPARATOR;
	}

	// Is the system path correct?
	if ( ! is_dir($system_path))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3); // EXIT_CONFIG
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// Path to the system directory
	define('BASEPATH', $system_path);

	// Path to the front controller (this file) directory
	define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

	// Name of the "system" directory
	define('SYSDIR', basename(BASEPATH));

	// The path to the "application" directory
	if (is_dir($application_folder))
	{
		if (($_temp = realpath($application_folder)) !== FALSE)
		{
			$application_folder = $_temp;
		}
		else
		{
			$application_folder = strtr(
				rtrim($application_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
	{
		$application_folder = BASEPATH.strtr(
			trim($application_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}

	define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

	// The path to the "views" directory
	if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.'views';
	}
	elseif (is_dir($view_folder))
	{
		if (($_temp = realpath($view_folder)) !== FALSE)
		{
			$view_folder = $_temp;
		}
		else
		{
			$view_folder = strtr(
				rtrim($view_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
	}
	elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
	{
		$view_folder = APPPATH.strtr(
			trim($view_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
	else
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3); // EXIT_CONFIG
	}

	define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH.'core/CodeIgniter.php';
