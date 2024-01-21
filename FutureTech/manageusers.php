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
        <title>The Mobile sHop | Admin Pannel | Manage Users</title>
        <link rel="icon" href="resources/Logo.png" />
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
    </head>

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%, #9FACE6 100%);min-height: 100vh;">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-light text-center">
                    <h2 class="text-primary fw-bold">Manage All Users</h2>
                </div>
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 mn-3">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-3 d-grid">
                                    <button class="btn btn-warning">Search User</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
                    <div class="row">


                        <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                            <span class="fs-4 fw-bold text-white">#</span>
                        </div>
                        <div class="col-2  bg-light py-2 d-none d-lg-block">
                            <!-- none -->
                            <span class="fs-4 fw-bold ">Profile Image</span>
                        </div>
                        <div class="col-4 col-lg-2 bg-primary py-2 ">
                            <span class="fs-4 fw-bold text-white">user Name</span>
                        </div>
                        <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                            <!-- none -->
                            <span class="fs-4 fw-bold ">Email</span>
                        </div>
                        <div class="col-2  bg-primary py-2 d-none d-lg-block">
                            <!-- none -->
                            <span class="fs-4 fw-bold text-white">Mobile</span>
                        </div>
                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <!-- none -->
                            <span class="fs-4 fw-bold">Registered Date</span>
                        </div>

                        <div class="col-2 col-lg-1 bg-white">

                        </div>




                    </div>
                </div>
                <?php

                if (isset($_GET["page"])) {
                    $page_no = $_GET["page"];
                } else {
                    $page_no = 1;
                }
                $res = Database::search("SELECT * FROM `user` WHERE `user`.`email` != '" . $_SESSION["a"]["email"] . "'");
                $product_num = $res->num_rows;
                $result_per_page = 10;
                $number_of_page = ceil($product_num / $result_per_page);
                $page_first_result = ((int) $page_no - 1) * $result_per_page;
                $rs = Database::search("SELECT * FROM `user` LEFT JOIN `profile_img` ON `profile_img`.`user_email` = `user`.`email` WHERE `user`.`email` != '" . $_SESSION["a"]["email"] . "'  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "   ");


                $rsn = $rs->num_rows;
                for ($i = 1; $i <= $rsn; $i++) {
                    $data = $rs->fetch_assoc();
                ?>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            if ($data["code"] == "") {
                                $data["code"] == "resources//User_Profile.svg";
                            }

                            ?>
                            <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                                <span class="fs-4 fw-bold bold text-white"><?php echo $i ?></span>
                            </div>

                            <div class="col-2 bg-light d-none py-2 d-lg-block " onclick="viewsgmodal('<?php echo $data['email'] ?>');">
                                <img src="<?php
                                            if ($data["code"] == "") {
                                                echo "resources/User_Profile.svg";
                                            } else {
                                                echo $data["code"];
                                            }
                                            ?>" style="height: 40px;margin-left:80px;">
                            </div>
                            <div class="col-4 col-lg-2 bg-primary py-2 ">
                                <span class="fs-4 fw-bold text-white"><?php echo $data["fname"] . " " . $data["lname"] ?></span>
                            </div>
                            <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                                <span class="fs-4 fw-bold "><?php echo $data["email"]; ?></span>
                            </div>
                            <div class="col-2  bg-primary py-2 d-none d-lg-block">
                                <span class="fs-4 fw-bold text-white"><?php echo $data["mobile"] ?></span>
                            </div>
                            <div class="col-2 bg-light py-2 d-none d-lg-block">
                                <span class="fs-4 fw-bold"><?php $date = explode(" ", $data["register_date"]);
                                                            echo $date[0]; ?></span>
                            </div>
                            <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                                <button id="btn<?php echo $data["email"] ?>" onclick="userBlock('<?php echo $data['email']; ?>');" class="btn btn-<?php
                                                                                                                                                    if ($data["blocked"] == "0") {
                                                                                                                                                        echo "danger";
                                                                                                                                                    } else if ($data["blocked"] == "1") {
                                                                                                                                                        echo "warning";
                                                                                                                                                    }
                                                                                                                                                    ?>"><?php
                                                        if ($data["blocked"] == "0") {
                                                            echo "Block";
                                                        } else if ($data["blocked"] == "1") {
                                                            echo "unblock";
                                                        }
                                                        ?></button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="col-12 text-center my-3 d-flex justify-content-center">
                    <div class="pagination">
                        <a href="<?php
                                    if ($page_no <= 1) {
                                        echo "#";
                                    } else {
                                        echo "manageusers.php?page=" . ($page_no - 1);
                                    }
                                    ?>">&laquo;</a>
                        <?php
                        for ($i = 1; $i <= $number_of_page; $i++) {
                            if ($i == $page_no) {
                        ?>
                                <a href="manageusers.php?page=<?php echo $i ?>" class="active"><?php echo $i ?></a>
                            <?php
                            } else {
                            ?>
                                <a href="manageusers.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                        <?php
                            }
                        }
                        ?>


                        <a href="<?php
                                    if ($page_no >= $number_of_page) {
                                        echo "#";
                                    } else {
                                        echo "manageusers.php?page=" . ($page_no + 1);
                                    }
                                    ?>">&raquo;</a>
                    </div>
                </div>
                <!-- model -->
                <div class="modal" tabindex="-1" id="viewmsgmodal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Admin Messages</h5>
                                <button class="btn btn-close" data-bs-dismiss="modal" aria-label="Close" type="button"></button>
                            </div>
                            <div class="modal-body" id="msgBody">
                                <!-- receved -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-8 bg-success rounded">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fs-4">Helle There!!</span>
                                                </div>
                                                <div class="col-12 text-end pb-3">
                                                    <span class="text text-white fs-6">2022-02-10</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- receved -->

                                <!-- Sent -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-8 offset-4 bg-success rounded">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fs-4">How are You</span>
                                                </div>
                                                <div class="col-12 text-end pb-3">
                                                    <span class="text text-white  fs-6">2022-02-10</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- sent -->
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="row">
                                        <span class="d-none" id="other"></span>
                                        <div class="col-8">
                                            <input type="text" id="msgtxt" class="form-control">
                                        </div>
                                        <div class="col-4 d-grid">
                                            <button class="btn btn-primary" onclick="sendMsg('admin')" id="msgSender">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- model -->
            </div>
        </div>
        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
} else {
?>
    <script>
        alert("Sign In as A admin to access this page");
        window.location = "adminsignin.php";
    </script>
<?php
}
?>