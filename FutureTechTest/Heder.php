<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/Logo.png" />

</head>

<body>
    <div class="col-12">
        <div class="row ">

            <nav class="navbar  bg-dark fixed-top">
                <a href="home.php" class="logo-head "></a>
                <div class="col-10 mt-2 col-lg-10  align-self-start">



                    <span class="text-lg-start text-white label1"> <b>Wellcome</b>
                        <span class="text-primary">

                            <?php

                            session_start();


                            if (isset($_SESSION["u"])) {
                                $data = $_SESSION["u"];
                            ?>

                                <?php echo $data["fname"]; ?>

                            <?php
                            } else {

                            ?>
                                <a href="index.php">Sign In or Register</a>

                            <?php

                            }

                            ?>
                        </span>
                    </span>

                    <span class="text-lg-start text-white label2">| Help and Contact</span>

                    <?php
                    if (isset($_SESSION["u"])) {
                    ?>
                        <span class="text-lg-start text-primary label2" onclick="signOut();"><u>Sign Out</u> </span>

                    <?php

                    } else {
                    ?>
                        <span class="text-lg-start label2" onclick="signOut();"> </span>

                    <?php
                    }

                    ?>

                </div>

                <!-- <div class="col-12 col-lg-3 offset-lg-5 align-self-end" style="text-align: center;">

                    <div class="row ">

                        <div class="col-1 col-lg-2 mt-2">
                            <span class="text-start text-white label2"></span>
                        </div>

                        <div class="col-2 col-lg-5 dropdown d-none d-lg-block d-md-block">

                            <button class="btn btn-light  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                My eShop
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="http://localhost/myproject/userprofile.php">My Profile</a></li> -->
                <!-- <li><a class="dropdown-item" href="#">My Sellings</a></li> -->
                <!-- <li><a class="dropdown-item" href="http://localhost/myproject/myProducts.php">My Products</a></li>
                                <li><a class="dropdown-item" href="http://localhost/myproject/watchlist.php">Wish List</a></li> -->
                <!-- <li><a class="dropdown-item" href="#">Purchase History</a></li> -->
                <!-- <li><a class="dropdown-item" href="#">Messages</a></li> -->
                <!-- <li><a class="dropdown-item" href="http://localhost/myproject/addproduct.php">Add Product</a></li> -->
                <!-- </ul>
                        </div>

                        <div class="col-1 text-white col-lg-1 ms-2 ms-lg-0 mt-1 fs-4">
                            <a href=" http://localhost/myproject/cart.php"><i class="bi bi-cart-plus"></i></a>


                        </div>

                        <div class="col-1 text-white col-lg-3 ms-3 ms-lg-0 mt-1 fs-4">

                            <a href="#Serchdiv"><i class="bi bi-search"></i></a>

                        </div>




                    </div>
                </div> -->

            </nav>


        </div>
    </div>


    <script src="script.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="bootstrap.bundle.js"></script>
</body>

</html>