<?php
include "connection.php";

$email = $_POST["e"];
$password = $_POST["np"];
$confirmPassword = $_POST["cnp"];
$verificationCode = $_POST["vc"];

if (empty($email)) {
    echo "Email address is required";
} else if (empty($password)) {
    echo "New password is required";
} else if (strlen($password) < 8) {
    echo "Password is too short, minimum length is 8 characters";
} else if (strlen($password) > 20) {
    echo "Password is too long, maximum length is 20 characters";
} else if (empty($confirmPassword)) {
    echo "Confirm password is required";
} else if ($password != $confirmPassword) {
    echo "Passwords do not match";
} else if (empty($verificationCode)) {
    echo "Verification code is required";
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `verification_code`='" . $verificationCode . "'");
    $n = $rs->num_rows;
    if ($n === 1) {
        Database::iud("UPDATE `user` SET `password`='" . $password . "', `code`=NULL WHERE `email`='" . $email . "' AND `verification_code`='" . $verificationCode . "'");
        echo "success";
    } else {
        echo "No user found. Invalid email or verification code";
    }

}
