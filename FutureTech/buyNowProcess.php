<?php
session_start();
require "connection.php";
$pid = $_POST["pid"];
$qty = $_POST["pqty"];
 $uemail = $_SESSION["u"]["email"];

$rs = Database::search("SELECT * FROM `product` WHERE `id` = '".$pid."' ");
$data = $rs->fetch_assoc();

$order_id = uniqid();
$uprice = $data["price"];
$total = $uprice * $qty;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("y-m-d H:i:s");

$orderDate = $d->format("y-m-d H:i:s");

Database::search(" INSERT INTO `invoice` (`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`,`status`) VALUES('".$order_id."','".$pid."','".$uemail."','".$date."','".$total."','".$qty."','0') ");
echo $order_id;
