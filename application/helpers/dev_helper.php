<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Return true jika dijalankan di localhost/127.0.0.1 (untuk nonaktifkan pixel/analytics di dev).
 */
function is_localhost() {
	return isset($_SERVER['HTTP_HOST']) && (
		strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ||
		strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false
	);
}
