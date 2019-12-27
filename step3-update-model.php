<?php

require "curl-mail.php";
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
$sql = "SELECT type.title AS type, size.title AS size, product, shotday, m1, m2, m3, m4 FROM jobs j
    JOIN job_type type ON type.id = j.type
    JOIN job_size size ON size.id = j.size
    JOIN job_shotday shotday ON shotday.id = j.result
    WHERE j.id = " . $id;

$result = mysqli_query($conn, $sql);

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Holb - House of Lookbook</title>
    <link rel="icon" href="favicon.png" sizes="any" type="image/png">

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
        <a href="main.php"><img src="img/logo.svg" alt="logo" class="logo" /></a>
    </div>

    <div class="flex-column div-process">
        <div class="dash-content">
            <h1>Project was created successfully.</h1>
            <h4 class="arial">.בעוד יום עבודה יישלח מייל עם הצעת מחיר לאישור סופי</h4>
        </div>

        <div class="text-center" style="margin-top:50px;">
            <h4><a href="step1.php" class="model-link">Create another proejct</a></h4>
        </div>
    </div>

    <div class="footer">&copy; HOLB</div>

</body>

<script type="text/javascript">
    $(document).ready(function () {

        $(document).mouseup(function(e)
        {
            $('.popup').addClass('hidden');
        });
        
        $('.s_username').on('click', function() {
            $('.popup').toggleClass('hidden');
        });
    });
</script>

</html>


<?php
// send customer mail
sendMail('TEAM@holb.co', 'House of Lookbook', 'admin@holb.co', 'admin@holb.co', 'Select model from House of Lookbook', 'New job is waiting for Price Quote');
?>
