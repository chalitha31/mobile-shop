<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"]) && isset($_SESSION["buy"])) {
    // print_r($_SESSION["buy"]["id"]);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop |</title>

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
                    <?php
                    for ($y = 0; $y <  $_SESSION["num"]; $y++) {

                        $rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $_SESSION["buy"]["id" . $y] . "' ");
                        $rsn = $rs->num_rows;
                        if ($rsn == 1) {
                            $data = $rs->fetch_assoc();

                    ?>

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
                                    <h5 style="margin-bottom: 7px;">Quantity : <span><?php echo $_SESSION["buy"]["qty" . $y]; ?></span></h5>
                                    <!-- <h5 style="margin-bottom: 7px;">Shipping : <span><?php echo $_SESSION["buy"]["shipping"]; ?></span></h5> -->
                                    <h5>Total Payment: <span style="color: red;">Rs <?php echo ($data["price"] * $_SESSION["buy"]["qty" . $y])  ?>.00</span></h5>
                                </div>

                            </div>



                        <?php
                        } ?>
                        <hr>
                    <?php
                    }

                    $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                    $cartnum = $cartrs->num_rows;

                    $total  = "0";
                    $subtotal = "0";
                    $shipping  = "0";
                    $tship = "0";

                    $_SESSION["ship"] = $tship;
                    $_SESSION["total"] = $total;

                    for ($x = 0; $x < $cartnum; $x++) {
                        $cartrow = $cartrs->fetch_assoc();



                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cartrow["product_id"] . "' ");
                        $productrow = $productrs->fetch_assoc();

                        $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $productrow["user_email"] . "'");
                        $userrow = $userrs->fetch_assoc();

                        $condition = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $productrow["condition_id"] . "' ");
                        $cname = $condition->fetch_assoc();

                        $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $productrow["id"] . "'");
                        $img = $pimage->fetch_assoc();

                        $total = $total + ($productrow["price"] * $cartrow["qty"]);


                        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
                        $ar = $addressrs->fetch_assoc();
                        $cityid = $ar["city_id"];

                        $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "'");
                        $xr = $districtrs->fetch_assoc();
                        $districtid = $xr["district_id"];



                        // if ($districtid == 9) {
                        //     $ship = $productrow["delivery_fee_colombo"];
                        //     $shipping = $ship + $productrow["delivery_fee_colombo"];

                        // } else {
                        //     $ship = $productrow["delivery_fee_other"];
                        //     $shipping = $ship + $productrow["delivery_fee_other"];

                        // }


                        if ($districtid == 9) {
                            $ship = $productrow["delivery_fee_colombo"];
                            // $tship += $ship;
                            $tship = $ship;
                            $shipping = $tship;
                        } else {
                            $ship = $productrow["delivery_fee_other"];
                            // $tship += $ship;
                            $tship = $ship;
                            $shipping = $tship;
                        }
                    }

                    ?>

                    <div class="col-12 offset-lg-3 col-lg-6 d-flex justify-content-center">
                        <div class="row">

                            <div class="col-12">
                                <label class="form-label fs-3 fw-bold">Summary</label>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-6 mb-1">
                                <span class="fs-6 fw-bold">Items(<?php echo $cartnum; ?>)</span>
                            </div>

                            <div class="col-6 text-end">
                                <span class="fs-6 fw-bold">Rs.<?php echo $total ?>.00</span>
                            </div>

                            <div class="col-6">
                                <span class="fs-6 fw-bold">Shipping</span>
                            </div>

                            <div class="col-6 text-end">
                                <span class="fs-6 fw-bold">Rs.<?php echo $shipping ?>.00</span>
                            </div>

                            <div class="col-12 mt-3">
                                <hr />
                            </div>

                            <div class="col-6 mt-2">
                                <span class="fs-4 fw-bold">Total</span>
                            </div>

                            <div class="col-6 mt-2 text-end">
                                <span class="fs-4 fw-bold">Rs.<?php echo $total + $shipping; ?>.00</span>
                            </div>
                            <hr />
                            <hr />


                        </div>
                    </div>

                    <form class="pb-2 mt-4" action="create-Cartcheckout-session.php" method="POST">
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
        alert("Erroe");
        window.location = "home.php";
    </script>
<?php
}

?>