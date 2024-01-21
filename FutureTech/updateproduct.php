<?php
require "connection.php";
session_start();
$product = $_SESSION["p"];
if (isset($product)) {
?>

    <html>

    <head>
        <title>The Mobile sHop | Update Product</title>
        <link rel="icon" href="resources/Logo.png" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>


    <body>
        <div class="container-fluid">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="col-12 mb-2">

                        <h3 class="h2  text-center text-primary">Product Update</h3>

                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <span class="text-danger h5" id="msg"></span>
                            <div class="col-12 col-lg-4">
                                <div class="row">





                                    <div classc="col-12">
                                        <label class="form-label lbl1">Select Product Category</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="ca" disabled>
                                            <?php
                                            $category = Database::search("SELECT * FROM `category` WHERE `id` = '" . $product['category'] . "'");
                                            $cd = $category->fetch_assoc();
                                            ?>
                                            <option value="0"><?php echo $cd["name"] ?></option>

                                        </select>
                                    </div>


                                </div>
                            </div>
                            <?php
                            $modelBrand = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "' ");
                            $row = $modelBrand->fetch_assoc();
                            ?>
                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div classc="col-12">
                                        <label class="form-label lbl1">Select Product Brand</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="br" disabled>
                                            <?php
                                            $brand = Database::search("SELECT * FROM `brand` WHERE `id`='" . $row["brand_id"] . "' ");
                                            $brRow = $brand->fetch_assoc();
                                            ?>
                                            <option><?php echo $brRow["name"] ?></option>
                                        </select>
                                    </div>


                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div classc="col-12">
                                        <label class="form-label lbl1">Select Product Model</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="mo" disabled>
                                            <?php
                                            $model = Database::search("SELECT * FROM `model` WHERE `id`='" . $row["model_id"] . "' ");
                                            $moRow = $model->fetch_assoc();
                                            ?>
                                            <option><?php echo $moRow["name"] ?></option>
                                        </select>
                                    </div>


                                </div>
                            </div>

                            <hr class="hr-beak-1">

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add a Title to Your Product</label>
                                    </div>
                                    <div class="offset-lg-2 col-12 col-lg-8">
                                        <input class="form-control" type="text" id="ti" value="<?php echo $product['title'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-beak-1" />

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Select Product Condition</label>
                                            </div>
                                            <?php
                                            $prodbrand_rs = Database::search("SELECT * FROM `product` JOIN `condition` ON `condition`.`id` = `product`.`condition_id` WHERE `product`.`id`= '" . $product["id"] . "'  ");
                                            $prodbrand_data = $prodbrand_rs->fetch_assoc();
                                            $brand_rs = Database::search("SELECT * FROM `condition` ");
                                            $brand_num = $brand_rs->num_rows;
                                            for ($i = 0; $i < $brand_num; $i++) {
                                                $brand_data = $brand_rs->fetch_assoc();
                                            ?>

                                                <div class="form-check offset-1 col-11 col-lg-3 ms-5">
                                                    <input class="form-check-input" onchange="brandCheck(<?php echo $brand_data['id']; ?>);" type="radio" name="flexRadioDefaul" <?php if ($brand_data["name"] == $prodbrand_data["name"]) {
                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                    } ?> />
                                                    <label class="form-check-label" for="bn">
                                                        <?php echo $brand_data["name"]; ?>
                                                    </label>
                                                    <?php
                                                    if ($brand_data["name"] == $prodbrand_data["name"]) {
                                                    ?>
                                                        <span id="confallback" class="d-none"><?php echo $brand_data["id"] ?></span>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            <?php

                                            }
                                            ?>


                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <label class="form-label lbl1">Select Product Color</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <?php
                                                $prodclr_rs = Database::search("SELECT * FROM `product` JOIN `colour` ON `colour`.`id` = `product`.`colour_id` WHERE `product`.`id`= '" . $product["id"] . "'  ");
                                                $prodclr_data = $prodclr_rs->fetch_assoc();
                                                $color_rs = Database::search("SELECT * FROM `colour` ");
                                                $color_num = $color_rs->num_rows;
                                                for ($i = 0; $i < $color_num; $i++) {
                                                    $color_data = $color_rs->fetch_assoc();
                                                ?>
                                                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4 ">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" onchange="colorCheck(<?php echo $color_data['id'] ?>);" id="clr<?php echo $color_data['id']; ?>" <?php if ($color_data["name"] == $prodclr_data["name"]) {
                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                } ?> />
                                                        <label class="form-check-label" for="clr<?php echo $color_data['id'] ?>">
                                                            <?php echo $color_data["name"]; ?>
                                                        </label>
                                                        <?php if ($color_data["name"] == $prodclr_data["name"]) {
                                                        ?>
                                                            <span id="fallback" class="d-none"><?php echo $color_data['id']; ?></span>
                                                        <?php
                                                        } ?>
                                                    </div>
                                                <?php
                                                }

                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <label class="form-label lbl1">Add Product Quantity</label>
                                            <input class="form-control" type="number" value="<?php echo $product['qty']; ?>" min="0" id="qty" />
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <hr class="hr-beak-1">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Cost Per Item</label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" value="<?php echo $product['price'] ?>" aria-label="Amount (to the nearest dollar)" id="cost">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Approved Payment Methods</label>
                                            </div>
                                            <div class="col-9">
                                                <div class="row">
                                                    <div class="offset-2 col-1 pm1"></div>
                                                    <div class="offset-2 col-1 pm2"></div>
                                                    <div class="offset-2 col-1 pm3"></div>
                                                    <div class="offset-2 col-1 pm4"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="hr-beak-1" />

                            <div class="col-12 col-lg-6">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Delivery Cost</label>
                                    </div>
                                    <div class="col-12 col-lg-3 offset-lg-1">
                                        <label class="form-label ">Delivery Cost Within Colombo</label>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input value="<?php echo $product['delivery_fee_colombo'] ?>" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="dwc">
                                            <span class="input-group-text ">.00</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row mt-lg-4">
                                    <div class="col-12"></div>

                                    <div class="col-12 col-lg-3 mt-3 offset-lg-1">
                                        <label class="form-label ">Delivery Cost out of colombo</label>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="input-group mb-3  mt-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input value="<?php echo $product['delivery_fee_other'] ?>" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="doc">
                                            <span class="input-group-text ">.00</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <hr class="hr-beak-1" />
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Product Description</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" cols="30" rows="25" id="desc"><?php echo $product['description'] ?></textarea>
                                </div>
                            </div>
                            <hr class="hr-beak-1" />
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add Product Image</label>
                                    </div>
                                </div>
                                <div class="row">

                                </div>
                                <?php
                                $product_image = Database::search("SELECT * FROM `images` WHERE `product_id`= '" . $product['id'] . "' ");
                                $rn = $product_image->num_rows;
                                for ($x = 1; $x <= $rn; $x++) {
                                    $pid = $product_image->fetch_assoc();
                                ?>
                                    <img src="<?php echo $pid['code'] ?>" class="col-5 col-lg-2 ms-2 img-thumbnail" id="prev<?php echo $x ?>" />
                                    <?php
                                }
                                $LeftRows = 3 - $rn;
                                $offet;
                                if ($LeftRows == 2) {
                                    $offset = 1;
                                } else if ($LeftRows == 1) {
                                    $offset = 2;
                                }
                                if ($rn != 3) {
                                    for ($i = 1; $i <= $LeftRows; $i++) {
                                        $offset += 1;
                                    ?>
                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail" id="prev<?php echo $offset; ?>" />
                                <?php
                                    }
                                }
                                ?>

                                <div class="col-12 col-lg-6 mt-2 ms-2">
                                    <input type="file" class="d-none" accept="img/*" id="imageUploader" />
                                    <label for="imageUploader" class="col-5 ms-2 col-lg-12 btn btn-primary" onclick="changeProductImg('update');">Upload</label>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <hr class="hr-beak-1" />
                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label><br />
                    <label class="form-label">We are taking 5% of The Product From Every Products's Price</label>
                </div>

                <div class="col-12 col-lg-4 offset-lg-4 d-grid mb-2">
                    <button class="btn btn-success" onclick="updateProduct();">Update Product</button>
                </div>
                <?php

                require "footer.php";

                ?>
            </div>


        </div>



        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {

?>
    <script>
        alert("You Have To Sign In Or register First");
        window.location = "index.php";
    </script>
<?php

}
?>