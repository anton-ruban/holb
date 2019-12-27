<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Holb - House of Lookbook</title>

    <link rel="stylesheet" type="text/css" href="css/fonts.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
    <div class="brief">
        2/<b>3</b>&nbsp;&nbsp;YOUR HOLB PROJECT

        <span class="brief-summary">SENDING MAIL</span>
    </div>

    <div class="logout">
        <span class="s_username"><?php echo $_SESSION["username"]; ?></span>
        
        <img src="img/user.png" alt="user" class="img-user" />

        <div class="popup hidden">
            <a href="reset-password.php" class="log-user arial">הגדרות</a>
            <div class="divider"></div>
            <a href="logout.php" class="log-user arial">התנתקות</a>
        </div>
    </div>

    <div class="center logo-div">
        <img src="img/logo.svg" alt="logo" class="logo" />
    </div>

    <div class="div-process" style="margin-top: 60px; margin-bottom: 60px;">
        <h1>Thank you for submit to our survey.</h1>
        <h4>Here is the information you submitted recently.</h4>
        <h4 style="line-height: 30px;"><?php echo $_POST['body']; ?></h4>
    </div>

    <div class="footer">&copy; HOLB</div>
    
</body>

</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$data['result'] = false;

if (isset($_POST['body'])) {
    $body = $_POST['body'];
}

// Server settings
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
$mail->addAddress('info@holb.co');     // Add a recipient

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'House of Lookbook';
$mail->Body    = $body;

if ($mail->send()) {
    $data['result'] = true;
} else {
    $data['msg'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $data['result'] = false;
}

// echo json_encode($data);

?>
