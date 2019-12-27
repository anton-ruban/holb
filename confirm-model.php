<?php
// Initialize the session
session_start();
 
// Include config file
require_once "config.php";

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// auto login
$sqlUserName = "SELECT u.id, username, contact_name FROM users u JOIN jobs j ON u.id = user_id WHERE j.id = " . $id;
$result = mysqli_query($conn, $sqlUserName);

if (!$result) {
    $result = mysqli_error($conn);
}

$row = mysqli_fetch_array($result);

$_SESSION["loggedin"] = true;
$_SESSION["id"] = $row['id'];
$_SESSION["username"] = $row['username'];    

// get job price and comment
$sql = "SELECT price, comment FROM jobs WHERE id = " . $id;
$result = mysqli_query($conn, $sql);

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
        <b>PROPOSAL APPROVAL</b>
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
            <h1>It's a go.</h1>
            <h4 class="arial">.פרטי הפרוייקט נשלחו במייל. קליק לאישור ההצעה</h4>
        </div>

        <div class="text-center" style="margin-top:50px;">
            <?php while ($row = mysqli_fetch_array($result)) { ?>

            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            
            <div>
                
                <?php if ($row['comment'] != '') { ?>
                <?php } ?>

                <?php if ($row['price'] != '') { ?>
                <?php } ?>

            </div>
            
            <div class="text-center">
                <input type="submit" class="btn-round btn-huge btn-send" id="confirm" value="Approve project proposal">
            </div>

            <?php } ?>

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

        $('#confirm').on('click', function() {

            // send with form
            var data = {
                id: $("input[name=id]").val(),
            };
            
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'confirm-price.php';

            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                const hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = key;
                hiddenField.value = data[key];

                form.appendChild(hiddenField);
                }
            }

            document.body.appendChild(form);
            form.submit();

        });
    });
</script>

</html>