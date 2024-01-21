<?php
// session_start();
require "connection.php";
require "Heder.php";
if (isset($_SESSION["u"])) {
    $mail = $_SESSION["u"]["email"];

    $rs2 = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $mail . "' ");
    $rsn2 = $rs2->num_rows;

    if ($rsn2 != 1) {

        echo "<script>alert('Please Update Your Addess In Profile'); window.location.href='http://localhost/FutureTech/userprofile.php';</script>";
    } else {

?>

        <!DOCTYPE html>
        <html>

        <head>
            <title>The Mobile sHop | Cart</title>
            <link rel="icon" href="resources/Logo.png" />

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1" />


            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
            <link type="text/css" rel="stylesheet" href="magicscroll/magicscroll.css" />

            <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php




                    $total = "0";
                    $subtotal = "0";
                    $shipping = "0";
                    $tship = "0";



                    ?>

                    <div class="col-12 pt-2" style="background-color: #E3E5E4;">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="http://localhost/FutureTech/home.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>

                    </div>

                    <div class="col-12 border border-1 border-secondary rounded mb-3">
                        <div class="row">

                            <div class="col-12">
                                <label class="form-label fw-bold fs-1">Basket <i class="bi bi-cart3 fs-2"></i></label>
                            </div>

                            <div class="col-12 col-lg-6">
                                <hr class="hr-break-1" />
                            </div>

                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-12 col-lg-6 offset-0 offset-lg-2 mb-3">
                                        <input type="text" class="form-control" placeholder="Search in Basket..." />
                                    </div>
                                    <div class="col-12 col-lg-2 d-grid mb-3">
                                        <button class="btn btn-outline-primary">Search</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="hr-break-1" />
                            </div>

                            <?php

                            $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $mail . "'");
                            $cartnum = $cartrs->num_rows;

                            if ($cartnum == 0) {

                            ?>

                                <!-- empty -->

                                <div class="col-12" style="background-color: #C4C4C4">
                                    <div class="row">
                                        <div class="col-12 emptycart"></div>
                                        <div class="col-12 text-center mb-2">
                                            <label class="form-label fs-1 fw-bold">Yo have no Items in your basket.</label>
                                        </div>
                                        <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                            <a href="http://localhost/FutureTech/home.php" class="btn btn-primary fs-3">Start Shopping</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- empty -->








                                <?php

                                $resultset = Database::search("SELECT * FROM `product` WHERE `blocked` = '0' AND `status_id` = '1'   ORDER BY `datetime_added` DESC LIMIT 5 OFFSET 0");
                                $norows = $resultset->num_rows;

                                ?>

                                <!-- products -->

                                <div class="col-12 mb-3 mt-3">

                                    <div class="row border  ">

                                        <div class="col-12 col-lg-12">

                                            <div class="row justify-content-center gap-3 flex-nowrap carousel slide">

                                                <?php

                                                for ($y = 0; $y < $norows; $y++) {
                                                    $product = $resultset->fetch_assoc();

                                                ?>

                                                    <div class="card col-6 col-lg-2 mt-2 mb-2 " style="width: 18rem;">

                                                        <?php

                                                        $pimage = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product["id"] . "' ");
                                                        $img = $pimage->fetch_assoc();

                                                        ?>

                                                        <img src="<?php echo $img["code"] ?>" class="card-img-top">
                                                        <div class="card-body ms-0 m-0">
                                                            <h5 class="card-title">
                                                                <?php echo $product["title"]; ?> <span class="badge bg-info">new</span>
                                                            </h5>
                                                            <span class="card-text text-primary">Rs :-
                                                                <?php echo $product["price"]; ?>.00
                                                            </span>
                                                            <br />

                                                            <?php

                                                            if ($product["qty"] > 0) {

                                                            ?>

                                                                <span class="card-text text-warning"><b>in Stock</b></span>
                                                                <br />
                                                                <span class="card-text text-success fw-bold">
                                                                    <?php echo $product["qty"]; ?> &nbsp;items Avaialable
                                                                </span>

                                                                <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class=" btn btn-success col-12">Buy Now</a>
                                                                <a class="btn btn-danger col-12 mt-1" onclick="addToCart(<?php echo $product['id']; ?>);">Add to Cart</a>
                                                            <?php

                                                            } else {

                                                            ?>

                                                                <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                                <br />
                                                                <span class="card-text text-danger fw-bold">0 Items Avaialable</span>
                                                                <br />
                                                                <a href="#" class=" btn btn-success col-12 disabled">Buy Now</a>
                                                                <a href="#" class="btn btn-danger col-12 mt-1 disabled">Add to Cart</a>

                                                                <?php

                                                            }

                                                            if (isset($_SESSION["u"])) {

                                                                $watchers = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $product["id"] . "' AND `user_email` = '" . $_SESSION["u"]["email"] . "'");

                                                                if ($watchers->num_rows == 1) {

                                                                ?>

                                                                    <a onclick='addToWatchlist("<?php echo $product["id"]; ?>");' class="btn btn-secondary col-12 mt-1" style="background-color: #097fec;" id="heart<?php echo $product["id"]; ?>"><i class="bi bi-heart-half fs-5"></i></a>

                                                                <?php

                                                                } else {

                                                                ?>

                                                                    <a onclick='addToWatchlist("<?php echo $product["id"]; ?>");' class="btn btn-secondary col-12 mt-1" id="heart<?php echo $product["id"]; ?>"><i class="bi bi-heart-half fs-5"></i></a>

                                                                <?php

                                                                }
                                                            } else {
                                                                ?>

                                                                <a onclick="Watchlist();" class="btn btn-secondary col-12 mt-1"><i class="bi bi-heart-half fs-5"></i></a>

                                                            <?php
                                                            }

                                                            ?>



                                                        </div>

                                                    </div>

                                                <?php
                                                }

                                                ?>

                                            </div>

                                        </div>

                                    </div>
                                </div>



                                <!-- products -->



                                <?php

                            } else {



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


                                    $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $mail . "' ");
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


                                ?>

                                    <!-- have products -->

                                    <div class="col-12 col-lg-9">
                                        <div class="row">

                                            <div class="card mb-3 mx-0 col-12">
                                                <div class="row g-0">
                                                    <!-- <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $userrow["fname"] . " " . $userrow["lname"]; ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div> -->

                                                    <hr>

                                                    <div class="col-md-4">



                                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $productrow["description"] ?>" title="Product Description">
                                                            <img src="<?php echo $img["code"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                        </span>

                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="card-body">

                                                            <h3 class="card-title"><?php echo $productrow["title"]; ?></h3>

                                                            <?php

                                                            $imagers = Database::search("SELECT * FROM `colour` WHERE `id` = '" . $productrow["colour_id"] . "'");
                                                            $colourrow = $imagers->fetch_assoc();

                                                            $brandrs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $productrow["condition_id"] . "'");
                                                            $brandrow = $brandrs->fetch_assoc();
                                                            ?>

                                                            <span class="fw-bold text-black-50">Colour : <?php echo $colourrow["name"]; ?></span> &nbsp; | &nbsp;

                                                            <span class="fw-bold text-black-50">Condition : <?php echo $cname["name"]; ?></span>
                                                            <br>
                                                            <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5">Rs : <?php echo $productrow["price"]; ?>.00</span>
                                                            <br>

                                                            <!-- <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" min="1" value="<?php echo $cartrow["qty"] ?>"> -->



                                                            <div class="col-12 mt-3">
                                                                <div class="row">


                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start position-relative product_qty">
                                                                        <div class="col-12">
                                                                            <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                                            <input id="qtyinput<?php echo $productrow["id"] ?>" type="number" style="outline:none;" class="border-0 fs-6 fw-bold text-start qty" min="0" value="<?php echo $cartrow["qty"] ?>" onkeyup='check_val(<?php echo $productrow["qty"] ?>,<?php echo $productrow["id"]; ?> ); TyaddToCart(<?php echo $productrow["id"]; ?> )' />
                                                                            <div class="position-absolute qty_buttons">
                                                                                <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_inc">
                                                                                    <i class="fas fa-chevron-up" onclick='qty_inc(<?php echo $productrow["qty"] ?>,<?php echo $productrow["id"]; ?>); dwnaddToCart(<?php echo $productrow["id"]; ?>)'></i>
                                                                                </div>
                                                                                <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                    <i class="fas fa-chevron-down" onclick='qty_dec(<?php echo $productrow["id"]; ?>); readdToCart(<?php echo $productrow["id"]; ?>)'></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <br><br>
                                                            <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5">Rs.<?php echo $ship; ?>.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="card-body d-grid">
                                                            <a href='<?php echo "singleProductView.php?id=" . ($productrow["id"]) . "&cartval=119" ?>' class="btn btn-outline-success mb-2">Buy Now</a>
                                                            <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cartrow['id']; ?>);">Remove</a>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="col-md-12 mt-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-6 col-md-6">
                                                                <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                            </div>
                                                            <div class="col-6 col-md-6 text-end">
                                                                <span class="fw-bold fs-5 text-black-50">Rs.<?php echo ($productrow["price"] * $cartrow["qty"]) + $ship; ?>.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>




                                    <!-- have products -->


                                <?php

                                }


                                ?>

                                <div class="col-12 col-lg-3">
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

                                        <div class="col-12 mt-3 mb-3 d-grid">
                                            <!-- <form class="pb-2" action="create-checkout-session.php" method="POST"> -->
                                            <button onclick="checkOut();" class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                            <!-- </form> -->

                                        </div>

                                    </div>
                                </div>

                            <?php

                            }


                            ?>


                        </div>
                    </div>

                    <?php require "foo.php"; ?>

                </div>
            </div>

            <script src="script.js"></script>
            <script>
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl)
                })
            </script>

            <script type="text/javascript" src="magicscroll/magicscroll.js"></script>
            <script src="bootstrap.bundle.js"></script>
        </body>

        </html>
<?php
    }
} else {
    echo "<script>alert('Please Sign In first'); window.location.href='http://localhost/FutureTech/home.php';</script>";
}
?>