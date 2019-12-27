<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$data['result'] = false;

$mail_adr = "nuna@holb.co";

if (isset($_POST['mail']))
    $input_mail_adr = $_POST['mail'];
else {
    $data['msg'] = "Invalid Email";
    echo json_encode($data);
}

//Server settings
// $mail->SMTPDebug = 0;                                    // Enable verbose debug output
$mail->isSMTP();                                            // Set mailer to use SMTP
$mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'holb.co@gmail.com';                    // SMTP username
$mail->Password   = 'Holb9999';                             // SMTP password

$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
$mail->Port       = 587;                                    // TCP port to connect to

//Recipients
$mail->setFrom('TEAM@holb.co', 'House of Lookbook');
$mail->addAddress($mail_adr);     // Add a recipient

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'House of Lookbook';
$mail->Body    = $input_mail_adr . ' is succcessfully registered!';
$mail->AltBody = 'Congratulations!';

if ($mail->send()) {
    $data['result'] = true;
} else {
    $data['msg'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $data['result'] = false;
}

echo json_encode($data);

?>
