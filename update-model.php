<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

require_once "config.php";

// Initialize the session
session_start();

// update job model and status
$id = $_POST['id'];

$m1_query = ($_POST['m1'] == 'true') ? "" : " m1 = '', ";
$m2_query = ($_POST['m2'] == 'true') ? "" : " m2 = '', ";
$m3_query = ($_POST['m3'] == 'true') ? "" : " m3 = '', ";
$m4_query = ($_POST['m4'] == 'true') ? "" : " m4 = '', ";

$sqlUpdate = 'UPDATE jobs SET ' .
    $m1_query .
    $m2_query .
    $m3_query .
    $m4_query .

    ' status = 4
    
    WHERE
    id = ' . $id;
    
$result = mysqli_query($conn, $sqlUpdate);

if (!$result) {
    $result = mysqli_error($conn);
}

// get jobs with info
$sql = "SELECT type.title AS type, size.title AS size, product.title AS product, shotday, m1, m2, m3, m4 FROM jobs j
    JOIN job_type type ON type.id = j.type
    JOIN job_size size ON size.id = j.size
    JOIN job_product product ON product.id = j.product
    JOIN job_shotday shotday ON shotday.id = j.result
    WHERE j.id = " . $id;

$result = mysqli_query($conn, $sql);

// close connection
mysqli_close($conn);
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
        3/<b>3</b>&nbsp;&nbsp;YOUR HOLB PROJECT

        <span class="brief-summary">
            <?php while ($row = mysqli_fetch_array($result)) { ?>

            <?php echo $row['type']; ?> /
            <b><?php echo $row['size']; ?></b> /
            <?php echo date('d F', strtotime($row['shotday'])); ?> /
            <?php echo $row['product']; ?>

            <?php } mysqli_data_seek($result, 0); ?>
        </span>
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

    <div class="div-process" style="margin-top: 180px; margin-bottom:80px;">
        <h1>Project was created successfully.</h1>
        <h4 class="arial">.בעוד יום עבודה יישלח מייל עם הצעת מחיר לאישור סופי</h4>
    </div>

    <div class="text-center" style="margin-bottom:120px;">
        <h4><a href="step1.php" class="model-link">Create another proejct</a></h4>
    </div>

    <div class="footer">&copy; HOLB</div>

</body>

<script type="text/javascript">
    $(document).ready(function () {
        $('.s_username').on('click', function() {
            $('.popup').toggleClass('hidden');
        });
    });
</script>

</html>


<?php
// send customer mail
$mail = new PHPMailer(true);

$mail->isSMTP();                                            // Set mailer to use SMTP
$mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'holb.co@gmail.com';                    // SMTP username
$mail->Password   = 'Holb9999';                             // SMTP password

$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
$mail->Port       = 587;                                    // TCP port to connect to

//Recipients
$mail->setFrom('holb.co@gmail.com', 'House of Lookbook');
$mail->addAddress('admin@holb.co');     // Add a recipient

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Select model from House of Lookbook';
$mail->Body    = 'New job is waiting for Price Quote';

if ($mail->send()) {
    $data['result'] = true;
} else {
    $data['msg'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $data['result'] = false;
}

?>