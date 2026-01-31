<?php defined('BASEPATH') OR exit('No direct script access allowed');
// $config['protocol'] = 'smtp';
// $config['mailpath'] = '/usr/sbin/sendmail';


$config['smtp_host'] = 'smtp.zoho.com';
$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
$config['smtp_user'] = 'admin@simplyauthentic.id';
$config['smtp_pass'] = '#m4g4pr0';
$config['smtp_timeout'] = '7';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n";
$config['smtp_crypto'] = 'ssl';

// //$config['smtp_user'] = 'info@simplyauthentic.id';
// //$config['smtp_pass'] = 'clasmild16';

// //$config['smtp_host'] = 'smtp.gmail.com';
// //$config['smtp_user'] = 'noreplyauthenticity@gmail.com';
// //$config['smtp_pass'] = 'fqfnfzradwlxzzzt';



// $config = array(
//     'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
//     'mailpath' => '/usr/sbin/sendmail',
//     'smtp_host' => 'smtp-relay.sendinblue.com', 
//     'smtp_port' => '465',
//     'smtp_timeout' => '7', //in seconds
//     'smtp_user' => 'admin@simplyauthentic.id',
//     'smtp_pass' => '13rBws6z9I7WvtDq',
//     'charset' => 'utf-8',
//     'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
//     'mailtype' => 'html', //plaintext 'text' mails or 'html'
//     'newline' => '\r\n'
    
// );