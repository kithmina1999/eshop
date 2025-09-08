<?php
include "connection.php";

include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

if (!empty($email)) {
    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
    $n = $rs->num_rows;
    if ($n == 0) {
        echo "Email address is invalid or not registered";
    } else {
        $code = uniqid();
        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        //email code
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rkksgunasinghe@gmail.com';
        $mail->Password = 'duzyrjlkqvgzxdjq'; //app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('rkksgunasinghe@gmail.com', 'Reset Password');
        $mail->addReplyTo('rkksgunasinghe@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'EShop Password Verification Code';
        $bodyContent = "<h1 style='color:rgb(72,71,71);'>Your Verification Code: .'$code'. </h1>";
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "success";
        }
    }
} else {
    echo "Please enter your registered email address";
}

