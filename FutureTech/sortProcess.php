<?php

session_start();
$user = $_SESSION["a"];
require "connection.php";


$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];



$query = "SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' ";
if ($condition == "1") {

    $query .= "AND `condition_id` = '1'";
} else if ($condition == "2") {
    $query .= "AND `condition_id` = '2' ";
} else if (!empty($search)) {
    $query .= "AND `title` LIKE '%" . $search . "%'";
} else if ($age == "1") {
    $query .= "ORDER BY `datetime_added` DESC";
} else if ($age == "2") {
    $query .= "ORDER BY `datetime_added` ASC";
} else if ($qty == "1") {
    $query .= "ORDER BY `qty` DESC";
} else if ($qty == "2") {
    $query .= "ORDER BY `qty` ASC";
}

$query1 = $query;


?>


<div class="row justify-content-center">
    <?php
    if (isset($_GET["page"])) {

        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $products = Database::search($query);
    $nProducts = $products->num_rows;
    $userProducts = $products->fetch_assoc();
    $results_per_page = 6;
    $number_of_pages = ceil($nProducts / $results_per_page);
    $page_first_result = ($pageno - 1) * $results_per_page;
    $selectedrs = Database::search($query1 . " LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");
    $rsn = $selectedrs->num_rows;
    for ($x = 0; $x < $rsn; $x++) {
        $p = $selectedrs->fetch_assoc();
    ?>

        <!-- Card 01 -->
        <div class="card mb-1 mt-3 col-12 col-lg-6">
            <div class="row ">
                <div class="col-md-4 mt-4">
                    <?php
                    $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $p["id"] . "'");
                    $pir = $pimgrs->fetch_assoc();

                    ?>
                    <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo $p["title"]; ?></h5>
                        <span class="card-text  fw-bold text-primary">Rs. <?php echo $p["price"]; ?></span>
                        <br />
                        <span class="card-text text-success fw-bold"><?php echo $p["qty"]; ?> Items Left </span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" role="switch" onclick="chngstatus(<?php echo $p['id'] ?>);" <?php
                                                                                                                                                                    if ($p["status_id"] == 2) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    }
                                                                                                                                                                    ?> />
                            <label class="form-check-label text-<?php if ($p["status_id"] == 2) {
                                                                    echo "danger";
                                                                } else {
                                                                    echo "info";
                                                                } ?> fw-bold" for="flexSwitchCheckChecked" id="checkLable<?php echo $p['id'] ?>">
                                <?php

                                if ($p["status_id"] == 2) {
                                    echo "Make Your Product Active";
                                } else {
                                    echo "Make Your Product Deactive";
                                }

                                ?>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <div class="row g-1">
                                    <div class="col-12 col-lg-6 d-grid">
                                        <a class="btn btn-success" onclick="sendId(<?php echo $p['id']; ?>);" href="#">Update</a>
                                    </div>
                                    <div class="col-12 col-lg-6 d-grid">
                                        <a class="btn btn-danger" onclick="hideProduct(<?php echo $p['id']; ?>);">Delete</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card 01 -->

    <?php
    }
    ?>

</div>
<div class="offset-lg-4 offset-2 col-8 col-lg-4 text-center mb-3">
    <div class="pagination">
        <?php
        if ($pageno <= 1) {
        ?>
            <a>&laquo;</a>
        <?php
        } else {
        ?>
            <a onclick="addFilters(<?php echo ($pageno - 1); ?>);">&laquo;</a>
        <?php

        }
        ?>

        <?php

        for ($page = 1; $page <= $number_of_pages; $page++) {
            if ($page == $pageno) {
        ?>
                <a onclick="addFilters('<?php echo $page ?>')" class="active"><?php echo $page ?></a>

            <?php
            } else {
            ?>
                <a onclick="addFilters('<?php echo $page ?>')"><?php echo $page ?></a>

        <?php
            }
        }

        ?>
        <?php
        if ($pageno >= $number_of_pages) {
        ?>
            <a>&raquo;</a>
        <?php
        } else {
        ?>
            <a onclick="addFilters('<?php echo ($pageno + 1); ?>')">&raquo;</a>
        <?php

        }
        ?>


    </div>
</div>