<?php
session_start();
require "connection.php";
$user = $_SESSION["u"]["email"];
$word = $_GET["word"];



if (!empty($user)) {

    $rs = Database::search("SELECT `cart`.`id`,`cart`.`qty`,`cart`.`user_email`,`cart`.`product_id`,`product`.`qty` AS `proqty` FROM `cart` JOIN `product` ON `cart`.`product_id` = `product`.`id` WHERE `cart`.`user_email` = '" . $user . "' AND `product`.`title` LIKE '%" . $word . "%' ");
    $rsn = $rs->num_rows;
    if ($rsn != 0) {
        for ($i = 0; $i < $rsn; $i++) {
            $cartrow = $rs->fetch_assoc();
            $mail = $_SESSION["u"]["email"];
            $total = "0";
            $subtotal = "0";
            $shipping = 0;
            $mine  = Database::search("SELECT *  FROM  `user_has_address` WHERE `user_email` = '" . $mail . "' ");
            $rb = $mine->num_rows;
?>
            <!-- have products -->
            <div class="col-12 ">
                <div class="row">
                    <div class="card mb-3 mx-0 col-12">
                        <div class="row g-0">
                            <div class="col-md-12 mt-3 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                        <?php
                                        $prod_details = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cartrow["product_id"] . "' ");
                                        $prod_row = $prod_details->fetch_assoc();
                                        $total = $total  + ($prod_row["price"] + $cartrow["qty"]);
                                        $usr = Database::search("SELECT * FROM `user` WHERE `email`='" . $prod_row["user_email"] . "' ");
                                        $usr_row = $usr->fetch_assoc();
                                        ?>
                                        <span class="fw-bold text-black fs-5"><?php echo $usr_row["fname"] . " " . $usr_row["lname"]; ?></span>&nbsp;
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-4">
                                <?php
                                $ship = 0;
                                $img = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $prod_row["id"] . "' ");
                                $imgrs = $img->fetch_assoc();

                                ?>
                                <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="Product Description" data-bs-content="<?php echo $prod_row["description"]; ?>">
                                    <img src="<?php echo $imgrs["code"] ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                </span>

                            </div>
                            <div class="col-md-5">
                                <div class="card-body">

                                    <h3 class="card-title"><?php echo $prod_row["title"] ?></h3>
                                    <?php
                                    $user_has_address  = Database::search("SELECT *  FROM  `user_has_address` WHERE `user_email` = '" . $mail . "' ");
                                    $user_has_address_row = $user_has_address->fetch_assoc();
                                    $city = Database::search("SELECT * FROM `city` WHERE `id` = '" . $user_has_address_row["city_id"] . "' ");
                                    $city_row = $city->fetch_assoc();
                                    $districtId = $city_row["district_id"];
                                    if ($districtId == 1) {
                                        $ship = $prod_row["delivery_fee_colombo"];
                                        $shipping = $ship + $prod_row["delivery_fee_colombo"];
                                    } else {
                                        $ship = $prod_row["delivery_fee_other"];
                                        $shipping = $ship + $prod_row["delivery_fee_other"];
                                    }
                                    $clr = Database::search("SELECT * FROM `colour` WHERE `id`='" . $prod_row["colour_id"] . "' ");
                                    $clrrs = $clr->fetch_assoc();
                                    $condition = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $prod_row["condition_id"] . "' ");
                                    $conditionrs = $condition->fetch_assoc();
                                    ?>
                                    <span class="fw-bold text-black-50">Colour : <?php echo $clrrs["name"]; ?></span> &nbsp; |

                                    &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo $conditionrs["name"] ?></span>
                                    <br>
                                    <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                    <span class="fw-bold text-black fs-5">Rs.<?php echo $prod_row["price"]; ?>.00</span>
                                    <br>
                                    <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                    <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo $cartrow["qty"]; ?>">
                                    <br><br>
                                    <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;

                                    <span class="fw-bold text-black fs-5">Rs.<?php echo $prod_row["delivery_fee_colombo"]; ?>.00</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card-body d-grid">
                                    <a class="btn btn-outline-success mb-2">Buy Now</a>
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
                                        <?php
                                        $itemtotal = $prod_row["qty"] * $prod_row["price"] + $prod_row["delivery_fee_colombo"];

                                        ?>
                                        <span class="fw-bold fs-5 text-black-50">Rs.<?php echo $itemtotal ?>.00</span>
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
    } else {
        ?>
        <!-- empty -->
        <div class="col-12">
            <div class="row">
                <div class="col-12 emptycart"></div>
                <div class="col-12 text-center mb-2">
                    <label class="form-label fs-1">You Have No Items Related to You Search</label>
                </div>
                <div class="offset-0 col-lg-4 col-12 offset-lg-4 d-grid mb-4">
                    <a class="btn btn-primary fs-3" href="home.php">Start Shoppig </a>
                </div>
            </div>
        </div>
        <!-- empty -->
<?php
    }
}
