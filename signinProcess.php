<?php
include "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$remembarMe = $_POST["r"];

if (empty($email)) {
    echo "Email address is required";
} else if (empty($password)) {
    echo "Password is required";
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $n = $rs->num_rows;
    if ($n == 0) {
        echo "Invalid email or password";
    } else {
        $data = $rs->fetch_assoc();
        if ($data["status_id"] == 1) {
            $_SESSION["u"] = $data;
            session_start();
            if ($remembarMe == 1) {
                setcookie("email", $data["email"], time() + 60 * 60 * 24 * 30,);
                setcookie("password", $data["password"], time() + 60 * 60 * 24 * 30,);
            }else{
                setcookie("email", "", -1, );
                setcookie("password", "", -1, );
            }
            echo "success";
        } else {
            echo "Your account is disabled. Please contact support.";
        }
    }
}










