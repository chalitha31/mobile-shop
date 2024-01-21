<?php
session_start();
require "connection.php";
if(isset($_SESSION["a"])){
   $id = $_POST["id"];
   $fdate = $_POST["fdate"];
   $tdate = $_POST["tdate"];
   $qadd = '';
  
   

   if($id == '' &&  $fdate == '' && $tdate == ''){

    echo "none";

   }else{

    if($id != '' AND $fdate == '' AND $tdate == ''){
        $qadd = "WHERE `invoice`.`id` LIKE '%".$id."%' ";
      
    }else if($id == '' AND $fdate != '' AND $tdate == ''){
         $qadd = "WHERE `invoice`.`date` BETWEEN '".$fdate."' AND '".date("Y-m-d")."' ";
    }else if($id == '' AND $fdate == '' AND $tdate != ''){
        $qadd = "WHERE `invoice`.`date` BETWEEN '2022-07-01' AND '".$tdate."' ";
    }else if($id != '' AND $fdate != '' AND $tdate == '' ){
        $qadd = "WHERE `invoice`.`id` LIKE '%".$id."%' AND `invoice`.`date` BETWEEN '".$fdate."' AND '".date("Y-m-d")."'  ";
    }else if($id != '' AND $fdate == '' AND $tdate != ''){
        $qadd = "WHERE `invoice`.`id` LIKE '%".$id."%' AND `invoice`.`date` BETWEEN '2022-07-01' AND '".$tdate."'";
    }else if($id == '' AND $fdate != '' AND $tdate != ''){
      $qadd = "WHERE `invoice`.`date` BETWEEN '".$fdate."' AND '".$tdate."'  ";
    }else if($id != '' AND $fdate != '' AND $tdate != ''){
        $qadd = "WHERE `invoice`.`id` LIKE '%".$id."%' AND `invoice`.`date` BETWEEN '".$fdate."' AND '".$tdate."' ";
    }

    $q = "SELECT  `invoice`.`id`,`product`.`title`,`user`.`fname`,`user`.`lname`,`invoice`.`total`,`invoice`.`qty`,`invoice`.`status` FROM `invoice` JOIN `user` ON `invoice`.`user_email` = `user`.`email` JOIN `product` ON `product`.`id` = `invoice`.`product_id` ".$qadd."  ORDER BY `date` DESC";

    $rs = Database::search($q);
    $rsn = $rs->num_rows;
    if($rsn != 0){
       for($i= 0; $i < $rsn;$i++){
        $product_data = $rs->fetch_assoc();
           ?>
            <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-12" id="loadResults">

                                    <div class="row" id="box">

                                        <div class="col-1 bg-secondary text-end">
                                        <label class="form-label fs-5 fw-bold text-white"><?php echo $product_data["id"]; ?></label>
                                        </div>
                                        <div class="col-3 bg-body text-end">
                                            <label class="form-label fs-5 fw-bold text-dark"><?php echo $product_data["title"]; ?></label>
                                        </div>
                                        <div class="col-3 bg-secondary text-end">
                                            <label class="form-label fs-5 fw-bold text-white"><?php echo $product_data["fname"] . " " . $product_data["lname"]; ?></label>
                                        </div>
                                        <div class="col-2 bg-body text-end">
                                            <label class="form-label fs-5 fw-bold text-dark"><?php echo $product_data["total"]; ?></label>
                                        </div>
                                        <div class="col-1 bg-secondary text-end">
                                            <label class="form-label fs-5 fw-bold text-white"><?php echo $product_data["qty"] ?></label>
                                        </div>
                                  
                                        <div class="col-2 bg-white d-grid">
                                            <?php
                                            $x = $product_data["status"];
                                            if ($x == 0) {
                                            ?>
                                                <button class="btn  btn-success mb-2 mt-2 fw-bold" onclick="changeInvoiceId('<?php echo $product_data['id'] ?>');" id="btn<?php echo $product_data["id"]; ?>">
                                                    Confirm Order
                                                </button>
                                            <?php
                                            } else if ($x == 1) {
                                            ?>
                                                <button class="btn btn-warning mb-2 mt-2 fw-bold" onclick="changeInvoiceId('<?php echo $product_data['id'] ?>');" id="btn<?php echo $product_data["id"]; ?>">
                                                    Packing
                                                </button>
                                            <?php
                                            } else if ($x == 2) {
                                            ?>
                                                <button class="btn btn-info mb-2 mt-2 fw-bold" onclick="changeInvoiceId('<?php echo $product_data['id'] ?>');" id="btn<?php echo $product_data["id"]; ?>">
                                                    Dispatch
                                                </button>
                                            <?php
                                            } else if ($x == 3) {
                                            ?>
                                                <button class="btn btn-primary mb-2 mt-2 fw-bold" onclick="changeInvoiceId('<?php echo $product_data['id'] ?>');" id="btn<?php echo $product_data["id"]; ?>">
                                                    Shipping
                                                </button>
                                            <?php
                                            } else if ($x == 4) {
                                            ?>
                                                <button class="btn btn-danger mb-2 mt-2 fw-bold" onclick="changeInvoiceId('<?php echo $product_data['id'] ?>');" id="btn<?php echo $product_data["id"]; ?>" disabled>
                                                    Delivered
                                                </button>
                                            <?php
                                            }

                                            ?>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
           <?php
       }
    }
       


   }

 
}

?>