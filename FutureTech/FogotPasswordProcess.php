<?php

require "Exception.php";
require "SMTP.php";
require "PHPMailer.php";
require "connection.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {
  $email = $_GET["e"];

  if (empty($email)) {
    echo "Please Enter An Valid Email";
  } else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' ");
    if ($rs->num_rows == 1) {
      $code = uniqid();
      Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`= '" . $email . "'");

      // email code
      $mail = new PHPMailer;
      $mail->IsSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'chamodnadeeshan91@gmail.com';
      $mail->Password = 'your_password';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;
      $mail->setFrom('chamodnadeeshan91@gmail.com', 'theMobileShop');
      $mail->addReplyTo('chamodnadeeshan91@gmail.com', 'theMobileShop');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'eshop Fogot Password Verification Code';
      $bodyContent = '<h1 style="color:red;">Hi Your  Validation Code is :' . $code . '</h1>';
      $bodyContent .= '<p>Submit The Code in Web page</p>';
      $mail->Body    = $bodyContent;
      if (!$mail->send()) {
        echo "email Validation Failed";
      } else {
        echo "success";
      }
    } else {
      echo "Email Address Not Found";
    }
  }
} else {
  echo "Please Enter Your Email Address";
}
