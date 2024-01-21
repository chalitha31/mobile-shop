<?php
require "connection.php";


$size = $_POST["Ssize"];

if ($size < 1000) {
?>

    <?php

    $rs = Database::search("SELECT * FROM `category`");
    $n = $rs->num_rows;

    for ($x = 0; $x < $n; $x++) {
        $cat = $rs->fetch_assoc();

    ?>

        <!-- category name -->

        <div class="col-12">
            <a href="#" class="link-dark link2"><?php echo $cat["name"]; ?></a>&nbsp;&nbsp;
            <a href="#" class="link-dark link3">See All&nbsp; &rarr;</a>
        </div>

        <!-- category name -->

        <?php

        $resultset = Database::search("SELECT * FROM `product` WHERE `category` = '" . $cat["id"] . "' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");
        $norows = $resultset->num_rows;

        ?>

        <!-- products -->

        <div class="col-12 mb-3">

            <div class="row border border-primary">

                <div class="col-12 col-lg-12">

                    <div class="row justify-content-center gap-3">

                        <?php

                        for ($y = 0; $y < $norows; $y++) {
                            $product = $resultset->fetch_assoc();

                        ?>

                            <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

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

    <?php

    }

    ?>

    <!-- products -->

    </div>

<?php

} else {
?>


    <?php

    $rs = Database::search("SELECT * FROM `category`");
    $n = $rs->num_rows;

    for ($x = 0; $x < $n; $x++) {
        $cat = $rs->fetch_assoc();

    ?>

        <!-- category name -->

        <div class="col-12">
            <a href="#" class="link-dark link2"><?php echo $cat["name"]; ?></a>&nbsp;&nbsp;
            <a href="#" class="link-dark link3">See All&nbsp; &rarr;</a>
        </div>
        <!-- category name -->

        <?php

        $resultset = Database::search("SELECT * FROM `product` WHERE `category` = '" . $cat["id"] . "' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");
        $norows = $resultset->num_rows;

        ?>

        <!-- products -->

        <div class="col-12 mb-3">

            <div class="row border border-primary">

                <div class="col-12 col-lg-12">

                    <div class="row justify-content-center gap-3">



                        <?php

                        for ($y = 0; $y < $norows; $y++) {
                            $product = $resultset->fetch_assoc();

                        ?>

                            <div class="col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                                <?php

                                $pimage = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product["id"] . "' ");
                                $img = $pimage->fetch_assoc();

                                ?>

                                <!-- <img src="<?php echo $img["code"] ?>" class="card-img-top"> -->

                                <!-- cartbox -->




                                <div class="flip-box">
                                    <div class="flip-box-inner">
                                        <div class="flip-box-front">
                                            <img src="<?php echo $img["code"] ?>" class="card-img-top">

                                            <div class="mt-3">
                                                <h5 class="card-title">
                                                    <?php echo $product["title"]; ?> <span class="badge bg-danger">new</span>
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

                                                    <div class="mt-2 mobileSp">

                                                        <?php

                                                        if (isset($_SESSION["u"])) {

                                                        ?>

                                                            <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class=" btn btn-success col-12">Buy Now</a>

                                                        <?php

                                                        } else {
                                                        ?>

                                                            <a onclick="buy();" class=" btn btn-success col-12">Buy Now</a>

                                                        <?php

                                                        }

                                                        ?>

                                                        <a href="#" class="btn btn-danger col-12">Add to Cart</a>
                                                        <a href="#" class="btn btn-danger col-12 mt-1"><i class="bi bi-heart-half"></i></a>

                                                    </div>

                                                <?php

                                                } else {

                                                ?>

                                                    <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-danger fw-bold">0 Items Avaialable</span>

                                                    <div class="mt-3 mobileSp">
                                                        <a href="#" class=" btn btn-success col-12 disabled">Buy Now</a>
                                                        <a href="#" class="btn btn-danger col-12  disabled">Add to Cart</a>
                                                    </div>

                                                <?php

                                                }

                                                ?>

                                            </div>
                                        </div>

                                        <div class="flip-box-back">

                                            <img src="<?php echo $img["code"] ?>" class="homebackimg">

                                            <!-- l -->

                                            <div class="card-body ms-0 m-0 c">
                                                <h5 class="card-title">
                                                    <?php echo $product["title"]; ?> <span class="badge bg-info">new</span>
                                                </h5>
                                                <span class="card-text text-black fw-bold">Rs :-
                                                    <?php echo $product["price"]; ?>.00
                                                </span>
                                                <br />

                                                <?php

                                                if ($product["qty"] > 0) {

                                                ?>

                                                    <span class="card-text text-warning"><b>in Stock</b></span>
                                                    <br />
                                                    <span class="card-text text-light fw-bold">
                                                        <?php echo $product["qty"]; ?> &nbsp;items Avaialable
                                                    </span>

                                                    <?php

                                                    if (isset($_SESSION["u"])) {

                                                    ?>

                                                        <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class=" btn btn-success col-12">Buy Now</a>

                                                    <?php

                                                    } else {
                                                    ?>

                                                        <a onclick="buy();" class=" btn btn-success col-12">Buy Now</a>

                                                    <?php

                                                    }

                                                    ?>


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

                                                    <a onclick="Watchlist();" class="btn btn-secondary col-12 mt-1 "><i class="bi bi-heart-half fs-5"></i></a>

                                                <?php
                                                }

                                                ?>



                                            </div>

                                        </div>
                                    </div>
                                </div>





                                <!-- cartbox -->

                            </div>

                        <?php
                        }

                        ?>

                    </div>

                </div>

            </div>
        </div>

    <?php

    }

    ?>

    <!-- products -->

<?php
}
?>

<!-- products -->