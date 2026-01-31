<?php
// Include library PHPMailer secara manual
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Konfigurasi email
$mail = new PHPMailer(true);

try {
    // Pengaturan SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';                // Server SMTP Gmail
    $mail->SMTPAuth   = true;
    $mail->Username   = 'gridsf@gramedia-majalah.com';          // Ganti dengan alamat email Anda
    $mail->Password   = 'zcup oxoy yfug waqs';           // Ganti dengan password email Anda (disarankan menggunakan App Password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Menggunakan TLS
    $mail->Port       = 587;                             // Port Gmail

    // Penerima email
    $mail->setFrom('gridsf@gramedia-majalah.com', 'Nama Anda'); // Pengirim
    $mail->addAddress('eddy.disway@gmail.com', 'Penerima'); // Penerima email

    // Konten email
    $mail->isHTML(true);                                  // Set email format ke HTML
    $mail->Subject = 'Test Email';                        // Subjek email
    $mail->Body    = 'Ini adalah email percobaan.';       // Isi email

    // Kirim email
    $mail->send();
    echo 'Email berhasil dikirim';
} catch (Exception $e) {
    echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
}
