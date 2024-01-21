<?php
session_start();
require "connection.php";
if (isset($_SESSION["a"])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>


        <title>The Mobile sHop | Admin Pannel</title>
        <link rel="icon" href="resources/Logo.png" />

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    </head>

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%, #9FACE6 100%);min-height: 100vh;">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-2">
                    <div class="row">

                        <div class="align-items-start bg-dark col-12">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-5">
                                    <h4 class="text-white">
                                        <?php echo $_SESSION["a"]["fname"] . " " . $_SESSION["a"]["lname"]; ?>
                                    </h4>
                                    <hr class="border border-1 border-white">
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-4">
                                    <nav class="nav flex-column">
                                        <a class="nav-link fs-5 active" href="#">Dashboard</a>
                                        <a class="nav-link fs-5" href="addproduct.php">Add Product</a>
                                        <a class="nav-link fs-5" href="manageProducts.php">Manage Product</a>
                                        <a class="nav-link fs-5" href="myProducts.php">My Product</a>
                                    </nav>
                                </div>
                                <div class="col-12 mt-5">
                                    <hr class="border border-1 border-white">
                                    <h4 class="text-white">Selling Hisory</h4>
                                    <hr class="border border-1 border-white">
                                </div>
                                <div class="col-12 mt-3 d-grid">
                                    <h5 class="text-white">From Date</h5>
                                    <input type="date" id="fdate" class="form-control">
                                    <h5 class="text-white">To Date</h5>
                                    <input type="date" id="tdate" class="form-control">
                                    <a onclick="viewSellings();" class="btn btn-primary fw-bold mt-2">View Sellings</a>
                                    <hr class="border border-1 border-white">
                                    <hr class="border border-1 border-white">
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="col-12 col-lg-12">

                            <div class="row">
                                <div class="col-6 col-lg-6 text-white  mb-3 mt-2">
                                    <span class="fw-bold fs-2"> Dashbord</span>
                                </div>

                                <div class="col-6 col-lg-6 text-white text-end  mb-3 mt-1">
                                    <span class="fw-bold" onclick="adminsignout();"><i class="fs-1 text-danger bi bi-box-arrow-left"></i></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row g-1">
                                <?php
                                $today = date("Y-m-d");

                                $this_month = date("m");
                                $this_year = date("Y");

                                $a = "0";
                                $b = "0";
                                $c = "0";
                                $d = "0";
                                $e = 0;

                                $mycount = 0;

                                $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                $invoice_num = $invoice_rs->num_rows;

                                for ($x = 0; $x < $invoice_num; $x++) {
                                    $invoice_data =  $invoice_rs->fetch_assoc();

                                    $mycount += intval($invoice_data["qty"]);

                                    $f = $invoice_data["date"];

                                    $split_date = explode(" ", $f);
                                    $pdate = $split_date[0];

                                    if ($pdate == $today) {
                                        $a = $a + $invoice_data["total"];
                                        $c = $c + $invoice_data["qty"];
                                    }
                                    $split_result = explode("-", $pdate);

                                    $pyear = $split_result[0];
                                    $pmonth = $split_result[1];



                                    if ($pyear == $this_year) {

                                        if ($pmonth == $this_month) {

                                            $b = $b + $invoice_data["total"];
                                            $d = $d + $invoice_data["qty"];
                                        }
                                    }
                                }

                                ?>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fw-bold">Daily Ernings</span>
                                            <br />
                                            <span class="fs-5">Rs.<?php echo $a ?> .00</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-white text-dark text-center rounded " style="height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br>
                                            <span class="fs-5">Rs.<?php echo $b ?>.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark text-white text-center rounded " style="height: 100px;">
                                            <br>
                                            <span class="fs-4  fw-bold">Total Sellings Earnings</span>
                                            <br>
                                            <span class="fs-5 "><?php echo $c ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded " style="height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Monthly Sellings </span>
                                            <br>
                                            <span class="fs-5"><?php echo $d ?> Items</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-center rounded " style="height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Total Sellings </span>
                                            <br>
                                            <span class="fs-5"><?php echo $mycount ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger text-white text-center rounded " style="height: 100px;">
                                            <br>
                                            <span class="fs-4 fw-bold">Total Engagements </span>
                                            <br>
                                            <?php
                                            $user_rs =  Database::search("SELECT * FROM `user`");
                                            $user_rsn = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5"><?php echo $user_rsn ?> members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                        </div>

                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center my-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Activie Time</label>

                                </div>
                                <?php
                                $start_date = new DateTime("2022-07-01 00:00:00");

                                $tdate = new DateTime();
                                $tz = new DateTimeZone("Asia/Colombo");
                                $tdate->setTimezone($tz);
                                $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));
                                $deference = $end_date->diff($start_date);

                                ?>
                                <div class="col-12 col-lg-10 text-end my-3">
                                    <label class="form-label fs-4 fw-bold text-white">
                                        <?php echo $deference->format('%Y') . " Years " . $deference->format('%m') . " Months " . $deference->format("%d") . " Days " . $deference->format("%H") . " Hours " . $deference->format("%i") . " Minutes " . $deference->format("%s") . " Seconds "    ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                            <div class="row g-1">

                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Moslty Sold Item</label>
                                </div>

                                <?php

                                $pdetails = null;
                                $req_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1 ");
                                $freq_num = $req_rs->num_rows;
                                if ($freq_num > 0) {
                                    $freq_data = $req_rs->fetch_assoc();
                                    $promimg = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $freq_data["product_id"] . "' ");
                                    $code =  $promimg->fetch_assoc();

                                    $productDetails = Database::search("SELECT * FROM `product` WHERE `id` = '" . $freq_data["product_id"] . "' ");
                                    $pdetails = $productDetails->fetch_assoc();

                                    $qtyrs = Database::search("SELECT SUM(`qty`) AS `total` FROM `invoice` WHERE `product_id` = '" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%' ");
                                    $qtytotal = $qtyrs->fetch_assoc();
                                ?>
                                    <div class="col-12 text-center ">
                                        <img src="<?php echo $code["code"] ?>" class="img-fluid rounded-top" height="250px">
                                        <hr>
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-6"><?php echo $pdetails["title"]; ?></span>
                                        <br>
                                        <span class="fs-6"><?php echo $qtytotal["total"] ?> Items </span>
                                        <br>
                                        <span class="fs-6">Rs.<?php echo $pdetails["price"] ?>.00</span>
                                        <hr />
                                    </div>

                                    <div class="col-12 text-center">

                                    </div>


                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-light">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Most Famous seller</label>
                                </div>
                                <?php
                                    $profileimg = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $pdetails["user_email"] . "' ");
                                    $pcode = $profileimg->fetch_assoc();
                                    $userDeatails = Database::search("SELECT * FROM `user` WHERE `email` = '" . $pdetails["user_email"] . "'");
                                    $udeatails = $userDeatails->fetch_assoc();

                                ?>

                                <div class="col-12 text-center">
                                    <img style="width: 200px;" src="<?php echo $pcode["code"] ?>" class="img-fluid rounded-top">
                                    <hr>
                                </div>

                                <div class="col-12 text-center">


                                    <span class="fs-6 fw-bold">
                                        <?php echo $udeatails["fname"] . " " . $udeatails["lname"] ?>
                                    </span>
                                    <br>
                                    <span class="fs-6"><?php echo $pdetails["user_email"]; ?></span>
                                    <br>
                                    <span class="fs-6"><?php echo $udeatails["mobile"]; ?></span>
                                    <br>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="first_place">

                                    </div>
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
        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
?>

    <script>
        alert("Please Sign in First");
        window.location = "adminsignin.php";
    </script>

<?php
}
?>