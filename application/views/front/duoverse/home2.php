<?php
// Pastikan tidak ada output (echo, HTML) sebelum fungsi header() dipanggil
// Ini adalah kode redirect 302 (sementara)
header("Location: " . base_url());
exit(); // Penting: menghentikan eksekusi script setelah redirect
?>