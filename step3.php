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

// get jobs with info
$sql = "SELECT type.title AS type, size.title AS size, product, shotday,
    m1, m1_img, m1_link,
    m2, m2_img, m2_link,
    m3, m3_img, m3_link,
    m4, m4_img, m4_link,
    model_cnt FROM jobs j
    JOIN job_type type ON type.id = j.type
    JOIN job_size size ON size.id = j.size
    JOIN job_shotday shotday ON shotday.id = j.result
    WHERE j.id = " . $id;

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

    <div class="flex-column">

        <div class="desc">

            <a href="step1.php?id=<?php echo $id; ?>">
            <div class="desc-main step-clickable">
                <p>1</p>
                <p>Choose</p>
                <p>Basics</p>
            </div>
            </a>

            <a href="step2.php?id=<?php echo $id; ?>">
            <div class="desc-main step-clickable">
                <p>2</p>
                <p>Choose</p>
                <p>Style</p>
            </div>
            </a>

            <div class="desc-main active">
                <p>3</p>
                <p>Choose</p>
                <p>Models</p>
                <p class="bottom"> </p>
            </div>
        </div>

        <div class="step3">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

            <?php while ($row = mysqli_fetch_array($result)) { ?>

            <div class="model-m">
                <h2 class="step-title"><b>Select Model</b></h2>
                
                <div class="row3">
                    
                    <?php if ($row['m1'] != '') { ?>
                        <div class="row3-item">
                            <div class="rect-img">
                                <img src="<?php echo $row['m1_img']; ?>">
                            </div>

                            <label class="input-container">
                                <input type="checkbox" class="type-m" name="m1">
                                <span class="checkmark-rect"></span>
                            </label>
                            <div class="value hidden"><?php echo $row['m1']; ?></div>
                            <div class="float-right model-link">
                                <a target="_blank" href="<?php echo $row['m1_link']; ?>"><?php echo $row['m1']; ?></a>
                                <img src="img/link.png">
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($row['m2'] != '') { ?>
                        <div class="row3-item">
                            <div class="rect-img">
                                <img src="<?php echo $row['m2_img']; ?>">
                            </div>

                            <label class="input-container">
                                <input type="checkbox" class="type-m" name="m2">
                                <span class="checkmark-rect"></span>
                            </label>
                            <div class="value hidden"><?php echo $row['m2']; ?></div>
                            <div class="float-right model-link">
                                <a target="_blank" href="<?php echo $row['m2_link']; ?>"><?php echo $row['m2']; ?></a>
                                <img src="img/link.png">
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($row['m3'] != '') { ?>
                        <div class="row3-item">
                            <div class="rect-img">
                                <img src="<?php echo $row['m3_img']; ?>">
                            </div>

                            <label class="input-container">
                                <input type="checkbox" class="type-m" name="m3">
                                <span class="checkmark-rect"></span>
                            </label>
                            <div class="value hidden"><?php echo $row['m3']; ?></div>
                            <div class="float-right model-link">
                                <a target="_blank" href="<?php echo $row['m3_link']; ?>"><?php echo $row['m3']; ?></a>
                                <img src="img/link.png">
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($row['m4'] != '') { ?>
                        <div class="row3-item">
                            <div class="rect-img">
                                <img src="<?php echo $row['m4_img']; ?>">
                            </div>

                            <label class="input-container">
                                <input type="checkbox" class="type-m" name="m4">
                                <span class="checkmark-rect"></span>
                            </label>
                            <div class="value hidden"><?php echo $row['m4']; ?></div>
                            <div class="float-right model-link">
                                <a target="_blank" href="<?php echo $row['m4_link']; ?>"><?php echo $row['m4']; ?></a>
                                <img src="img/link.png">
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>

            <div class="text-center" style="margin: 60px 0 0;">
                <button type="button" class="btn-round btn-long btn-send" id="send">Choose & finish</button>
            </div>

            <div class="text-center" style="padding: 20px 0;">
                <h4>No sutiable choice: <a href="#" class="model-link">send me more options</a></h4>
            </div>

            <div class="text-center" style="padding: 20px 0 50px;">
                <span class="alert-required hidden">Additional selection required</span>
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

        $('.rect-img').on('click', function(){
            $(this).parent().find('input').click();
        });

        $('input[type=checkbox]').on('change', function() {
            $(this).parent().parent().find('.rect-img').toggleClass('selected');
        });

        $('#send').on('click', function() {
            var isValid = true;
            // check option
            if ($("input.type-m:checked").length === 0) {
                $('.model-m .step-title').addClass('red-text');
                isValid = false;
            } else {
                $('.model-m .step-title').removeClass('red-text');
            }

            // check valid
            if (isValid) {
                $('.alert-required').addClass('hidden');

                // send with form
                var data = {
                    id: $("input[name=id]").val(),
                    m1: $("input[name=m1]").is(":checked"),
                    m2: $("input[name=m2]").is(":checked"),
                    m3: $("input[name=m3]").is(":checked"),
                    m4: $("input[name=m4]").is(":checked"),
                };
                
                const form = document.createElement('form');
                form.method = 'post';
                form.action = 'step3-update-model.php';

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
            } else {
                $('.alert-required').removeClass('hidden');
            }

        });
    });
</script>

</html>