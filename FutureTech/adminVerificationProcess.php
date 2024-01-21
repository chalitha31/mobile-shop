<?php
// require "connection.php";
require "connection.php";
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";



use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_POST["e"])) {
  echo "Please Enter Your Email";
} else if (!filter_var($_POST["e"], FILTER_VALIDATE_EMAIL)) {
  echo "Please Enter a Valid Email";
} else {
  $email = $_POST["e"];

  $rs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "'");

  if ($rs->num_rows == 1) {
    $code = uniqid();
    Database::iud("UPDATE `admin` SET `code` = '" . $code . "' WHERE `email` = '" . $email . "' ");

    // email code
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email';
    $mail->Password = 'your_password';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('your_password', 'theMobileShop');
    $mail->addReplyTo('your_password', 'theMobileShop');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Admin Verification Code';
    $bodyContent = '<h1 style="color:red;"><b>Your verification code is : </b>' . $code . '</h1>';
    $mail->Body = $bodyContent;

    if (!$mail->send()) {
      echo "Decline email Sending Failed";
    } else {
      $resultset = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' AND `code` = '" . $code . "'");
      $n = $resultset->num_rows;

      if ($n == 1) {

        $d = $resultset->fetch_assoc();
        $_SESSION["a"] = $d;
        echo "Succes";
      }
    }
  } else {
    echo "Invalid User";
  }
}
