<?php
include "connection.php";

$email = $_GET["e"];

if (!empty($email)) {
    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
    $n = $rs->num_rows;
    if ($n == 0) {
        echo "Email address is invalid or not registered";
    } else {
        $validation_code = rand(100000, 999999);
    }
} else {
    echo "Please enter your registered email address";
}

