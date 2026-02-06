<?php
/**
 * Router untuk PHP built-in server (development lokal).
 * Jalankan: php -S 127.0.0.1:8081 router.php
 * (Pakai 8081 agar tidak bentrok dengan Nginx di WSL yang pakai 8080.)
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Jalankan debug_request.php lewat browser (sama seperti php debug_request.php di CLI)
if ($uri === '/debug_request.php') {
    ob_start();
    $_SERVER['REQUEST_URI']     = '/';
    $_SERVER['SCRIPT_NAME']     = '/index.php';
    $_SERVER['QUERY_STRING']    = '';
    $_SERVER['REQUEST_METHOD']  = 'GET';
    require __DIR__ . '/index.php';
    ob_end_flush();
    return true;
}

// Endpoint debug: ?debug=1 atau /?debug=1 — tampilkan penyebab 502 (tanpa load full app)
if (isset($_GET['debug']) || (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'debug=1') !== false)) {
    header('Content-Type: text/html; charset=utf-8');
    echo '<h2>Debug</h2><pre>';
    echo "PHP: " . PHP_VERSION . "\n";
    echo "Document root: " . __DIR__ . "\n";
    $host = 'localhost';
    $user = 'root';
    $pass = 'admin123';
    $db   = 'gridsf';
    $conn = @new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        echo "MySQL: GAGAL - " . $conn->connect_error . "\n";
        echo "\nJika MySQL jalan di WSL dan PHP di Windows, ubah host di application/config/database.php jadi IP WSL (di WSL jalankan: hostname -I)\n";
    } else {
        echo "MySQL: OK\n";
        $conn->close();
    }
    echo '</pre><p><a href="/">Coba buka homepage</a></p>';
    return true;
}

// Buffer output agar BOM/whitespace di file lain tidak bikin "headers already sent"
ob_start();

// Jangan jalankan app untuk favicon / request ke file yang jelas
if (preg_match('#^/favicon\.(ico|png)$#', $uri)) {
    ob_end_clean();
    header('HTTP/1.1 204 No Content');
    return true;
}
// Serve font/asset dengan CORS agar localhost dan 127.0.0.1 dianggap sama (hindari CORS block)
$file = __DIR__ . $uri;
if ($uri !== '/' && $uri !== '' && file_exists($file) && is_file($file)) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $fontExts = ['woff', 'woff2', 'ttf', 'otf', 'eot'];
    if (in_array($ext, $fontExts)) {
        ob_end_clean();
        $mimes = ['woff' => 'font/woff', 'woff2' => 'font/woff2', 'ttf' => 'font/ttf', 'otf' => 'font/otf', 'eot' => 'application/vnd.ms-fontobject'];
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: ' . (isset($mimes[$ext]) ? $mimes[$ext] : 'application/octet-stream'));
        readfile($file);
        return true;
    }
    ob_end_clean();
    return false; // serve file as-is
}
// Jangan ubah REQUEST_URI — CodeIgniter pakai format clean URL
require __DIR__ . '/index.php';
ob_end_flush();
