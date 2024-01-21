<?php
require "connection.php";
session_start();
if (isset($_SESSION["a"]) && isset($_GET["id"])) {
    $id = $_GET["id"];
    $email = $_SESSION["a"]["email"];
    $rs = Database::search("SELECT * FROM `message` WHERE  (`from` = '" . $email . "' AND `to` = '" . $id . "') OR (`from` = '" . $id . "' AND `to` = '" . $email . "')  ORDER BY `date_time` ASC  ");
    $rsn = $rs->num_rows;

    for ($i = 0; $i < $rsn; $i++) {
        $message_data = $rs->fetch_assoc();
        $date_time = $message_data["date_time"];
        $target = explode(" ", $date_time);
        $date = $target[0];
        $time = $target[1];
        $target2 = explode(":", $time);
        $hr_min = $target2[0] . ":" . $target2[1];

        if ($message_data["from"] == $email and $message_data["to"]  == $id) {

?>

            <!-- Sent -->
            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-8 offset-4 bg-success rounded">
                        <div class="row">
                            <div class="col-12 pt-2">
                                <span class="text-white fs-4"><?php echo $message_data["content"]; ?></span>
                            </div>
                            <div class="col-12 text-end pb-3">
                                <span class="text text-white  fs-6"><?php echo $date; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sent -->
        <?php
        } else if ($message_data["to"] == $email and $message_data["from"]  == $id) {

        ?>
            <!-- receved -->
            <div class="col-12 mt-2">
                <div class="row">
                    <div class="col-8 bg-success rounded">
                        <div class="row">
                            <div class="col-12 pt-2">
                                <span class="text-white fs-4"><?php echo $message_data["content"]; ?></span>
                            </div>
                            <div class="col-12 text-end pb-3">
                                <span class="text text-white fs-6"><?php echo $date; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- receved -->
<?php

        }
    }
}



?>