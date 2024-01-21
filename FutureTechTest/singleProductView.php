<?php

require "connection.php";
if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    $cartval = $_GET["cartval"];


    $productrs = Database::search("SELECT product.id,product.category,product.model_has_brand_id,product.colour_id,
   product.price,product.qty,product.description,product.title,product.condition_id,product.status_id,product.user_email,
   product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
   model.name AS `mname`,brand.name AS `bname` FROM product INNER JOIN model_has_brand ON model_has_brand.id = product.model_has_brand_id
    INNER JOIN brand ON brand.id = model_has_brand.brand_id INNER JOIN model ON model.id = model_has_brand.model_id WHERE product.id = '" . $pid . "'");

    $pn = $productrs->num_rows;

    if ($pn == 1) {
        $pd = $productrs->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>The Mobile sHop | Single Product View</title>
            <link rel="icon" href="resources/Logo.png" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        </head>

        <body style="overflow-x: hidden;">
            <div class="container-fluid">

                <div class="row">
                    <?php
                    require "Heder.php";
                    ?>
                    <hr class="hr-beak-1 mb-5" />

                    <div class="col-12 mt-3 singlproduct">

                        <!-- <h1>Single Product View</h1> -->

                        <div class="row">
                            <div class="bg-white" style="padding:11px;">
                                <div class="row">
                                    <div class="col-lg-2 order-lg-1 order-2">

                                        <ul>
                                            <?php

                                            $title = $pd["title"];
                                            $imagers = Database::search("SELECT * FROM images INNER JOIN product ON product.id=images.product_id WHERE product.title = '" . $title . "' ");

                                            $in = $imagers->num_rows;
                                            $img;
                                            if (!empty($in)) {
                                                for ($x = 0; $x < $in; $x++) {
                                                    $d = $imagers->fetch_assoc();
                                                    if ($x == 0) {
                                                        $img = $d["code"];
                                                    }
                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $d["code"]; ?>" height="150px" id="pimg<?php echo $x; ?>" onclick="loadmainimg('<?php echo $x; ?>')" class="mt-1 mb-1 me-2" />
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1 ">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1" />
                                                </li>

                                            <?php
                                            }

                                            ?>
                                        </ul>


                                    </div>
                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="align-items-center border border-1 border-secondary">

                                            <div style="background-image: url('<?php echo $img ?>'); background-repeat: no-repeat; background-size: contain; height: 480px;" id="mainimg">
                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <nav style="--bs-breadcrumb-divider: '>';">
                                                    <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                        <li class="breadcrumb-item">
                                                            <a href="home.php">Home</a>
                                                        </li>
                                                        <li class="breadcrumb-item">
                                                            <a href="#" class="text-decoration-none text-black-50 fw-bold">Single Product View</a>
                                                        </li>
                                                    </ol>
                                                </nav>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"] ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    <span class="badge">
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star-half mt-1 text-warning fs-6"></i>
                                                        <label class=" ms-2 text-dark fs-6">4.5 stras</label>
                                                        <label class="text-dark fs-6">35 | 35 Ratings & Reviews</label>
                                                    </span>
                                                </div>

                                                <div class="col-12 d-inline-block">
                                                    <label class="fw-bold fs-4 mt-1">Rs. <?php echo $pd["price"]; ?>.00 </label>&nbsp;&nbsp;&nbsp;
                                                    <span class="d-none" id="unitprice<?php echo $pid ?>"> <?php echo $pd["price"]; ?></span>
                                                    <label class="fw-bold fs-6 mt-1 text-danger"><del>Rs
                                                            <?php
                                                            $p = $pd["price"];
                                                            $n = ($p / 100) * 5;
                                                            $newval = $n + $p;
                                                            echo $newval;
                                                            ?>
                                                            .00</del></label>
                                                </div>

                                                <hr class="hr-beak-1">
                                                <div class="col-12">
                                                    <label class="text-primary fs-6 fw-bold">Warrenty : 06 Months Warrenty </label><br />
                                                    <label class="text-primary fs-6"><b>Return Policy :</b> 06 Month return Policy </label><br />
                                                    <label class="text-primary fs-6"><b class="text-success">In Stock :</b> <?php echo $pd["qty"]; ?> Items Left </label>
                                                </div>

                                                <hr class="hr-beak-1">

                                                <!-- <div class="col-12">
                                                    <?php

                                                    $userrs = Database::search("SELECT * FROM user WHERE `email` ='" . $pd["user_email"] . "' ");
                                                    $userd = $userrs->fetch_assoc();

                                                    ?>
                                                    <label class="text-dark fs-3 fw-bold mb-3">Seller's Details</label><br />
                                                    <label class="text-success fs-6 fw-bold ">Seller's name: <?php echo  $userd["fname"] . " " . $userd["lname"]; ?></label><br />
                                                    <label class="text-success fs-6 fw-bold ">Seller's Email : <?php echo $userd["email"]; ?></label><br />
                                                    <label class="text-success fs-6 fw-bold ">Seller's Mobile : <?php echo  $userd["mobile"] ?></label>
                                                </div> -->

                                                <hr class="hr-beak-1">

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-8 rounded border border-primary mt-1 pt-2">
                                                            <div class="row">
                                                                <div class="col-md-3 col-sm-3 col-lg-1">
                                                                    <img src="resources/pricetag.png" height="70%">
                                                                </div>
                                                                <div class="col-md-9 col-sm-9 mt-1 pe-4 col-lg-11">
                                                                    <label class="mt-2">Stand a chance to get instant 5% discount by using VISA</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-6" style="margin-top: 15px;">

                                                            <div class="row">
                                                                <div class="border border-1 border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                    <div class="col-12">
                                                                        <span>Qty : </span>

                                                                        <?php
                                                                        // echo $cartval;
                                                                        $cartt = Database::search("SELECT * FROM `cart` WHERE `product_id` ='" . $pd["id"] . "' ");
                                                                        $cartdi = $cartt->fetch_assoc();

                                                                        // if ($cartval == 0) {
                                                                        // 
                                                                        ?>
                                                                        <!-- <input id="qtyinput<?php echo $pid ?>" type="number" style="outline:none;" class="border-0 fs-6 fw-bold text-start qty Tqty" min="0" value="1" onkeyup='check_val(<?php echo $pd["qty"] ?>,<?php echo $pid; ?>)' /> -->
                                                                        <!-- <?php
                                                                                // } else {
                                                                                ?> -->
                                                                        <!-- <input id="qtyinput<?php echo $pid ?>" type="number" style="outline:none;" class="border-0 fs-6 fw-bold text-start qty Tqty" min="0" value="<?php echo $cartdi["qty"] ?>" onkeyup='check_val(<?php echo $pd["qty"] ?>,<?php echo $pid; ?>)' /> -->
                                                                        <input id="qtyinput" type="number" style="outline:none;" class="border-0 fs-6 fw-bold text-start qty Tqty" min="0" value="1" />
                                                                        <!-- <?php
                                                                                // }

                                                                                ?> -->


                                                                        <div class="position-absolute qty_buttons">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_inc">
                                                                                <i class="fas fa-chevron-up" onclick='qty_inc(<?php echo $pd["qty"] ?>,<?php echo $pid; ?>)'></i>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_dec">
                                                                                <i class="fas fa-chevron-down" onclick="qty_dec(<?php echo $pid; ?>);"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 mt-3">
                                                                    <div class="row">
                                                                        <div class="col-4 col-lg-5 d-grid">
                                                                            <button onclick="addToCart(<?php echo $product['id']; ?>);" class="btn btn-primary"> Add to Cart</button>
                                                                        </div>
                                                                        <div class="col-4 col-lg-5 d-grid">
                                                                            <!-- <button onclick="buynow('<?php echo $pid ?>')" class="btn btn-success"> Buy Now</button> -->
                                                                            <button class="btn btn-success"> Buy Now</button>
                                                                        </div>
                                                                        <div class="col-4 col-lg-2 d-grid">

                                                                            <button class="btn btn-secondary">
                                                                                <i class="fas fa-heart fs-4 mt-1 text-danger" id="heart<?php echo $pid; ?>"></i>
                                                                            </button>



                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row d-block me-0 mt-4 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                        <div class="col-md-6">
                                            <span class="fs-3 fw-bold">
                                                Related Items
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="col-md-12">
                                        <div class="row p-2" style="text-align: justify;">
                                            <?php

                                            $prod = Database::search("SELECT * FROM `product` WHERE `model_has_brand_id`='" . $pd["model_has_brand_id"] . "' AND `id`!='" . $pd["id"] . "'  LIMIT 4  ");
                                            $dbs = $prod->num_rows;
                                            for ($y = 0; $y < $dbs; $y++) {
                                                $pdf = $prod->fetch_assoc();

                                            ?>
                                                <div class="card me-1" style="width: 18rem;">
                                                    <?php

                                                    $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pdf["id"] . "' ");
                                                    $pimgf = $pimgrs->fetch_assoc();

                                                    ?>
                                                    <img src="<?php echo $pimgf["code"]; ?>" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo $pdf["title"]; ?></h5>
                                                        <p class="card-text">Rs.<?php echo $pdf["price"]; ?></p>
                                                        <a href="#" class="btn btn-primary fsm2">Add cart</a>
                                                        <a href="#" class="btn btn-primary fsm2">Buy Now</a>
                                                        <a href="#" class="mt-2 fs-6 ms-2"><i class="fas fa-heart mt-1 fs-4 text-black-50"></i></a>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            ?>


                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row d-block me-0 mt-4 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                        <div class="col-md-6">
                                            <span class="fs-3 fw-bold">
                                                Product Details
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2 bg-white">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2">
                                                    <label class="form-label fw-bold">Brand</label>
                                                </div>
                                                <div class="col-10">
                                                    <label class="form-label"><?php echo $pd["bname"] ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <label class="form-label fw-bold">Model</label>
                                                </div>
                                                <div class="col-10">
                                                    <label class="form-label"><?php echo $pd["mname"] ?> </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <label class="form-label fw-bold">Description</label>
                                                </div>
                                                <div class="col-10">
                                                    <textarea cols="60" class="form-label" rows="10" disabled><?php echo $pd["description"]; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row d-block me-0 mt-4 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                        <div class="col-md-6">
                                            <span class="fs-3 fw-bold">
                                                Feedbacks...
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex ">
                                    <div class="col-12">
                                        <div class="row ">

                                            <?php

                                            $result = Database::search("SELECT * FROM `feedback`   WHERE `product_id` = '" . $pid . "'  ");
                                            $result_num = $result->num_rows;
                                            if ($result_num >= 1) {
                                                for ($i = 0; $i < $result_num; $i++) {
                                                    $feedData = $result->fetch_assoc();
                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $feedData["user_email"] . "' ");
                                                    $user_data = $user_rs->fetch_assoc();
                                            ?>
                                                    <div class="col-6 mt-3 col-lg-3 px-4">
                                                        <div class="row">
                                                            <div class="col-12 border border-2 border-danger rounded rounded-3 p-2">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <span class="d-inline-block text-primary fw-bold fs-6"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?> </span>
                                                                    </div>
                                                                    <div class="col-6 text-end">
                                                                        <span style="color:rgb(237, 205, 21);">
                                                                            <?php

                                                                            for ($m = 1; $m < 6; $m++) {
                                                                                if ($m <= $feedData["star"]) {
                                                                            ?>
                                                                                    <i class="bi bi-star-fill"></i>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <i class="bi bi-star-fill" style="color: gray;"></i>
                                                                            <?php
                                                                                }
                                                                            }


                                                                            ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="d-block text-dark " style="font-weight: 700;"><?php echo $feedData["feed"] ?></span>
                                                                    </div>
                                                                    <div class="col-12 text-end">
                                                                        <span><?php echo $feedData["date"] ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="col-12 text-center pt-4">
                                                    <span class="fs-3">No FeedBacks For This Product</span>
                                                </div>
                                            <?php
                                            }
                                            ?>


                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>

                    </div>

                    <?php
                    require "foo.php";

                    ?>
                </div>
            </div>


            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="script.js"></script>
        </body>

        </html>

<?php
    }
} else {
}

?>