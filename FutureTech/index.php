<?php
session_start();

if (isset($_COOKIE["email"])  && isset($_SESSION["u"])) {

?>

    <script>
        // alert("You Have To Sign In Or register First");
        window.location = "home.php";
    </script>

<?php

} else {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>The Mobile sHop | index</title>
        <link rel="icon" href="resources/Logo.png" />

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="style1.css" />



    </head>

    <body>

        <div class="section">

            <div class="container vh-100 d-flex justify-content-center">

                <div class="row  align-item-center">

                    <!-- <div class="col-12 logo1"></div> -->

                    <div class="col-12 py-5">
                        <div class="section pb-5 pt-2 pt-sm-2 text-center ">

                            <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>

                            <input class="checkbox " type="checkbox" id="reg-log" name="reg-log" />
                            <label for="reg-log" onclick="changeView();" id="change"></label>

                            <!-- Sign In -->

                            <div class="card-3d-wrap mx-4">
                                <div class="card-3d-wrapper">
                                    <div class="card-front ">
                                        <div class="center-wrap" id="signInBox">
                                            <div class="section text-center">

                                                <h4 class="mb-4 pb-3">Log In</h4>

                                                <?php


                                                $email = "";
                                                $password = "";

                                                if (isset($_COOKIE["email"])) {
                                                    $email = $_COOKIE["email"];
                                                }

                                                if (isset($_COOKIE["password"])) {
                                                    $password = $_COOKIE["password"];
                                                }

                                                ?>

                                                <span class="text-danger span" id="Sem"></span>

                                                <div class="form-group mb-3">
                                                    <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="email2" value="<?php echo $email; ?>">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>

                                                <span class="text-danger span" id="Sp"></span>

                                                <div class="form-group mb-3">
                                                    <div class="popup" onmouseover="capsLock3();">
                                                        <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="SiPassword" value="<?php echo $password; ?>">
                                                        <i class="input-icon uil uil-lock-alt"></i>
                                                        <span class="popuptext" id="myPopup1">𝗪𝗔𝗥𝗡𝗜𝗡𝗚!!..𝙲𝚊𝚙𝚜𝙻𝚘𝚌𝚔 𝚒𝚜 𝙾𝙽.</span>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row align-items-start mt-3 ">
                                                        <div class="col-6  p-0 ">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" value="1" id="rememberMe" />
                                                                <label class="form-check-label">Remember Me</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6 p-0 ">
                                                            <p class=" text-center"><a href="#" class="link">Forgot your password?</a></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="adminsignin.php" class="abtn mt-5">admin Sign in</a>

                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                <a href="#" class="btn  " onclick="signIn();">submit</a>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sign In -->

                                    <!-- Sign up -->

                                    <div class="col-12  card-back" style="height:600px;">
                                        <div class="center-wrap d-none" id="signUpBox">
                                            <div class="section text-center">

                                                <form id="signUpreset">

                                                    <h4 class="mb-2 pb-2 mb-3">Sign Up</h4>

                                                    <span class="text-danger  span" id="fn"></span>

                                                    <div class=" form-group mb-3">
                                                        <input type="text" name="logname" class="form-style" placeholder="First Name" id="fname" autocomplete="off">
                                                        <i class="input-icon uil uil-user"></i>
                                                    </div>

                                                    <span class="text-danger  span" id="ln"></span>

                                                    <div class="form-group mb-3">
                                                        <input type="text" name="logname" class="form-style" placeholder="Last Name" id="lname" autocomplete="off">
                                                        <i class="input-icon uil uil-user"></i>
                                                    </div>

                                                    <span class="text-danger  span" id="em"></span>

                                                    <div class="form-group mb-3">
                                                        <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="email" autocomplete="off">
                                                        <i class="input-icon uil uil-at"></i>
                                                    </div>

                                                    <span class="text-danger  span" id="p"></span>

                                                    <div class="col-12 form-group mb-3 mb-3 ">
                                                        <div class="popup" onmouseover="capsLock3();">
                                                            <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="password" autocomplete="off">
                                                            <i class="input-icon uil uil-lock-alt"></i>
                                                            <span class="popuptext" id="myPopup2">𝗪𝗔𝗥𝗡𝗜𝗡𝗚!!..𝙲𝚊𝚙𝚜𝙻𝚘𝚌𝚔 𝚒𝚜 𝙾𝙽.</span>
                                                        </div>
                                                    </div>

                                                    <span class="text-danger  span" id="rp"></span>

                                                    <div class="col-12 form-group mb-3">
                                                        <div class="popup" onmouseover="capsLock3();">
                                                            <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="Rpassword" autocomplete="off">
                                                            <i class="input-icon uil uil-lock-alt"></i>
                                                            <span class="popuptext" id="myPopup3">𝗪𝗔𝗥𝗡𝗜𝗡𝗚!!..𝙲𝚊𝚙𝚜𝙻𝚘𝚌𝚔 𝚒𝚜 𝙾𝙽.</span>
                                                        </div>
                                                    </div>

                                                    <span class="text-danger  span" id="mo"></span>

                                                    <div class="col-12 mb-3">
                                                        <div class="row ">
                                                            <div class="col-6 form-group border-end">
                                                                <input type="text" name="logname" class="form-style" placeholder="Mobile" id="mobile" autocomplete="off">
                                                                <i class="input-icon uil uil-user"></i>
                                                            </div>

                                                            <div class="col-6  form-group">
                                                                <span><i class=" input-icon bi bi-gender-ambiguous"></i></span>
                                                                <select class="form-select form-style" id="gender">
                                                                    <option>Gender</option>

                                                                    <?php

                                                                    require "connection.php";

                                                                    $r = Database::search("SELECT * FROM `gender`");
                                                                    $n = $r->num_rows;

                                                                    for ($x = 0; $x < $n; $x++) {
                                                                        $d = $r->fetch_assoc();

                                                                    ?>

                                                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                                                    <?php
                                                                    }

                                                                    ?>

                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <a href="#" class="btn mt-4" onclick="signUp();">submit</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sign up -->

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>


    </body>

    </html>

<?php

}

?>