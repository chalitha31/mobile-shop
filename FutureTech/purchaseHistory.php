<?php
require "connection.php";
require "Heder.php";
session_start();
if (isset($_SESSION["u"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">


        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>The Mobile sHop | Purchase History</title>
        <link rel="icon" href="resources/Logo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 text-center mb-3 ">
                    <span class="fs-1 fw-bold text-primary">
                        Transaction History
                    </span>
                </div>
                <?php
                $purchase_rs = Database::search("SELECT * FROM `invoice`  WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' AND `hidden` = '0' ORDER BY `date` DESC ");
                $purchase_rsn = $purchase_rs->num_rows;
                if ($purchase_rsn == 0) {
                ?>
                    <div class="col-12 bg-light text-center">
                        <span style="margin-top: 200px;margin-bottom:200px ;" class="fs-1 fw-bold text-black-50 d-block">
                            You Have No Items In Your history Yet...
                        </span>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 d-none d-lg-block">
                                <div class="row">
                                    <div class="col-1 bg-light">
                                        <label class="form-label fw-bold">#</label>
                                    </div>

                                    <div class="col-3 bg-light text end">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-light text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Purchased Date and time</label>
                                    </div>
                                    <div class="col-3 bg-light ">

                                    </div>
                                    <div class="col-12">
                                        <hr />
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <?php
                                    for ($i = 0; $i < $purchase_rsn; $i++) {
                                        $data = $purchase_rs->fetch_assoc();
                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();
                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "' ");
                                        $image_rsn = $image_rs->num_rows;
                                    ?>
                                        <div class="col-12 col-lg-1 bg-info text-center text-lg-start">
                                            <label class="form-label text-white fs-6 py-5"><?php
                                                                                            echo  $data["order_id"];
                                                                                            ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="row g-2">
                                                <div class="card mx-0 my-3" style="max-width: 540px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <?php
                                                            if ($image_rsn >= 1) {
                                                                $image_data = $image_rs->fetch_assoc();
                                                            ?>
                                                                <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start" alt="...">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resources/empty.svg" class="img-fluid rounded-start" alt="...">

                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?php echo $product_data["title"] ?></h5>
                                                                <p class="card-text"><b>Seller : </b> <?php echo $product_data["user_email"] ?> </p>
                                                                <p class="card-text"><b>Price : </b> Rs.<?php echo $product_data["price"]; ?>.00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-1 text-center text-lg-end bg-light">
                                            <label class="form-label fs-4 pt-5"><?php echo $data["qty"]; ?></label>
                                        </div>

                                        <div class="col-12 col-lg-2 text-center text-lg-end bg-info">
                                            <label class="form-label fs-5 pt-5 text-white fw-bold">Rs.<?php echo $data["total"]; ?>.00</label>
                                        </div>

                                        <div class="col-12 col-lg-2 text-center text-lg-end bg-light">
                                            <label class="form-label fs-5 py-5 px-3 fw-bold"><?php echo $data["date"]; ?></label>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="row">
                                                <div class="col-6 d-grid">

                                                    <button onclick="showFeedbackModel('<?php echo $product_data['id'] ?>','<?php echo $product_data['title'] ?>','<?php echo $data['id'] ?>');" class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5"><i class="bi bi-info-circle-fill"></i> Feed Back</button>
                                                </div>

                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-danger rounded mt-5 fs-5" onclick="deleteFromPHistory('<?php echo $data['id']; ?>');"><i class="bi bi-trash-fill"></i> Delete</button>
                                                </div>

                                                <div class="col-12">
                                                    <hr style="border-style: solid;border-width: 2px;border-color: rgb(0, 0, 0);">
                                                </div>



                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <div class="col-12">
                                        <hr>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="row">
                                            <div class="col-lg-10 d-none d-lg-block">
                                            </div>
                                            <div class="col-12 col-lg-2 d-grid">
                                                <button class="btn btn-danger rounded" onclick="clearAllPurshase();"><i class="bi bi-trash-fill"></i> Clear All records</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                }
                ?>





                <?php require "footer.php" ?>
            </div>
        </div>
        <!-- modal -->
        <div class="modal" id="veificationModel" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="d-none" id="trid">id</span>
                        <span class="d-none" id="pid">id</span>
                        <h5 class="modal-title" id="ptitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 text-end my-auto">
                                <span class="fs-5">Select Rating :</span>
                            </div>
                            <div class="col-6 text-start fs-4">
                                <?php
                                for ($i = 1; $i < 6; $i++) {
                                ?>
                                    <i class="bi bi-star-fill fs-3 label2" onclick="markStar('<?php echo $i; ?>');" id="star<?php echo $i ?>"></i>
                                <?php
                                }

                                ?>

                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-12">
                                <textarea class="form-control" id="feed" rows="10" placeholder="Write Your Feelings"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="resetPurchaseModal();" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addfeedback();">Add Feedback</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
    </body>
    <script src="script.js"></script>

    </html>

<?php
} else {
?>
    <script>
        alert("Please Sign In First");
        window.location = "index.php";
    </script>
<?php
}
?>