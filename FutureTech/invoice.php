<?php

require "connection.php";
if (isset($_GET["order_id"])) {
  $order_id = $_GET["order_id"];

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Mobile sHop | invoice</title>
    <link rel="icon" href="resources/Logo.png" />
    <link rel="styesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
  </head>

  <body>
    <div class="container-fluid mt-5">
      <div class="row">
        <?php require "Heder.php"; ?>
        <div class="col-12">
          <hr />
        </div>
        <div class="col-12 btn-toolbar justify-content-end">
          <button class="btn btn-dark me-2" onclick="printInvoice();">
            <i class="bi bi-printer-fill"></i>Print
          </button>
          <button onclick="downloadPdf()" class="btn btn-danger me-2">
            <i class="bi bi-file-pdf-fill"></i>Export as PDF
          </button>
        </div>
        <div class="col-12">
          <hr />
        </div>
        <div class="col-12" id="page">

          <div class="row">
            <div class="col-6">
              <div class="ms-5 invoiceheaderImg"></div>
            </div>
            <div class="col-6">
              <div class="row">
                <div class="col-12 text-primary text-decoration-underline text-end">
                  <h2>The Mobile Shop</h2>
                </div>
                <div class="col-12 fw-bold text-end">
                  <span>Maradana Colombo 12, Sri Lnaka</span><br />
                  <span>+94 11211212</span><br />
                  <span>theMobileShop@hotmail.com</span><br />
                </div>
              </div>
            </div>
            <div class="col-12">
              <hr class="border border-1 border-primary">
            </div>
            <div class="col-12">
              <div class="row">
                <div class="col-6">
                  <h5>Invoice To :</h5>
                  <h5 class="mb-2 fs-2"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?> </h5>

                  <?php
                  $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON `user_has_address`.`city_id` = `city`.`id` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
                  $address_data = $address_rs->fetch_assoc();

                  ?>
                  <span><?php echo $address_data["line1"] . " , " . $address_data["line2"] . " , " . $address_data["name"];  ?>, </span>
                  <span><?php echo $_SESSION["u"]["email"]; ?></span>
                </div>
                <div class="col-6 text-end mt-4">
                  <h1 class="text-primary">Invoice 01</h1>
                  <span class="fw-bold">Date & time of invoice: </span> &nbsp;
                  <?php
                  $order_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $order_id . "' ");
                  $order_data = $order_rs->fetch_assoc();

                  ?>
                  <span class="fw-bold"><?php echo $order_data["date"]; ?> </span>
                </div>
              </div>

            </div>
            <div class="col-12">
              <table class="table">
                <thead>
                  <tr class="border border-1 border-white">
                    <th>
                      #
                    </th>
                    <th>
                      Order ID & Product
                    </th>
                    <th class="text-end">
                      Unit Price
                    </th>
                    <th class="text-end">
                      Quantity
                    </th>
                    <th class="text-end">
                      Total
                    </th>
                  </tr>
                </thead>

                <tbody>
                  <tr style="height: 72px;">
                    <td class="bg-primary text-white fs-3"><?php echo $order_data["id"]; ?></td>
                    <td>
                      <span class="fw-bold p-2 text-primary text-decoration-underline"><?php echo $order_data["order_id"]; ?></span><br />
                      <span class="fw-bold p-2 fs-3 text-primary"><?php
                                                                  $result = Database::search("SELECT * FROM `product` WHERE `id` = '" . $order_data["product_id"] . "'  ");
                                                                  $result_data = $result->fetch_assoc();
                                                                  echo $result_data["title"];
                                                                  ?></span>
                    </td>
                    <td class="fs-6 text-end pt-3 bg-secondary text-white">Rs <?php echo $result_data["price"]; ?>.00</td>
                    <td class="fs-6 text-end pt-3 "><?php echo $order_data["qty"]; ?></td>
                    <td class="fs-6 text-end bg-primary text-white">Rs <?php echo $order_data["total"] ?>.00</td>

                  </tr>
                </tbody>

                <tfoot>
                  <tr>
                    <td colspan="3" class="border-0"></td>
                    <td class="fs-5 text-end">SUBTOTAL</td>
                    <td class="text-end">Rs.<?php echo $order_data["total"] ?>.00</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="border-0"></td>
                    <td class="fs-5 text-end border-primary">Discount</td>

                    <td class="text-end border-primary">Rs. <?php
                                                            $discount = 0;
                                                            if ($order_data["total"] > 250000) {
                                                              $discount = ($order_data["total"] / 100) * 1;
                                                              echo $discount;
                                                            } else if ($order_data["total"] > 500000) {
                                                              $discount = ($order_data["total"] / 100) * 2;
                                                              echo $discount;
                                                            } else if ($order_data["total"] > 1000000) {
                                                              $discount = ($order_data["total"] / 100) * 5;
                                                              echo $discount;
                                                            }
                                                            ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="border-0"></td>
                    <td class="fs-5 text-end border-primary  text-primary fw-bold ">GRAND TOTAL</td>
                    <td class="text-end border-primary text-primary fs-5 fw-bold">Rs.<?php echo $order_data["total"] - $discount ?></td>
                  </tr>

                </tfoot>

              </table>
            </div>
            <div class="col-8 text-start" style="margin-top: -100px;">
              <span class="fs-1 fw-bold text-success">Thank You!</span>
            </div>
            <div class=" col-12 mt-3 mb-3 border border-5 border-primary border-start  border-bottom-0 border-top-0 border-end-0 rounded" style="background-color: #e7f2ff;">
              <div class="row">
                <div class="col-12 mt-3 mb-3">
                  <label class="form-label fs-5 fw-bold">
                    Notice :
                  </label>
                  <label class="form-label fs-6 ">
                    Purchased Items can return befor 7 days of Delivery.
                  </label>
                </div>
              </div>
            </div>

            <div class="col-12">
              <hr class="border border-1 border-primary" />
            </div>

            <div class="col-12 mb-3 text-center">
              <label class="form-label fs-5 text-black-50 fw-bold">Invoice was Creaed on a computer and is valid without the signature and seal</label>
            </div>
          </div>
        </div>

        <?php require "foo.php" ?>
      </div>
    </div>
  </body>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
  <script src="script.js"></script>

  </html>

<?php
}

?>