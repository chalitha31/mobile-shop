<?php
session_start();
require "connection.php";
// require 'vendor/autoload.php';
include 'stripe-php-master/init.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('your_api_key');



header('Content-Type: application/json');

$DOMAIN = 'http://localhost/FutureTech';
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

for ($y = 0; $y <  $_SESSION["num"]; $y++) {

    $rs =   Database::search("SELECT * FROM `product` JOIN `images` ON `images`.`product_id` = `product`.`id` WHERE `id` = '" . $_SESSION["buy"]["id" . $y] . "' ");
    $data = $rs->fetch_assoc();
    $amount = ($data["price"] * $_SESSION["buy"]["qty" . $y]);
    // $amount = $_SESSION["total"];
    Database::iud("INSERT INTO `payment_request`(`product_id`,`qty`,`date_time`,`user_email`,`amount`) VALUES('" . $_SESSION["buy"]["id" . $y] . "','" . $_SESSION["buy"]["qty" . $y] . "','" . $date . "','" . $_SESSION["u"]["email"] . "','" . $amount . "') ");
    $last_id = Database::$connection->insert_id;
    $last_enter = strval($last_id);

    $checkout_session = \Stripe\Checkout\Session::create([

        'payment_method_types' => ['card'],
        'shipping_options' => [
            [
                'shipping_rate_data' => [
                    'type' => 'fixed_amount',
                    'fixed_amount' => [
                        'amount' =>  $_SESSION["buy"]["shipping"] * 100,
                        'currency' => 'lkr',
                    ],
                    'display_name' => 'Free shipping',
                    // Delivers between 5-7 business days
                    'delivery_estimate' => [
                        'minimum' => [
                            'unit' => 'business_day',
                            'value' => 5,
                        ],
                        'maximum' => [
                            'unit' => 'business_day',
                            'value' => 7,
                        ],
                    ]
                ]
            ],
        ],
        'line_items' => [[

            'price_data' => [
                'currency' => 'lkr',
                'unit_amount' => $data["price"] * 100,
                'product_data' => [
                    'name' => "Total",

                ],
            ],
            'quantity' => $_SESSION["buy"]["qty" . $y],
        ]],
        'phone_number_collection' => [
            'enabled' => true,
        ],
        'mode' => 'payment',
        'success_url' => $DOMAIN . "/cartsuccess.php?payment_id={CHECKOUT_SESSION_ID}&req_id=" . $last_enter,
        'cancel_url' => $DOMAIN . '/cancel.php?payment_id={CHECKOUT_SESSION_ID}',
    ]);
}

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
