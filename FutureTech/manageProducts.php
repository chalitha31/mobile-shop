<?php
session_start();
require "connection.php";
if (isset($_SESSION["a"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Mobile sHop | Admin | Manage Product</title>
        <link rel="icon" href="resources/Logo.png" />
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <script src="script.js"></script>
    </head>

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%, #9FACE6 100%);min-height: 100vh;">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-light text-center">
                    <h2 class="text-primary fw-bold ">
                        Manage All Products
                    </h2>
                </div>

                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-warning">Search Product</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-primary text-end py-2">
                            <span class="fs-4 fw-bold text-white ">#</span>
                        </div>
                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold">
                                Product Image
                            </span>
                        </div>
                        <div class="col-4 col-lg-2 bg-primary py-2">
                            <span class="fs-4 fw-bold text-white">Title</span>
                        </div>
                        <div class="col-4 col-lg-2 bg-light py-2">
                            <span class="fs-4 fw-bold">Price</span>
                        </div>
                        <div class="col-2  bg-primary py-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-white">Quantity</span>
                        </div>
                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold ">Registed Date</span>
                        </div>
                        <div class="col-2 col-lg-1 bg-white">

                        </div>
                    </div>

                </div>
                <?php
                $page_no;
                if (isset($_GET["page"])) {
                    $page_no = $_GET["page"];
                } else {
                    $page_no = 1;
                }
                $res = Database::search("SELECT * FROM `product`");
                $product_num = $res->num_rows;
                $result_per_page = 10;
                $number_of_page = ceil($product_num / $result_per_page);
                $page_first_result = ((int) $page_no - 1) * $result_per_page;
                $view_product_rs = Database::search("SELECT DISTINCT `product`.`blocked`,`product`.`id`,`status`.`name`,`product`.`user_email`,`product`.`description`,`product`.`title`,`product`.`price`,`product`.`qty`,`product`.`datetime_added` FROM `product` JOIN `status` ON `status`.`id` = `product`.`status_id` ORDER BY `datetime_added` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "    ");
                $view_result_num = $view_product_rs->num_rows;
                $c = 0;

                while ($product_data = $view_product_rs->fetch_assoc()) {
                    $c += 1;
                ?>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                                <span class="fs-4 fw-bold bold text-white"><?php echo $product_data["id"]; ?></span>
                            </div>

                            <div class="col-2 bg-light d-none py-2 d-lg-block " onclick="viewProductModal(<?php echo $product_data['id']; ?>);">
                                <img src="<?php $picRs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "' ");
                                            $picRsCount = $picRs->num_rows;
                                            if ($picRsCount > 0) {
                                                $picData = $picRs->fetch_assoc();
                                                echo $picData["code"];
                                            } else {
                                                echo "resources/empty.svg";
                                            }
                                            ?>" style="height: 40px;margin-left:80px;">
                            </div>
                            <div class="col-4 col-lg-2 bg-primary py-2 ">
                                <span class="fs-4 fw-bold text-white"><?php echo $product_data["title"]; ?></span>
                            </div>
                            <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                                <span class="fs-4 fw-bold "><?php echo $product_data["price"] ?></span>
                            </div>
                            <div class="col-2  bg-primary py-2 d-none d-lg-block">
                                <span class="fs-4 fw-bold text-white"><?php echo $product_data["qty"]; ?></span>
                            </div>
                            <div class="col-2 bg-light py-2 d-none d-lg-block">
                                <span class="fs-4 fw-bold"><?php $date = explode(" ", $product_data["datetime_added"]);
                                                            echo $date[0]; ?></span>
                            </div>
                            <div onclick="ProductBlock('<?php echo $product_data['id']; ?>');" class="col-2 col-lg-1 bg-white py-2 d-grid">
                                <button id="btn<?php echo $product_data['id']; ?>" class="btn btn-<?php
                                                                                                    if ($product_data["blocked"] == "0") {
                                                                                                        echo "danger";
                                                                                                    } else if ($product_data["blocked"] == "1") {
                                                                                                        echo "warning";
                                                                                                    }
                                                                                                    ?>"><?php
                                                                                                        if ($product_data["blocked"] == "0") {
                                                                                                            echo "Block";
                                                                                                        } else if ($product_data["blocked"] == "1") {
                                                                                                            echo "unblock";
                                                                                                        }
                                                                                                        ?></button>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal" tabindex="-1" id="viewproductmodal<?php echo $product_data['id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo $product_data["title"]; ?></h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="offset-lg-4 col-4">
                                        <img src="<?php $picRs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "' ");
                                                    $picRsCount = $picRs->num_rows;
                                                    if ($picRsCount > 0) {
                                                        $picData = $picRs->fetch_assoc();
                                                        echo $picData["code"];
                                                    } else {
                                                        echo "resources/empty.svg";
                                                    }
                                                    ?>" style="height: 150px;" class="img-fluid">
                                    </div>
                                    <div class="col-12">
                                        <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                        <span class="fs-5">Rs.<?php echo $product_data["price"]; ?>.00</span><br>
                                        <span class="fs-5 fw-bold">Quantity:</span>&nbsp;
                                        <span class="fs-5"><?php echo $product_data["qty"]; ?></span><br>
                                        <span class="fs-5 fw-bold">Seller :</span>
                                        <?php
                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $product_data["user_email"] . "' ");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        ?>
                                        <span class="fs-5"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br>
                                        <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                        <span class="fs-5"><?php echo $product_data["description"]; ?></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->

                <?php
                }
                ?>
                <div class="col-12 text-center my-3 d-flex justify-content-center">
                    <div class="pagination">
                        <a href="<?php
                                    if ($page_no <= 1) {
                                        echo "#";
                                    } else {
                                        echo "manageProducts.php?page=" . ($page_no - 1);
                                    }
                                    ?>">&laquo;</a>
                        <?php
                        for ($i = 1; $i <= $number_of_page; $i++) {
                            if ($i == $page_no) {
                        ?>
                                <a href="manageProducts.php?page=<?php echo $page_no ?>" class="active"><?php echo $i ?></a>
                            <?php
                            } else {
                            ?>
                                <a href="manageProducts.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                        <?php
                            }
                        }
                        ?>


                        <a href="<?php
                                    if ($page_no >= $number_of_page) {
                                        echo "#";
                                    } else {
                                        echo "manageProducts.php?page=" . ($page_no + 1);
                                    }
                                    ?>">&raquo;</a>
                    </div>
                </div>

                <hr>

                <!-- category -->

                <div class="col-12 mt-3">
                    <h3>Manage Category</h3>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row g-2">
                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($i = 0; $i < $category_num; $i++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>
                            <div class="col-12 d-grid col-lg-3 border border-danger" style="height: 50px;">
                                <div class="row pb-2">

                                    <div class="col-8  d-flex align-items-center h-100   border-dark border-end ">
                                        <label class="form-label px-3"><?php echo $category_data["name"]; ?></label>
                                    </div>
                                    <div class="col-4  text-center mt-2">
                                        <label class="form-label">
                                            <span onclick="removecategory(<?php echo  $category_data['id'] ?>);"><i class="fs-4 bi bi-dash-circle"></i></span>
                                        </label>

                                    </div>

                                </div>
                            </div>
                        <?php
                        }

                        ?>

                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row g-2">
                        <div class="col-12 col-lg-3 border border-danger bg-success" style="height: 50px;">
                            <div class="row">
                                <div class="col-8 mt-2">
                                    <label class="form-label px-3 fw-bold fs-5">Add New Catrgory</label>
                                </div>
                                <div class="col-4 border-start  text-center mt-2" onclick="addNewCategory();">
                                    <label class="form-label ">
                                        <i class="fs-4 bi bi-shield-fill-plus"></i>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- modal2 -->
                <div class="modal" tabindex="-1" id="addCategoryModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Add New Category</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 py-2">
                                    <label class="fs-5">Category Name :</label>
                                    <input type="text" class="form-control" id="n" />
                                </div>
                                <div class="col-12 py-2">
                                    <label class="fs-5">Your Email Address :</label>
                                    <input type="text" class="form-control" id="e" />
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" onclick="categoryVerifyModal();">Add Category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal2 -->

                <!-- modal3 -->
                <div class="modal" tabindex="-1" id="addCategoryModelVerification">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Verification</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 py-2">
                                    <label class="fs-5">Verification Code :</label>
                                    <input type="text" class="form-control" id="vtext" />
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" onclick="saveCategory();">Verify and Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal3 -->

                <!-- category -->

                <!-- brand -->

                <div class="col-12 mt-3">
                    <h3>Manage Brand</h3>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row g-2">
                        <?php
                        $brand_rs = Database::search("SELECT * FROM `brand`");
                        $brand_num = $brand_rs->num_rows;

                        for ($i = 0; $i < $brand_num; $i++) {
                            $brand_data = $brand_rs->fetch_assoc();
                        ?>
                            <div class="col-12 d-grid col-lg-3 border border-danger" style="height: 50px;">
                                <div class="row pb-2">

                                    <div class="col-8  d-flex align-items-center h-100   border-dark border-end ">
                                        <label class="form-label px-3"><?php echo $brand_data["name"]; ?></label>
                                    </div>
                                    <div class="col-4  text-center mt-2">
                                        <label class="form-label">
                                            <span onclick="removebrand(<?php echo  $brand_data['id'] ?>);"><i class="fs-4 bi bi-dash-circle"></i></span>
                                        </label>

                                    </div>

                                </div>
                            </div>
                        <?php
                        }

                        ?>

                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row g-2">
                        <div class="col-12 col-lg-3 border border-danger bg-success" style="height: 50px;">
                            <div class="row">
                                <div class="col-8 mt-2">
                                    <label class="form-label px-3 fw-bold fs-5">Add New Brand</label>
                                </div>
                                <div class="col-4 border-start  text-center mt-2" onclick="addNewbrand();">
                                    <label class="form-label ">
                                        <i class="fs-4 bi bi-shield-fill-plus"></i>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- modal2 -->
                <div class="modal" tabindex="-1" id="addBrandModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Add New Brand</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 py-2">
                                    <label class="fs-5">Brand Name :</label>
                                    <input type="text" class="form-control" id="bn" />
                                </div>
                                <div class="col-12 py-2">
                                    <label class="fs-5">Your Email Address :</label>
                                    <input type="text" class="form-control" id="be" />
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" onclick="brandVerifyModal();">Add Brand</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal2 -->

                <!-- modal3 -->
                <div class="modal" tabindex="-1" id="addbrandModelVerification">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Verification</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 py-2">
                                    <label class="fs-5">Verification Code :</label>
                                    <input type="text" class="form-control" id="bvtext" />
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" onclick="savebrand();">Verify and Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal3 -->

                <!-- brand -->

                <!-- Model -->

                <div class="col-12 mt-3">
                    <h3>Manage Model</h3>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row g-2">
                        <?php
                        $model_rs = Database::search("SELECT * FROM `model`");
                        $model_num = $model_rs->num_rows;

                        for ($i = 0; $i < $model_num; $i++) {
                            $model_data = $model_rs->fetch_assoc();
                        ?>
                            <div class="col-12 d-grid col-lg-3 border border-danger" style="height: 50px;">
                                <div class="row pb-2">

                                    <div class="col-8  d-flex align-items-center h-100   border-dark border-end ">
                                        <label class="form-label px-3"><?php echo $model_data["name"]; ?></label>
                                    </div>
                                    <div class="col-4  text-center mt-2">
                                        <label class="form-label">
                                            <span onclick="removemodel(<?php echo  $model_data['id'] ?>);"><i class="fs-4 bi bi-dash-circle"></i></span>
                                        </label>

                                    </div>

                                </div>
                            </div>
                        <?php
                        }

                        ?>

                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row g-2">
                        <div class="col-12 col-lg-3 border border-danger bg-success" style="height: 50px;">
                            <div class="row">
                                <div class="col-8 mt-2">
                                    <label class="form-label px-3 fw-bold fs-5">Add New Model</label>
                                </div>
                                <div class="col-4 border-start  text-center mt-2" onclick="addNewmodel();">
                                    <label class="form-label ">
                                        <i class="fs-4 bi bi-shield-fill-plus"></i>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- modal2 -->
                <div class="modal" tabindex="-1" id="addmodelModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Add New Model</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 py-2">
                                    <label class="fs-5">Model Name :</label>
                                    <input type="text" class="form-control" id="mn" />
                                </div>
                                <div class="col-12 py-2">
                                    <label class="fs-5">Your Email Address :</label>
                                    <input type="text" class="form-control" id="me" />
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" onclick="modelVerifyModal();">Add Model</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal2 -->

                <!-- modal3 -->
                <div class="modal" tabindex="-1" id="addmodelModelVerification">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Verification</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 py-2">
                                    <label class="fs-5">Verification Code :</label>
                                    <input type="text" class="form-control" id="mvtext" />
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" onclick="savemodel();">Verify and Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal3 -->

                <!-- Model -->


                <!-- Colour -->

                <div class="col-12 mt-3">
                    <h3>Manage Colour</h3>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="row g-2">
                        <?php
                        $colour_rs = Database::search("SELECT * FROM `colour`");
                        $colour_num = $colour_rs->num_rows;

                        for ($i = 0; $i < $colour_num; $i++) {
                            $colour_data = $colour_rs->fetch_assoc();
                        ?>
                            <div class="col-12 d-grid col-lg-3 border border-danger" style="height: 50px;">
                                <div class="row pb-2">

                                    <div class="col-8  d-flex align-items-center h-100   border-dark border-end ">
                                        <label class="form-label px-3"><?php echo $colour_data["name"]; ?></label>
                                    </div>
                                    <div class="col-4  text-center mt-2">
                                        <label class="form-label">
                                            <span onclick="removecolour(<?php echo  $colour_data['id'] ?>);"><i class="fs-4 bi bi-dash-circle"></i></span>
                                        </label>

                                    </div>

                                </div>
                            </div>
                        <?php
                        }

                        ?>

                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row g-2">
                        <div class="col-12 col-lg-3 border border-danger bg-success" style="height: 50px;">
                            <div class="row">
                                <div class="col-8 mt-2">
                                    <label class="form-label px-3 fw-bold fs-5">Add New Colour</label>
                                </div>
                                <div class="col-4 border-start  text-center mt-2" onclick="addNewcolour();">
                                    <label class="form-label ">
                                        <i class="fs-4 bi bi-shield-fill-plus"></i>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- modal2 -->
                <div class="modal" tabindex="-1" id="addmodelcolour">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Add New Colour</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 py-2">
                                    <label class="fs-5">colour Name :</label>
                                    <input type="text" class="form-control" id="cln" />
                                </div>
                                <div class="col-12 py-2">
                                    <label class="fs-5">Your Email Address :</label>
                                    <input type="text" class="form-control" id="cle" />
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" onclick="colourVerifyModal();">Add colour</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal2 -->

                <!-- modal3 -->
                <div class="modal" tabindex="-1" id="addcolourModelVerification">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Verification</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 py-2">
                                    <label class="fs-5">Verification Code :</label>
                                    <input type="text" class="form-control" id="clvtext" />
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" onclick="savecolour();">Verify and Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal3 -->

                <!-- Model -->


            </div>

        </div>

        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("Please Sign In as Admin");
        window.location = "adminsignin.php";
    </script>
<?php
}
?>