<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"]) && isset($_SESSION["buy"])) {
  $rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $_SESSION["buy"]["id"] . "' ");
  $rsn = $rs->num_rows;
  if ($rsn == 1) {
    $data = $rs->fetch_assoc();
?>
    <!DOCTYPE html>
    <html>

    <head>


      <title>The Mobile sHop | Check Out</title>
      <link rel="icon" href="resources/Logo.png" />
      <link rel="stylesheet" href="checkout.css">

      <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
      <link rel="stylesheet" href="bootstrap.css">
      <script src="https://js.stripe.com/v3/"></script>
      <script src="script.js"></script>
    </head>

    <body class="d-flex align-items-center" style="background-color: #242D60;">
      <div class="container-fluid  my-auto">
        <div class="row">
          <section class="col-lg-6 col-10 offset-1 offset-lg-3">
            <div class="product row">
              <div class="col-4">
                <?php
                $result = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $data["id"] . "' ");
                $count = $result->num_rows;
                if ($count != 0) {
                  $pic = $result->fetch_assoc();
                ?>
                  <img class="img-fluid" src="<?php echo $pic["code"]; ?>" alt="The cover of Stubborn Attachments" />
                <?php
                } else {
                ?>
                  <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" />
                <?php
                }
                ?>

              </div>
              <div class="description col-7 offset-1">
                <h3 style="margin-bottom: 7px;"> Product : <span><?php echo $data["title"]; ?></span></h3>
                <h3 style="margin-bottom: 7px;"> price : <span> Rs <?php echo $data["price"]; ?>.00</span></h3>
                <h5 style="margin-bottom: 7px;">Quantity : <span><?php echo $_SESSION["buy"]["qty"]; ?></span></h5>
                <h5 style="margin-bottom: 7px;">Shipping : <span><?php echo $_SESSION["buy"]["shipping"]; ?></span></h5>
                <h5>Total Payment: <span style="color: red;">Rs <?php echo ($data["price"] * $_SESSION["buy"]["qty"]) + $_SESSION["buy"]["shipping"];  ?>.00</span></h5>
              </div>

            </div>
            <form class="pb-2" action="create-checkout-session.php" method="POST">
              <button class="fs-4 rounded">Checkout</button>
            </form>
          </section>
        </div>

      </div>
    </body>

    </html>
  <?php
  } else {
  ?>
    <script>
      alert("Error Has Occured Redirecting Back to Home Page");
      window.location = "home.php";
    </script>
  <?php
  }
} else {
  ?>
  <script>
    alert("Erroe");
    window.location = "home.php";
  </script>
<?php
}

?>