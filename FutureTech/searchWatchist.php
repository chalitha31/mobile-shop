<?php
session_start();
require "connection.php";
$user = $_SESSION["u"]["email"];
$word = $_GET["word"];

if (!empty($user)) {
    $rs = Database::search("SELECT `watchlist`.`id`,`product`.`title`,`product`.`user_email`,`watchlist`.`product_id`,`product`.`colour_id`,`product`.`condition_id`,`product`.`price` FROM `watchlist` JOIN `product` ON `watchlist`.`product_id` = `product`.`id` WHERE `watchlist`.`user_email` =  '" . $user . "' AND `title` LIKE '%" . $word . "%' ");
    $rsn = $rs->num_rows;
    if ($rsn != 0) {
        for ($i = 0; $i < $rsn; $i++) {
            $pf = $rs->fetch_assoc();
            $prod_id = $pf["product_id"];
            $watch_id = $pf["id"];
?>
            <div class="card mb-3 mx-0 mx-lg-2  col-12">
                <div class="row g-0">
                    <div class="col-md-4">
                        <?php

                        $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`= '" . $prod_id . "' ");
                        $img = $pimage->fetch_assoc();

                        ?>
                        <img src="<?php echo $img["code"] ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $pf["title"] ?></h5>
                            <?php

                            $clr = Database::search("SELECT * FROM `colour` WHERE `id`='" . $pf["colour_id"] . "' ");
                            $clrrs = $clr->fetch_assoc();
                            $condition = Database::search("SELECT * FROM `condition` WHERE `id` ='" . $pf["condition_id"] . "' ");
                            $conditionrs = $condition->fetch_assoc();
                            $usr = Database::search("SELECT * FROM `user` WHERE `email`='" . $pf["user_email"] . "' ");
                            $usrrs = $usr->fetch_assoc();
                            ?>

                            <span class="fw-bold text-black-50">Color : <?php echo $clrrs["name"]; ?></span>&nbsp;

                            <br />
                            &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $conditionrs["name"] ?></span>

                            <br />
                            <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                            <span class="fw-bold text-black-50 fs-5">Rs.<?php echo $pf["price"] ?>.00</span>
                            <br />
                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                            <br />
                            <span class="fw-bold text-black-50 fs-5"><?php echo $usrrs["fname"] . " " . $usrrs["lname"]; ?></span>&nbsp;
                            <br />
                            <span class="fw-bold text-black-50 fs-5"><?php echo $usrrs["email"]; ?></span>&nbsp;


                        </div>
                    </div>
                    <div class="col-md-3 mt-4">
                        <div class="card-body d-grid">
                            <a href="#" class="btn btn-outline-success mb-2">Buy now</a>
                            <a href="#" class="btn btn-outline-warning mb-2">Add Cart</a>
                            <a href="#" class="btn btn-outline-danger mb-2" onclick="deletewatchlist('<?php echo $watch_id ?>');">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <!-- no items -->
        <div class="">
            <div class="row">
                <div class="col-12 emptyview "></div>
                <div class="col-12 text-center">
                    <label class="form-label fs-1 fw-bolder mb-3">We couldn't find any products in this name.</label>
                </div>
            </div>
        </div>

        <!-- no items -->
<?php
    }
}


?>