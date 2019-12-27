<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Get user info
$sql = "SELECT * FROM `users` WHERE username = '" . $_SESSION["username"] . "';";
$result = mysqli_query($conn, $sql);
$user_info = mysqli_fetch_array($result);
mysqli_close($conn);

// go to step 1 if user have hp, phone
if ($user_info['hp'] && $user_info['phone']) {
    header("location: step1.php");
    exit;
}

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

    <div class="flex-column">

        <div class="desc">
            <p>YOUR</p>
            <p>DETAILS</p>
            <p class="bottom"> </p>
        </div>

        <div class="content-main text-right">
            
            <div class="section job-company">
                <h5>שם החברה</h5>
                <input type="text" class="form-control text-right" name="company">
            </div>

            <div class="section job-name">
                <h5>שם איש קשר</h5>
                <input type="text" class="form-control text-right" name="contact_name">
            </div>

            <div class="section job-phone">
                <h5>טלפון איש קשר</h5>
                <input type="text" class="form-control text-right" name="phone">
            </div>

            <div class="section job-hp">
                <h5>ח.פ החברה</h5>
                <input type="text" class="form-control text-right" name="hp">
            </div>

            <div class="section job-address">
                <h5>כתובת איסוף</h5>
                <input type="text" class="form-control text-right" name="address">
            </div>

            <div class="text-center">
                <button type="button" class="btn-round btn-short btn-send" id="send">Next</button>
            </div>
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

        $('#send').on('click', function() {

            $('input.form-control').each(function(index){
                if( !$(this).val() ) {
                    $(this).prev('h5').addClass('red-text');
                    $(this).addClass('alert-text');
                } else {
                    $(this).prev('h5').removeClass('red-text');
                    $(this).removeClass('alert-text');
                }
            });

            // check valid
            if (!$('.alert-text').is(":visible")) {

                // save user data
                $.ajax({
                    url: 'update-user.php',
                    data: {
                        contact_name: $('input[name=contact_name]').val(),
                        hp: $('input[name=hp]').val(),
                        phone: $('input[name=phone]').val(),
                        company: $('input[name=company]').val(),
                        address: $('input[name=address]').val(),
                    },
                    type: "POST",
                    success: function (response) {
                        if (response)
                            location.href = "step1.php";
                    }
                });
            }

        });
    });
</script>

</html>