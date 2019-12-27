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

// get jobs with user contact info
$sql = "SELECT w1, w2, w3, w4, m1, m2, m3, m4 FROM jobs WHERE id = " . $id;
$result = mysqli_query($conn, $sql);

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

    <div class="brief">1<b>/1 CHOOSE MODELS</b></div>

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

    <div class="text-center huge-title" style="width: 100%;">
        <span class="huge">Choose models</span>
    </div>

    <div class="container-fluid text-center">
        <?php while ($row = mysqli_fetch_array($result)) { ?>

        <br/>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <h3>1. Please select one or more Model W</h3>
        <div class="row section-80p">
            
            <?php if ($row['w1'] != '') { ?>
                <div class="row4">
                    <div class="rect-grey portrait">
                        <div class="rect-white"></div>
                    </div>

                    <h4 class="value hidden"><?php echo $row['w1']; ?></h4>
                    <label class="input-container">
                        <input type="radio" class="type-w" name="w1">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            <?php } ?>

            <?php if ($row['w2'] != '') { ?>
                <div class="row4">
                    <div class="rect-grey portrait">
                        <div class="rect-white"></div>
                    </div>

                    <h4 class="value hidden"><?php echo $row['w2']; ?></h4>
                    <label class="input-container">
                        <input type="radio" class="type-w" name="w2">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            <?php } ?>

            <?php if ($row['w3'] != '') { ?>
                <div class="row4">
                    <div class="rect-grey portrait">
                        <div class="rect-white"></div>
                    </div>

                    <h4 class="value hidden"><?php echo $row['w3']; ?></h4>
                    <label class="input-container">
                        <input type="radio" class="type-w" name="w3">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            <?php } ?>

            <?php if ($row['w4'] != '') { ?>
                <div class="row4">
                    <div class="rect-grey portrait">
                        <div class="rect-white"></div>
                    </div>

                    <h4 class="value hidden"><?php echo $row['w4']; ?></h4>
                    <label class="input-container">
                        <input type="radio" class="type-w" name="w4">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            <?php } ?>

        </div>

        <h3>2. Please select one or more Model M</h3>

        <div class="row section-80p">
            
            <?php if ($row['m1'] != '') { ?>
                <div class="row4">
                    <div class="rect-grey portrait">
                        <div class="rect-white"></div>
                    </div>

                    <h4 class="value hidden"><?php echo $row['m1']; ?></h4>
                    <label class="input-container">
                        <input type="radio" class="type-m" name="m1">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            <?php } ?>

            <?php if ($row['m2'] != '') { ?>
                <div class="row4">
                    <div class="rect-grey portrait">
                        <div class="rect-white"></div>
                    </div>

                    <h4 class="value hidden"><?php echo $row['m2']; ?></h4>
                    <label class="input-container">
                        <input type="radio" class="type-m" name="m2">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            <?php } ?>

            <?php if ($row['m3'] != '') { ?>
                <div class="row4">
                    <div class="rect-grey portrait">
                        <div class="rect-white"></div>
                    </div>

                    <h4 class="value hidden"><?php echo $row['m3']; ?></h4>
                    <label class="input-container">
                        <input type="radio" class="type-m" name="m3">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            <?php } ?>

            <?php if ($row['m4'] != '') { ?>
                <div class="row4">
                    <div class="rect-grey portrait">
                        <div class="rect-white"></div>
                    </div>

                    <h4 class="value hidden"><?php echo $row['m4']; ?></h4>
                    <label class="input-container">
                        <input type="radio" class="type-m" name="m4">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            <?php } ?>
        </div>

        <br/><br/>
    
        <div class="text-center">
            <input type="submit" class="btn btn-black form-control" id="send" disabled="disabled" value="שליחה">
        </div>
        <br/>

        <?php } ?>

    </div>

</body>

<script type="text/javascript">
    $(document).ready(function () {

        $('.s_username').on('click', function() {
            $('.popup').toggleClass('hidden');
        });

        $('input').on('change', function() {
            // check fields
            var nextEnabled = false;
            $('input').each(function(index) {

                if ( ($("input.type-w:checked").length > 0) && ($("input.type-m:checked").length > 0)) {
                    nextEnabled = true;
                    return true;
                }

            });

            $('#send').prop('disabled', !nextEnabled);

        });

        $('#send').on('click', function() {

            // valid
            if (!$('.alert-danger').is(":visible")) {
                $('.alert-info').fadeIn();

                // send with form
                var data = {
                    id: $("input[name=id]").val(),
                    w1: $("input[name=w1]").is(":checked"),
                    w2: $("input[name=w2]").is(":checked"),
                    w3: $("input[name=w3]").is(":checked"),
                    w4: $("input[name=w4]").is(":checked"),

                    m1: $("input[name=m1]").is(":checked"),
                    m2: $("input[name=m2]").is(":checked"),
                    m3: $("input[name=m3]").is(":checked"),
                    m4: $("input[name=m4]").is(":checked"),
                };
                
                const form = document.createElement('form');
                form.method = 'post';
                form.action = 'update-model.php';

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
            }

        });
    });
</script>

</html>