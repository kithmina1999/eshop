<?php
session_start();
include "connection.php";

$email = $_SESSION["u"]["email"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$province = $_POST["pv"];
$district = $_POST["dt"];
$city = $_POST["ct"];
$pcode = $_POST["pc"];



$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
if ($user_rs->num_rows == 1) {
    Database::iud("UPDATE `user` SET `fname`='" . $fname . "', `lname`='" . $lname . "', `mobile`='" . $mobile . "' WHERE `email`='" . $email . "'");

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'");

    if ($address_rs->num_rows == 1) {
        Database::iud("UPDATE `user_has_address` SET `city_city_id`= '" . $city . "', `line_01`='" . $line1 . "', `line_02`='" . $line2 . "', `postal_code`='" . $pcode . "' WHERE `user_email`='" . $email . "'");

    } else {
        Database::iud("INSERT INTO `user_has_address` (`user_email`,`city_city_id`,`line_01`,`line_02`,`postal_code`) VALUES ('" . $email . "','" . $city . "','" . $line1 . "','" . $line2 . "','" . $pcode . "')");

    }
    //iamge uplaoding
    if (sizeof($_FILES) == 1) {
        $img = $_FILES["pi"];
        $img_extension = $img["type"];
        $allowed_img_extensions = array("image/jpeg", "image/png", "image/jpg", "image/svg+xml");
        if (in_array($img_extension, $allowed_img_extensions)) {
            $new_img_extension;

            if ($img_extension == "image/jpeg") {
                $new_img_extension = ".jpeg";
            } else if ($img_extension == "image/png") {
                $new_img_extension = ".png";
            } else if ($img_extension == "image/jpg") {
                $new_img_extension = ".jpg";
            } else if ($img_extension == "image/svg+xml") {
                $new_img_extension = ".svg";
            }
            $filename = "resource/profile_images/" . $fname . "_" . uniqid() . $new_img_extension;
            move_uploaded_file($img["tmp_name"], $filename);

            $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

            if ($img_rs->num_rows == 1) {
                Database::iud("UPDATE `profile_img` SET `path`='" . $filename . "' WHERE `user_email`='" . $email . "'");
                echo "success";
            } else {
                Database::iud("INSERT INTO `profile_img` (`user_email`,`path`) VALUES ('" . $email . "','" . $filename . "')");
                echo "success";
            }
        }

    } else if (sizeof($_FILES) == 0) {
        echo "You have not selected a profile picture";
    } else {
        echo "you must select only one profile picture";
    }
} else {
    echo "Invalid user";

}


