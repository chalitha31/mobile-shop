<?php
session_start();
require "connection.php";
$fromDate = '';
$toDate = '';
if (isset($_SESSION["a"])) {
    if (isset($_GET["tdate"])) {
        $fromDate = $_GET["fdate"];
        $toDate = $_GET["tdate"];
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Mobile sHop | Admins | Selling History</title>
        <link rel="icon" href="resources/Logo.png" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);min-height: 100vh;">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-light text-center mb-3">
                    <label class="form-label fs-1 fw-bold text-primary">Selling History</label>

                </div>
                <div class="col-12 bg-white mt-3 mb-3">
                    <div class="row">
                        <div class="col-12 col-lg-3 mt-3 mb-3">
                            <label class="form-label fs-5"> Search By Invoice Id : </label>
                            <input onkeyup="searchSelling();" id="searchid" type="text" class="form-control fs-5" placeholder="Invoice ID...">
                        </div>
                        <div class="col-12 col-lg-2 mt-3 mb-3"></div>

                        <div class="col-12 col-lg-3 mt-3 mb-3">
                            <label class="form-label fs-5"> From Date : </label>
                            <input onchange="searchSelling();" id="fromDate" type="date" class="form-control fs-5" <?php
                                                                                                                    if ($fromDate != '') {
                                                                                                                        echo "value='" . $fromDate . "'";
                                                                                                                    }
                                                                                                                    ?>>
                        </div>
                        <div class="col-12 col-lg-3 mt-3 mb-3">
                            <label class="form-label fs-5"> To date : </label>
                            <input onchange="searchSelling();" id="toDate" type="date" class="form-control fs-5" <?php
                                                                                                                    if ($toDate != '') {
                                                                                                                        echo "value='" . $toDate . "'";
                                                                                                                    }
                                                                                                                    ?>>
                        </div>
                        <div class="col-12 col-lg-1 mt-3 mb-3 d-grid">
                            <button class="btn btn-primary" onclick="searchSelling();">Find</button>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white">Invoice Id</label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-dark">Product</label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white">Buyer</label>
                        </div>
                        <div class="col-2 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-dark">Amount</label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white">Quantity</label>
                        </div>
                        <div class="col-2 bg-white">

                        </div>

                    </div>
                </div>
                <div id="items">
                    <?php
                    $page_no;
                    if (isset($_GET["page"])) {
                        $page_no = $_GET["page"];
                    } else {
                        $page_no = 1;
                    }
                    $addq = '';
                    if ($fromDate != '') {
                        $addq .= "WHERE `date` BETWEEN '" . strval($fromDate) . "' AND '" . strval($toDate) . "' ";
                    }
                    $invoice_rs = Database::search("SELECT * fROM `invoice` " . $addq . " ");
                    $invoice_num = $invoice_rs->num_rows;
                    $result_per_page = 10;
                    $number_of_pages = ceil($invoice_num / $result_per_page);
                    $page_first_result = ((int) $page_no - 1) * $result_per_page;


                    $q = "SELECT  `invoice`.`id`,`product`.`title`,`user`.`fname`,`user`.`lname`,`invoice`.`total`,`invoice`.`qty`,`invoice`.`status` FROM `invoice` JOIN `user` ON `invoice`.`user_email` = `user`.`email` JOIN `product` ON `product`.`id` = `invoice`.`product_id` " . $addq . " ORDER BY `date` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ";
                    $results = Database::search($q);

                    while ($product_data = $results->fetch_assoc()) {
                    ?>

                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-12" id="loadResults">

                                    <div class="row" id="box">

                                        <div class="col-1 bg-secondary text-end">
                                            <label class="form-label fs-5 fw-bold text-white"><?php echo $product_data["id"]; ?></label>
                                        </div>
                                        <div class="col-3 bg-body text-end">
                                            <label class="form-label fs-5 fw-bold text-dark"><?php echo $product_data["title"]; ?></label>
                                        </div>
                                        <div class="col-3 bg-secondary text-end">
                                            <label class="form-label fs-5 fw-bold text-white"><?php echo $product_data["fname"] . " " . $product_data["lname"]; ?></label>
                                        </div>
                                        <div class="col-2 bg-body text-end">
                                            <label class="form-label fs-5 fw-bold text-dark"><?php echo $product_data["total"]; ?></label>
                                        </div>
                                        <div class="col-1 bg-secondary text-end">
                                            <label class="form-label fs-5 fw-bold text-white"><?php echo $product_data["qty"] ?></label>
                                        </div>
                                        <div class="col-2 bg-white d-grid">
                                            <?php
                                            $x = $product_data["status"];
                                            if ($x == 0) {
                                            ?>
                                                <button class="btn  btn-success mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id'] ?>);" id="btn<?php echo $product_data["id"]; ?>">
                                                    Confirm Order
                                                </button>
                                            <?php
                                            } else if ($x == 1) {
                                            ?>
                                                <button class="btn btn-warning mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id'] ?>);" id="btn<?php echo $product_data["id"]; ?>">
                                                    Packing
                                                </button>
                                            <?php
                                            } else if ($x == 2) {
                                            ?>
                                                <button class="btn btn-info mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id'] ?>);" id="btn<?php echo $product_data["id"]; ?>">
                                                    Dispatch
                                                </button>
                                            <?php
                                            } else if ($x == 3) {
                                            ?>
                                                <button class="btn btn-primary mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id'] ?>);" id="btn<?php echo $product_data["id"]; ?>">
                                                    Shipping
                                                </button>
                                            <?php
                                            } else if ($x == 4) {
                                            ?>
                                                <button class="btn btn-danger mb-2 mt-2 fw-bold" onclick="changeInvoiceId(<?php echo $product_data['id'] ?>);" id="btn<?php echo $product_data["id"]; ?>" disabled>
                                                    Delivered
                                                </button>
                                            <?php
                                            }

                                            ?>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php

                    }
                    ?>

                    <div class="offset-lg-4 col-12 col-lg-4 text-center mt-3 mb-3 d-flex justify-content-center">

                        <div class="row">
                            <div class="pagination">
                                <a href="<?php
                                            if ($page_no <= 1) {
                                                echo "#";
                                            } else {
                                                echo "sellingHistory.php?page=" . ($page_no - 1);
                                            }
                                            ?>">&laquo;</a>
                                <?php
                                for ($i = 1; $i <= $number_of_pages; $i++) {
                                    if ($i == $page_no) {
                                ?>
                                        <a href="sellingHistory.php?page=<?php echo $page_no ?><?php

                                                                                                if (isset($toDate)) {
                                                                                                    echo "&tdate=" . $toDate;
                                                                                                    echo "&fdate=" . $fromDate;
                                                                                                }
                                                                                                ?>" class="active"><?php echo $i ?></a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="sellingHistory.php?page=<?php echo $i ?>?><?php

                                                                                            if (isset($toDate)) {
                                                                                                echo "&tdate=" . $toDate;
                                                                                                echo "&fdate=" . $fromDate;
                                                                                            }
                                                                                            ?>"><?php echo $i ?></a>
                                <?php
                                    }
                                }
                                ?>


                                <a href="<?php
                                            if ($page_no >= $number_of_pages) {
                                                echo "#";
                                            } else {
                                                echo "sellingHistory.php?page=" . ($page_no + 1);
                                            }
                                            ?>">&raquo;</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <script src="script.js"></script>
        <script>
            document.getElementById("searchid").focus();
        </script>
    </body>

    </html>

<?php
}
?>