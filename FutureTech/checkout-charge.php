<?php
include("./config.php");

$token = $_POST["stripeToken"];
$contact_name = $_POST["c_name"];
$token_card_type = $_POST["stripeTokenType"];
$phone           = $_POST["phone"];
$email           = $_POST["stripeEmail"];
$address         = $_POST["address"];
$amount          = $_POST["amount"];
$desc            = $_POST["product_name"];

$advisorid = $_POST["advisor_id"];
$studentemail = $_POST["stu_email"];
$verification_code = $_POST["verify1"];

$charge = \Stripe\Charge::create([
  "amount" => str_replace(",", "", $amount) * 100,
  "currency" => 'lkr',
  "description" => $desc,
  "source" => $token,
]);

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

require "connection.php";

$verifyrs = Database::search("SELECT * FROM `requests` WHERE `student_email`='" . $studentemail . "'
    AND `advisor_id`='" . $advisorid . "' AND `verify`='" . $verification_code . "'");
$verifynum = $verifyrs->num_rows;

if ($verifynum == 1) {

  Database::iud("INSERT INTO `advisor_payment` (`student_email`,`advisor_id`,`pay_date`,`status`)
      VALUES ('" . $studentemail . "','" . $advisorid . "','" . $date . "','1')");

  if ($charge) {
    header("Location:success.php?amount=$amount");
  }

} else {

  header("Location:cancel.php?amount=$amount");

}

?>
