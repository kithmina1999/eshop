<?php
include("connection.php");

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

if (empty($fname)) {
    echo "First name is required";
} else if (strlen($fname) > 50) {
    echo "First name is too long, maximum length is 50 characters";
} else if (empty($lname)) {
    echo "Last name is required";
} else if (strlen($lname) > 50) {
    echo "Last name is too long, maximum length is 50 characters";
} else if (empty($email)) {
    echo "Email address is required";
} else if (strlen($email) > 100) {
    echo "Email address is too long, maximum length is 100 characters";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
} else if (empty($password)) {
    echo "Password is required";
} else if (strlen($password) < 8) {
    echo "Password is too short, minimum length is 8 characters";
} else if (strlen($password) > 20) {
    echo "Password is too long, maximum length is 20 characters";
} else if (empty($mobile)) {
    echo "Mobile number is required";
} else if (!preg_match('/^07[01245678][0-9]{7}$/', $mobile)) {
    echo 'Invalid mobile number, it should be 10 digits with valid Sri Lankan format';
} else if (empty($gender)) {
    echo 'Please select a gender';
} else {
    //DB process
    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' OR `mobile`='" . $mobile . "'");
    $n = $rs->num_rows;
    if ($n > 0) {
        echo "User with this email or mobile number already exists";
        exit;
    } else {
        //time and date
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $date = $d->setTimezone($tz)->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`email`,`fname`,`lname`,`password`,`mobile`,`joined_date`,`status_id`,`gender_id`) VALUES ('" . $email . "','" . $fname . "','" . $lname . "','" . $password . "','" . $mobile . "','" . $date . "','1','" . $gender . "') ");
        echo 'success';
    }


}

?>