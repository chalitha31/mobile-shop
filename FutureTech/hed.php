<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="hed.css" />
    <link rel="icon" href="resources/Logo.png" />

</head>

<body>

    <header class="header ">
        <!-- <div class="col-6"> -->
        <a href="home.php" class="logo-head"></a>

        <span class="text-lg-start text-white label1 "><b>Wellcome</b>
            <a href="http://localhost/FutureTech/userprofile.php" style="text-decoration: none;" class="text-primary">

                <?php

                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];
                ?>

                    <?php echo $data["fname"]; ?>

                <?php
                } else {

                ?>
                    <a href="index.php">Sign In or Register </a>

                <?php

                }

                ?>
            </a>
        </span>

        <span class="text-lg-start text-white label2 d-none d-lg-block"> | Help and Contact </span>

        <?php
        if (isset($_SESSION["u"])) {
        ?>
            <span class="text-lg-start text-primary label2 d-none d-lg-block" onclick="signOut();"><u>&nbsp;Sign Out</u> </span>

        <?php

        } else {
        ?>
            <span class="text-lg-start label2 me-lg-5" onclick="signOut();"></span>

        <?php
        }

        ?>

        <!-- </div> -->

        <div class=" col-lg-7 d-flex justify-content-end offset-1">
            <nav class="navbar ">

                <a href="#hproducts">products</a>
                <!-- <a href="http://localhost/FutureTech/watchlist.php">Wish List</a> -->
                <a href="#Advanced">Advanced Search</a>
                <a href="http://localhost/FutureTech/watchlist.php">watchlist</a>
                <!-- <a href="http://localhost/FutureTech/purchaseHistory.php">purchase History</a> -->
                <!-- <a href="http://localhost/FutureTech/userprofile.php">My Profile</a> -->
                <a href="#hcontact">contact</a>
                <a href="#blogs">about</a>
                <a class="d-lg-none d-block" href="#blogs">signOut</a>
            </nav>

            <div class="icons d-flex  offset-lg-1">
                <a href="#Serchdiv" class="fas fa-search d-none d-lg-block" id="search-btn"></a>
                <a href=" http://localhost/FutureTech/cart.php" class="fas fa-shopping-cart fs-2" id="cart-btn" disabled></a>
                <a class="fas fa-bars" id="menu-btn"></a>
            </div>
        </div>
    </header>

    <script src="script.js"></script>
</body>

</html>