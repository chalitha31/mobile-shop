<?php
require "connection.php";
session_start();
if (isset($_SESSION["u"])) {
?>

    <html>

    <head>

        <title>The Mobile sHop | Add Product</title>
        <link rel="icon" href="resources/Logo.png" />

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>


    <body>
        <div class="container-fluid">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="col-12 mb-2">

                        <h3 class="h2  text-center text-primary">Product Listing</h3>

                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <span class="text-danger h5" id="msg"></span>
                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Category</label>
                                        &nbsp;<i class="bi bi-plus-circle " style="cursor: pointer;" onclick="addCbm();"></i>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="ca">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $rs = Database::search("SELECT * FROM `category`");
                                            $n = $rs->num_rows;
                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();
                                            ?>

                                                <option value="<?php echo $d["id"]; ?>"><?php echo  $d["name"]; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>


                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Brand</label>
                                        &nbsp;<i class="bi bi-plus-circle " style="cursor: pointer;" onclick="addCbm();"></i>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="br">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $rs = Database::search("SELECT * FROM `brand`");
                                            $n = $rs->num_rows;
                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();
                                            ?>

                                                <option value="<?php echo $d["id"]; ?>"><?php echo  $d["name"]; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>


                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Model</label>
                                        &nbsp;<i class="bi bi-plus-circle " style="cursor: pointer;" onclick="addCbm();"></i>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="mo">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $rs = Database::search("SELECT * FROM `model`");
                                            $n = $rs->num_rows;
                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();
                                            ?>

                                                <option value="<?php echo $d["id"]; ?>"><?php echo  $d["name"]; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>


                                </div>
                            </div>

                            <hr class="hr-beak-1">

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add a Title to Your Product</label>
                                    </div>
                                    <div class="offset-lg-2 col-12 col-lg-8">
                                        <input class="form-control" type="text" id="ti" />
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-beak-1" />

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Select Product Condition</label>
                                            </div>
                                            <div class="form-check offset-1 col-11 col-lg-3 ms-5">
                                                <input class="form-check-input" type="radio" name="flexRadioDefaul" id="bn" checked />
                                                <label class="form-check-label" for="bn">
                                                    Brand New
                                                </label>
                                            </div>
                                            <div class="form-check offset-1 col-11 col-lg-3 ms-5">
                                                <input class="form-check-input" type="radio" name="flexRadioDefaul" id="us" />
                                                <label class="form-check-label" for="us">
                                                    used
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Select Product Color</label>
                                                &nbsp;<i class="bi bi-plus-circle " style="cursor: pointer;" onclick="addCbm();"></i>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4 ">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="clr1" checked />
                                                    <label class="form-check-label" for="clr1">
                                                        Gold
                                                    </label>
                                                </div>
                                                <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4 ">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="clr2" />
                                                    <label class="form-check-label" for="clr2">
                                                        Silver
                                                    </label>
                                                </div>
                                                <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4 ">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="clr3" />
                                                    <label class="form-check-label" for="clr3">
                                                        Graphite
                                                    </label>
                                                </div>
                                                <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4 ">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="clr4" />
                                                    <label class="form-check-label" for="clr4">
                                                        Pasific Blue
                                                    </label>
                                                </div>
                                                <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4 ">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="clr5" />
                                                    <label class="form-check-label" for="clr5">
                                                        Gradient
                                                    </label>
                                                </div>
                                                <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4 ">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="clr6" />
                                                    <label class="form-check-label" for="clr6">
                                                        Gradient
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <label class="form-label lbl1">Add Product Quantity</label>
                                            <input class="form-control" type="number" value="0" min="0" id="qty" />
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <hr class="hr-beak-1">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Cost Per Item</label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="cost">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Approved Payment Methods</label>
                                            </div>
                                            <div class="col-9">
                                                <div class="row">
                                                    <div class="offset-2 col-1 pm1"></div>
                                                    <div class="offset-2 col-1 pm2"></div>
                                                    <div class="offset-2 col-1 pm3"></div>
                                                    <div class="offset-2 col-1 pm4"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="hr-beak-1" />

                            <div class="col-12 col-lg-6">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Delivery Cost</label>
                                    </div>
                                    <div class="col-12 col-lg-3 offset-lg-1">
                                        <label class="form-label ">Delivery Cost Within Colombo</label>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="dwc">
                                            <span class="input-group-text ">.00</span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row mt-lg-4">
                                    <div class="col-12"></div>

                                    <div class="col-12 col-lg-3 mt-3 offset-lg-1">
                                        <label class="form-label ">Delivery Cost out of colombo</label>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="input-group mb-3  mt-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="doc">
                                            <span class="input-group-text ">.00</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <hr class="hr-beak-1" />
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Product Description</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" cols="25" rows="20" id="desc"></textarea>
                                </div>
                            </div>
                            <hr class="hr-beak-1" />
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add Product Image</label>
                                    </div>

                                    <div class="col-12">

                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thmbnail addimg" id="prev1" />
                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thmbnail addimg" id="prev2" />
                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thmbnail addimg" id="prev3" />

                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-12 col-lg-12 mt-2 ms-2 ">

                                                <input type="file" class="d-none" accept="img/*" id="imageUploder1" />
                                                <label for="imageUploder1" class="col-12 col-lg-2 btn btn-primary" onclick="changeProductImg1();">Upload</label>

                                                <input type="file" class="d-none" accept="img/*" id="imageUploder2" />
                                                <label for="imageUploder2" class="ms-3 col-12 col-lg-2 btn btn-primary" onclick="changeProductImg2();">Upload</label>

                                                <input type="file" class="d-none" accept="img/*" id="imageUploder3" />
                                                <label for="imageUploder3" class="ms-2 col-12 col-lg-2 btn btn-primary" onclick="changeProductImg3();">Upload</label>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <hr class="hr-beak-1" />
                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label><br />
                    <label class="form-label">We are taking 5% of The Product From Every Products's Price</label>
                </div>

                <div class="col-12 col-lg-4 offset-lg-4 d-grid mb-2">
                    <button class="btn btn-success" onclick="addProduct();">Add Product</button>
                </div>
                <?php

                require "foo.php";

                ?>
            </div>


        </div>



        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {

?>
    <script>
        alert("You Have To Sign In Or register First");
        window.location = "index.php";
    </script>
<?php

}
?>