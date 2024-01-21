<?php

require "Exception.php";
require "SMTP.php";
require "PHPMailer.php";
require "connection.php";

use PHPMailer\PHPMailer\PHPMailer;

$new_category = $_POST["n"];
$user_email = $_POST["e"];
$rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%" . $new_category . "%' ");
$rsn = $rs->num_rows;
if ($rsn == 0) {

   $code = uniqid();
   Database::iud("UPDATE  `admin` SET `code` = '" . $code . "' WHERE `email` = '" . $user_email . "' ");

   // email code
   $mail = new PHPMailer;
   $mail->IsSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'your-email';
   $mail->Password = 'your_password';
   $mail->SMTPSecure = 'ssl';
   $mail->Port = 465;
   $mail->setFrom('chamodnadeeshan91@gmail.com', 'theMobileShop');
   $mail->addReplyTo('chamodnadeeshan91@gmail.com', 'theMobileShop');
   $mail->addAddress($user_email);
   $mail->isHTML(true);
   $mail->Subject = 'theMobileShop category Verification Code';
   $bodyContent = '<h1 style="color:red;">Hi Your  Validation Code is :' . $code . '</h1>';
   $bodyContent .= '<p>Submit The Code in Web page</p>';
   $mail->Body    = $bodyContent;
   if (!$mail->send()) {
      echo "email Validation Failed";
   } else {
      echo "success";
   }
} else {
   echo "A Similar Category Already Exists";
}
