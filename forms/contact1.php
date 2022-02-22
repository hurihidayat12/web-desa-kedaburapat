<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mail/vendor/autoload.php';

function sendmail($untuk, $judul, $isi){
  $body = '<style> .judul { font-size:30px;} .content {font-size:14px;} </style><h1 class="judul">'.
  $judul .'</h1><p class="content">'. $isi .'</p>';

  $mail = new PHPMailer(true);
  try {
      //Server settings
      $mail->isSMTP(); // Set untuk menggunakan SMTP
      $mail->Host = 'smtp.gmail.com'; // tentukan Hostnya dan disini saya menggunakan Gmail
      $mail->SMTPAuth = true; // Enable SMTP autentifikasi
      $mail->Username = 'usersekolahkoding@gmail.com'; // SMTP username
      $mail->Password = 'kopinikmatgakbikinkembung'; // SMTP password
      $mail->SMTPSecure = 'ssl'; // menghidupkan TLS encryption, `ssl` juga
      $mail->Port = 465; // TCP port yang digunakan Gmail, cari port yang digunakan oleh host anda

      //Recipients
      $mail->setFrom('no-reply@sekolahkoding.com', 'ini judul dari mana'); // tentukan dari mana
                      email ini berasal
      $mail->addReplyTo('no-reply@annisa.com', 'Information'); // tentukan kepada siapa user akan
                         mengirim kembali

      // looping dikarenakan fungsi ini bisa mengirim ke beberapa orang dengan mekstrak data array
      // $untuk disini bersifat array
      foreach($untuk as $email => $name)
      {
         $mail->AddCC($email, $name); // tentukan ke pengirim lain
         $mail->addAddress($email); // dikirim kepada siapa
      }

      //Content
      $mail->isHTML(true); // Tentukan format email akan menggunakan HTML
      $mail->Subject = $judul; // tentukan judulnya dengan mengambil varible yang telah diinput
      $mail->Body    = $body; // sama seperti $judul

      $mail->send(); // mengirim
      return true; // kembalikan data true, dan ini akan dieksekusi di file eksekusi nantinya
  } catch (Exception $e) {
      return false; // jika tidak kembalikan data false
  }

}