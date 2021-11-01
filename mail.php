<?php
require ('../db.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/OAuth.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/POP3.php';
    require '../PHPMailer/src/SMTP.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $hash = md5($email.date('Y-m-d'));

    $sql = "SELECT * FROM users where email='$email'";
    $query = mysqli_query($con,$sql);
    if(mysqli_num_rows($query) > 0){
        echo '<script>alert("Email sudah terdaftar");</script>';
    }else {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'companytest19@gmail.com';
        $mail->Password = 'thisisatest';
        $mail->setFrom('no-reply@yourwebsite.com', 'Your website service');
        $mail->addAddress($email, $nama);
        $mail->Subject = 'Verification Account - FreshMart';

        $body = "Hi, ".$nama."<br>Klik disini untuk aktivasi akun : <br> https://fresh-mart.xyz/aktivasi.php?hash=".$hash;
        $mail->Body = $body;
        $mail->AltBody = 'Verification Account';
        if (!$mail->send()) {
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            echo 'Register sukses silahkan login !';
        }

    }
    ?>