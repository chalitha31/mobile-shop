<?php

// session_start();

require "connection.php";
require "Heder.php";

if (isset($_SESSION["u"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>The Mobile sHop | User Profile</title>
        <link rel="icon" href="resources/Logo.png" />

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    </head>

    <body class=" ">

        <!-- Alert -->
        <div id="custom-dialog" style="display: none;">
            <div id="customAlert" class="message text-center">Do you want to continue?</div>
            <div class="buttons">
                <button id="custom-yes">Yes</button>
                <button id="custom-no">No</button>
            </div>
        </div>
        <!-- Alert -->

        <div class="container-fluid bg-body rounded item-container-bg mt-5 mb-4">

            <div class="row">
                <div class="col-md-3 border-end">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <?php
                        $profileImg = Database::search("SELECT * FROM `profile_img` WHERE `user_email`= '" . $_SESSION["u"]["email"] . "' ");
                        $pn = $profileImg->num_rows;
                        if ($pn == 1) {
                            $p = $profileImg->fetch_assoc();
                        ?>
                            <img class="rounded mt-5 " width="150px" src="<?php echo $p["code"];  ?>" id="prev0" />
                        <?php

                        } else {
                        ?>

                            <img class="rounded mt-5" width="150px" src="resources/profiles/profile.jpeg" id="prev0" />


                        <?php
                        }
                        ?>

                        <span class="fw-bold "><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span>
                        <span class="text-black-50 fw-bold"><?php echo $_SESSION["u"]["email"]; ?></span>
                        <input type="file" class="d-none" id="profileimg" accept="img/*" />
                        <button id="imgbutton"><label class="btn btn-primary " for="profileimg" onclick="changeImage();">Update Profile Image</label></button>
                    </div>

                </div>

                <div class="col-md-5 border-end">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Profile Settings</h4>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">First Name</label>
                                <input id="fname" type="text" class="form-control" placeholder="First Name" value="<?php echo $_SESSION["u"]["fname"]; ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Last Name</label>
                                <input id="lname" type="text" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION["u"]["lname"]; ?>" />
                            </div>
                        </div>
                        <div class="row mt-3 ">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Mobile no.</label>
                                <input type="text" id="mobile" class="form-control" placeholder="Enter Your Mobile Number" value="<?php echo $_SESSION["u"]["mobile"]; ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Password</label>
                                <div class="input-group ">
                                    <input id="pw" readonly type="password" class="form-control" placeholder="Enter Your Password" aria-label="Enter Your Password" value="<?php echo $_SESSION["u"]["password"]; ?>" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-dark" onclick="chngpswd();" type="button" id="button-addone2"><i id="eye" class="bi bi-eye-fill" onclick="chngpswd();"></i></button>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <input value="<?php echo $_SESSION["u"]["email"]; ?>" type="email" class="form-control" placeholder="Enter Your Email Address" readonly />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Registered Date</label>
                                <input value="<?php echo $_SESSION["u"]["register_date"]; ?>" type="email" class="form-control" placeholder="Enter Your Registered date" readonly />
                            </div>

                            <?php

                            $usermail = $_SESSION["u"]["email"];
                            $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`= '" . $usermail . "' ");
                            $n = $address->num_rows;

                            if ($n > 0) {
                                $d = $address->fetch_assoc();

                                $city = Database::search("SELECT * FROM `city`  WHERE `id`='" . $d["city_id"] . "' ");
                                $cf = $city->fetch_assoc();

                                $district = Database::search("SELECT * FROM `district` WHERE `id`='" . $cf["district_id"] . "' ");
                                $df = $district->fetch_assoc();

                                $province = Database::search("SELECT * FROM `province` WHERE `id`='" . $df["province_id"] . "' ");
                                $pf = $province->fetch_assoc();
                            ?>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Address Line 1</label>
                                    <input type="email" class="form-control" id="addline1" placeholder="Address Line 1" value="<?php echo $d["line1"]; ?>" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Address Line 2</label>
                                    <input type="email" class="form-control" id="addline2" placeholder="Address Line 2" value="<?php echo $d["line2"]; ?>" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Province</label>
                                    <select id="provi_Reg" class="form-select" onchange="load_district();">
                                        <option value="<?php echo $pf["id"]; ?>"><?php echo $pf["name"]; ?></option>
                                        <?php

                                        $pall = Database::search("SELECT * FROM `province` WHERE `name`!= '" . $pf["name"] . "' ");
                                        $num1 = $pall->num_rows;
                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"] ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">District</label>
                                    <select class="form-select" id="dist_Reg">

                                        <option value="<?php echo $df["id"]; ?>"><?php echo $df["name"]; ?></option>

                                        <?php

                                        $pall = Database::search("SELECT * FROM `district` WHERE `name`!= '" . $df["name"] . "' AND  `province_id` = '" . $pf["id"] . "' ");
                                        $num1 = $pall->num_rows;
                                        echo $num1;
                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"] ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">City</label>
                                    <select class="form-select" id="usercity">

                                        <option value="<?php echo $d["city_id"]; ?>"><?php echo $cf["name"] ?></option>
                                        <?php

                                        $rs1 = Database::search("SELECT * FROM `city`  WHERE `name`!= '" . $cf["name"] . "' ");
                                        $n1 = $rs1->num_rows;
                                        for ($x = 1; $x <= $n1; $x++) {
                                            $row1 = $rs1->fetch_assoc();
                                            if ($row1["id"] == $d["city_id"]) {
                                                continue;
                                            }
                                        ?>
                                            <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"] ?></option>
                                        <?php
                                        }

                                        ?>


                                    </select>
                                </div>

                                <!-- <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="email" class="form-control" placeholder="Postal Code" />
                                </div> -->

                            <?php
                            } else {
                            ?>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Address Line 1</label>
                                    <input type="email" id="addline1" class="form-control" placeholder="Address Line 1" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Address Line 2</label>
                                    <input type="email" class="form-control" id="addline2" placeholder="Address Line 2" />
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Province</label>
                                    <select id="provi_Reg" class="form-select" onchange="load_district();">
                                        <option value="0">Select Your Province</option>
                                        <?php

                                        $pall = Database::search("SELECT * FROM `province` ");
                                        $num1 = $pall->num_rows;
                                        for ($x = 1; $x <= $num1; $x++) {
                                            $row1 = $pall->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"] ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">District</label>
                                    <select id="dist_Reg" class="form-select">
                                        <option value="0">Select Your District</option>
                                        <?php
                                        $Dall = Database::search("SELECT * FROM `district`  ");
                                        $dnum1 = $Dall->num_rows;
                                        for ($x = 1; $x <= $dnum1; $x++) {
                                            $drow1 = $Dall->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $drow1["id"]; ?>"><?php echo $drow1["name"] ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">City</label>
                                    <select class="form-select" id="usercity">
                                        <option value="0">Select Your City</option>
                                        <?php
                                        $results = Database::search("SELECT * FROM `city`");
                                        $n = $results->num_rows;
                                        for ($i = 0; $i < $n; $i++) {
                                            $myData =  $results->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $myData["id"]; ?>"><?php echo $myData["name"] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                                <!-- <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input id="pstcode" type="email" class="form-control" placeholder="Postal Code" />
                                </div> -->
                            <?php
                            }
                            ?>




                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">gender</label>
                                <?php

                                $gid = $_SESSION["u"]["gender"];
                                $g = Database::search("SELECT * FROM `gender` WHERE `id` = '" . $gid . "'");
                                $gf = $g->fetch_assoc();
                                ?>
                                <input type="text" value="<?php echo $gf["name"]; ?>" class="form-control" placeholder="gender" readonly value="" />
                            </div>
                            <div class=" mt-3 text-center">
                                <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p3 py-5 text-center">

                        <!-- <button class="btn btn-outline-primary border-2"> <a style="text-decoration: none;" class="text-black" href="http://localhost/FutureTech/purchaseHistory.php">purchase History</a></button> -->

                        <!-- <div class="col-md-12">
                            <span class="header">User Rating</span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <p>4.1 average based on 254 reviews.</p>
                            <hr class="hr-break-1" />
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>5 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width:60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>150</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>4 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width:30%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>40</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>3 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width:10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>20</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>2 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width:5%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>10</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 side">
                                    <span>1 Star</span>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width:35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <span>60</span>
                                </div>
                            </div>
                        </div> -->

                    </div>





                </div>


                <?php

                require "foo.php";

                ?>

            </div>

        </div>
        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    </body>

    </html>

<?php
} else {
?>

    <script>
        window.location = "index.php";
    </script>
<?php
}

?>