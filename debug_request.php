<?php
/**
 * Jalankan dari CMD: php debug_request.php
 * Untuk melihat error asli yang menyebabkan 502.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(__DIR__);

$_SERVER['HTTP_HOST']       = '127.0.0.1:8080';
$_SERVER['REQUEST_URI']     = '/';
$_SERVER['SCRIPT_NAME']     = '/index.php';
$_SERVER['QUERY_STRING']    = '';
$_SERVER['REQUEST_METHOD']  = 'GET';
$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';

require 'index.php';
