<?php
use PHPMailer\PHPMailer\PHPMailer;



if(isset($_POST['name'])&&isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $assunto = $_POST['message'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = YourEmailHere;
    $mail->Password = YourPasswordHere;
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //Email settings
    $mail->isHTML(true);
    $mail->setFrom($email,$name);
    $mail->addAddress("smartmealinfo4@gmail.com");
    $mail->Subject = ("$email('SmartmealHELP')");
    $mail->Body = $assunto;

    if($mail->send()){
        header('Location:index.php?verifyemail=1');
    }else{
        header('Location:index.php?failemail=1');
    }


}

?>
