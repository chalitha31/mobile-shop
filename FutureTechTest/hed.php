 <?php

    session_start();
    require "connection.php";

    ?>
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
     <link rel="icon" href="resources/logotcNor.jpg" />

 </head>

 <body>

     <header class="header ">


         <div class="col-12 col-lg-12">
             <div class="row">


                 <div class="col-5 col-lg-2 d-flex align-items-center ">

                     <a href="home.php" class="logo-head"></a>&nbsp;



                 </div>

                 <div class="col-lg-8 col-2 justify-content-center d-flex ">

                     <nav class="navbar">

                         <a href="#hproducts">products</a>
                         <!-- <a href="http://localhost/myproject/watchlist.php">Wish List</a> -->
                         <!-- <a href="#Advanced">Advanced Search</a> -->
                         <!-- <a href="http://localhost/FutureTechTest/watchlist.php">watchlist</a> -->
                         <a href="#">watchlist</a>
                         <!-- <a href="http://localhost/myproject/purchaseHistory.php">purchase History</a> -->
                         <!-- <a href="http://localhost/myproject/userprofile.php">My Profile</a> -->
                         <a href="#hcontact">contact</a>
                         <a href="#blogs">about</a>
                         <!-- <a class="d-lg-none d-block" href="#blogs">signOut</a> -->
                     </nav>


                 </div>

                 <div class="col-lg-2 col-5 icons align-items-center justify-content-end d-flex ">

                     <a href="#Serchdiv" class="fas fa-search d-none d-lg-block" id="search-btn"></a>
                     <!-- <a href="http://localhost/FutureTechTest/cart.php" class="fas fa-shopping-cart fs-2" id="cart-btn"></a> -->
                     <a class="fas fa-shopping-cart fs-2" id="cart-btn"></a>

                     <?php
                        if (isset($_SESSION["u"])) {
                            $dat = $_SESSION["u"];


                            $Drs = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '" . $dat["email"] . "'");
                            $n = $Drs->num_rows;

                            if ($n == 1) {
                                $imgg = $Drs->fetch_assoc();
                        ?>

                             <a><img id="user-btn" class="hedprofile" src="<?php echo $imgg["code"] ?>"></a>

                         <?php
                            } else {
                            ?>

                             <a><img id="user-btn" class="hedprofile" src="resources/profiles/profile.jpeg"></a>

                         <?php
                            }
                        } else {
                            ?>
                         <a><img id="user-btn" class="hedprofile" src="resources/profiles/profile.jpeg"></a>

                     <?php
                        }
                        ?>

                     <a class="fas fa-bars" id="menu-btn"></a>

                 </div>

                 <!-- login div -->

                 <div class="col-lg-3 col-10 login-form text-center">

                     <h5 class="lh3">Welcome to Future Tech</h5>

                     <?php
                        if (isset($_SESSION["u"])) {
                            $data = $_SESSION["u"];
                        ?>

                         <span class="mt-2 fs-3">
                             <?php echo $data["fname"] . " " . $data["lname"]  ?>
                         </span>

                         <br>
                         <span class="mt-2 fs-6"> <?php echo $data["email"]; ?></span>

                         <br>

                         <a href="http://localhost/FutureTechTest/userprofile.php"><button class="box1 fs-5 mx-3  mt-2">View Profile</button></a>

                         <a onclick="signOut();"><button class="box2 fs-5  mt-2">Sign Out</button></a>

                     <?php
                        } else {
                        ?>
                         <span class="fs-5">Hello,New User!</span><br>
                         <span class="fs-3">..............</span>

                         <br>

                         <a style="padding: 50px;" href="index.php"><button class="box1 fs-5 mt-2">Sign In Or Register</button></a>

                     <?php
                        }


                        ?>


                     <!-- <input type="submit" value="Sign out" class="box2 mt-2 mx-3" onclick=" signOut();"> -->



                 </div>

                 <!-- login div -->

             </div>
         </div>


     </header>

     <script src="script.js"></script>
 </body>

 </html>