<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {
    $id = $_GET["id"];
    $count = $_GET["count"];
    $feed = $_GET["feed"];
    $inid = $_GET["inid"];
    if ($count == 0) {
        echo "Please Select a Rate Star Count";
    } else if ($count > 5 || $count < 1) {
        echo "PLease Enter A valid Star Count";
    } else if (empty($feed)) {
        echo "Please Enter A FeedBack Descirption";
    } else {
        $rs = Database::search("SELECT *  FROM `product`  WHERE `id` = '" . $id . "' ");
        $rsn = $rs->num_rows;
        if ($rsn == 1) {
           $result =  Database::search("SELECT * FROM `feedback` WHERE `invoice_id` = '".$inid."'  ");
           $result_num = $result->num_rows;
           if($result_num == 0){
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("y-m-d H:i:s");
            Database::iud("INSERT INTO `feedback`(`user_email`,`product_id`,`feed`,`date`,`star`,`invoice_id`) VALUES('" . $_SESSION["u"]["email"] . "','" . $id . "','" . $feed . "','".$date."','".$count."','".$inid."') ");
            echo "success";
           }else{
            echo "You Can Add Only One FeedBack Per Purchase";
           }
           
        } else {
            echo "An Error Occured Please Try Refreshing You Browser";
        }
    }
}
