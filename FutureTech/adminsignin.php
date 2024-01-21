<?php
session_start();
require "connection.php";
$d = Database::search("SELECT * FROM `admin` WHERE `email` = 'robert@gmail.com'");
$rs = $d->fetch_assoc();
$_SESSION["a"] = $rs;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>The Mobile sHop | admin Panel Log in</title>
    <link rel="icon" href="resources/Logo.png" />

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <title>eShop | Admin Sign in</title>
    <!-- <link rel="stylesheet" href="bootstrap.css" /> -->
    <!-- / <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet" href="adminsign.css" />

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" /> -->





</head>

<body>




    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMIN PANEL
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">

                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input type="text" id="email" class="form-control">
                        </div>
                        <div class="form-group adminpwBl" id="adminpwfield">
                            <label class="form-control-label">Enter The Verification Code That Was sent to your email</label>
                            <input type="text" class="form-control" id="vscode" disabled style="background-color:transparent">
                        </div>

                        <div class="col-lg-12 loginbttm p-0">

                            <div class="col-12 col-lg-5 login-btm back-button">
                                <a href="index.php" class="col-12 btn btn-danger text-white text-center">Back to Customer Login</a>
                            </div>

                            <div class="col-12 col-lg-6 login-btm login-button">
                                <button id="sendlogin" onclick="adminVerification();" class=" btn btn-outline-primary">Send Verification Code to login</button>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>

    </div>

    <!-- modal -->
    <!-- <div class="modal" id="veificationModel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Admin Verification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Enter The Verification Code That Was sent to your email</label>
                    <input type="text" class="form-control" id="vscode">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="verify();">Sign In</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- modal -->

    <!-- <script src="bootstrap.js"></script> -->
    <script src="script.js"></script>
</body>

</html>