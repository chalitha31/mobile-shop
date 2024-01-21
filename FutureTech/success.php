<?php
session_start();
require "connection.php";
include 'stripe-php-master/init.php';
if (isset($_GET["payment_id"]) && isset($_SESSION["u"]) && isset($_SESSION["buy"]) && isset($_GET["req_id"])) {
  $session_id = $_GET["payment_id"];
  $request_id = $_GET["req_id"];
  $stripe = new \Stripe\StripeClient(
    'your_api_key'
  );
  $paymentDetails = $stripe->checkout->sessions->retrieve($session_id);
  $intent = $paymentDetails["payment_intent"];
  $stripe_id = $paymentDetails["id"];

  $result = Database::search("SELECT * FROM `invoice` WHERE `stripe_id` = '" . $stripe_id . "' OR `payment_intent_id` = '" . $intent . "' OR `payment_request_id` = '" . $request_id . "' ");
  $result_num = $result->num_rows;
  if ($result_num == 0) {
    $order_id = uniqid();





    $rs =   Database::search("SELECT * FROM `product`  WHERE `id` = '" . $_SESSION["buy"]["id"] . "' ");
    $data = $rs->fetch_assoc();
    $total = $data["price"] * $_SESSION["buy"]["qty"] + $_SESSION["buy"]["shipping"];


    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("y-m-d H:i:s");

    $totalqty = $data["qty"];
    $Remaining_quantity = $totalqty - $_SESSION["buy"]["qty"];


    Database::iud("INSERT INTO `invoice` (`order_id`,`product_id`,`user_email`,`date`,`total`,`qty`,`status`,`stripe_id`,`payment_intent_id`,`payment_request_id`) 
     VALUES('" . $order_id . "','" . $_SESSION["buy"]["id"] . "','" . $_SESSION["u"]["email"] . "','" . $date . "','" . $total . "','" . $_SESSION["buy"]["qty"] . "','0','" . $stripe_id . "','" . $intent . "','" . $request_id . "') ");


    Database::iud("UPDATE `product` SET `qty`='" . $Remaining_quantity . "' WHERE  `id`='" . $_SESSION["buy"]["id"] . "'");

?>

    <!DOCTYPE html>
    <html>

    <head>
      <title>Thanks for your order!</title>
      <link rel="icon" href="resources/Logo.png" />

      <link rel="stylesheet" href="bootstrap.css">
      <link rel="stylesheet" href="checkout.css">
    </head>

    <body style="background-color: #242D60;" class="d-flex align-items-center justify-content-center">
      <section class="pt-3">
        <p>
          Transaction Is Success. Thank you For Using Our service. If you have any enquires Send Them TO &nbsp; <br />
          <a href="mailto:orders@example.com">theMobileShop@gmail.com </a>.
        </p>
        <button onclick="directToInvoice('<?php echo $order_id ?>');" style="height:50px ; padding: 10px;">Click Here To View Recipt</button>
      </section>
    </body>
    <script src="script.js"></script>

    </html>
  <?php
  } else {
  ?>
    <script>
      window.location = "home.php";
    </script>
<?php
  }
}
