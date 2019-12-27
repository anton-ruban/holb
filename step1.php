<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$type = 0;
$size = 0;
$product = '';
$shotday = '';

// DB connection
require_once "config.php";

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// get jobs with info
$sql = "SELECT type, size, product, shotday FROM jobs WHERE id = " . $id;

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    $type = $row['type'];
    $size = $row['size'];
    $product = $row['product'];
    $shotday = $row['shotday'];
}

$sql = "SELECT start FROM events WHERE type = 1";
$result = mysqli_query($conn, $sql);

$busyDays = array();
while ($row = mysqli_fetch_array($result)) {
    array_push($busyDays, $row['start']);
}

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
    <link rel="stylesheet" type="text/css" href="css/datepicker.min.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <!-- Include English language -->
    <script src="js/datepicker.en.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>

    <div class="brief">1/<b>3</b>&nbsp;&nbsp;&nbsp;&nbsp;YOUR HOLB PROJECT</div>

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

            <div class="desc-main active">
                <p>1</p>
                <p>Choose</p>
                <p>Basics</p>
                <p class="bottom"> </p>
            </div>

            <div class="desc-main">
                <p>2</p>
                <p>Choose</p>
                <p>Style</p>
            </div>

            <div class="desc-main">
                <p>3</p>
                <p>Choose</p>
                <p>Models</p>
            </div>
        </div>

        <div class="container-fluid job">
            
            <div class="row step1">
                <div class="step1-title">
                    <b class="job-type-title step1-border">Visual</b>
                </div>
                
                <span class="hidden title-type">1. Type of visual</span>

                <div class="job-type first">
                    <label class="input-container">
                        <input type="radio" name="type" class="type" <?php if ($type == 1) echo 'checked'; ?> >
                        <span class="checkmark"></span>
                    </label>
                    <span class="value">Lookbook</span>
                </div>

                <div class="job-type">
                    <label class="input-container">
                        <input type="radio" name="type" class="type" <?php if ($type == 2) echo 'checked'; ?> >
                        <span class="checkmark"></span>
                    </label>
                    <span class="value">Video</span>
                </div>

                <div class="job-type">
                    <label class="input-container">
                        <input type="radio" name="type" class="type" <?php if ($type == 3) echo 'checked'; ?> >
                        <span class="checkmark"></span>
                    </label>
                    <span class="value">Beauty</span>
                </div>

                <div class="job-type">
                    <label class="input-container">
                        <input type="radio" name="type" class="type" <?php if ($type == 4) echo 'checked'; ?> >
                        <span class="checkmark"></span>
                    </label>
                    <span class="value">Packshots</span>
                </div>

                <div class="job-type last">
                    <label class="input-container">
                        <input type="radio" name="type" class="type" <?php if ($type == 5) echo 'checked'; ?> >
                        <span class="checkmark"></span>
                    </label>
                    <span class="value">Lookbook + Video</span>
                </div>
            </div>

            <div class="row step1">
                <div class="step1-title">
                    <b class="job-size-title step1-border">Size</b>
                </div>

                <span class="hidden title-size">2. Package size</span>

                <div class="job-size first">
                    <label class="input-container">
                        <input type="radio" name="size" class="size" <?php if ($size == 1) echo 'checked'; ?> >
                        <span class="checkmark"></span>
                    </label>
                    <span class="value float-left">Small</span>
                    <span class="value-txt hidden">S</span>
                    <span class="value-summary">
                        <p>Per item</p>
                        <p><i>min. 5 looks</i></p>
                    </span>
                </div>

                <div class="job-size">
                    <label class="input-container">
                        <input type="radio" name="size" class="size" <?php if ($size == 2) echo 'checked'; ?> >
                        <span class="checkmark"></span>
                    </label>
                    <span class="value float-left">Medium</span>
                    <span class="value-txt hidden">M</span>
                    <span class="value-summary">
                        <p>1/2 shooting</p>
                        <p>day</p>
                    </span>
                </div>

                <div class="job-size last">
                    <label class="input-container">
                        <input type="radio" name="size" class="size" <?php if ($size == 3) echo 'checked'; ?> >
                        <span class="checkmark"></span>
                    </label>
                    <span class="value float-left">Large</span>
                    <span class="value-txt hidden">L</span>
                    <span class="value-summary">
                        <p>Full shooting</p>
                        <p>day</p>
                    </span>
                </div>

            </div>

            <div class="row step1">
                <div class="step1-title">
                    <b class="job-product-title step1-border">Use</b>
                </div>

                <span class="hidden title-product">3. Product Usage</span>

                <div class="job-product first">
                    <label class="input-container">
                        <input type="checkbox" name="product" class="product" <?php if (strpos($product, 'Website') !== false) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <span class="value">Website</span>
                </div>

                <div class="job-product">
                    <label class="input-container">
                        <input type="checkbox" name="product" class="product" <?php if (strpos($product, 'Digital') !== false) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <span class="value">Digital</span>
                </div>

                <div class="job-product">
                    <label class="input-container">
                        <input type="checkbox" name="product" class="product" <?php if (strpos($product, 'PR') !== false) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <span class="value">PR</span>
                </div>

                <div class="job-product last">
                    <label class="input-container">
                        <input type="checkbox" name="product" class="product" <?php if (strpos($product, 'Store') !== false) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <span class="value">Store</span>
                </div>
            </div>

            <div class="row step1 div-calendar">
                <b class="title">Date</b>
                <span class="hidden title-shotday">4. Shot Day</span>

                <div class="shotday" data-language='en'></div>
            </div>

            <div class="text-center" style="margin: 60px 0 20px;">
                <button type="button" class="btn-round btn-big btn-send" id="send">Next</button>
            </div>
            <div class="text-center" style="padding: 20px 0;">
                <span class="alert-required hidden">Additional selection required</span>
            </div>

        </div>

    </div>

    <div class="footer">&copy; HOLB</div>

</body>

<script type="text/javascript">
    $(document).ready(function () {
        var busyDays = JSON.parse('<?php echo json_encode($busyDays); ?>');
        busyDays = busyDays.map(date => date = new Date(date).toString());

        $('.shotday').datepicker({
            onRenderCell: function (date, cellType) {
                var isDisabled = busyDays.indexOf(date.toString()) !== -1;
                return {
                    disabled: isDisabled
                }
            }
        });

        // $('.shotday').val('<?php echo $shotday; ?>');

        $(document).mouseup(function(e)
        {
            $('.popup').addClass('hidden');
        });

        $('.s_username').on('click', function() {
            $('.popup').toggleClass('hidden');
        });

        $('.step1 .value').on('click', function() {
            $(this).parent().find('input').click();
        });

        $('.job-type input').on('change', function() {
            $('.job-type .value').removeClass('bold');
            $("input.type:checked").parent().parent().find('.value').addClass('bold');
        });

        $('.job-size input').on('change', function() {
            $('.job-size .value').removeClass('bold');
            $("input.size:checked").parent().parent().find('.value').addClass('bold');
        });

        $('.job-product input').on('change', function() {
            $('.job-product .value').removeClass('bold');
            $("input.product:checked").parent().parent().find('.value').addClass('bold');
        });

        $('#send').on('click', function() {
            var isValid = true;

            // check option
            if ($("input.type:checked").length === 0) {
                $('.job-type-title').addClass('red-border-title');
                $('.job-type').addClass('red-border');

                isValid = false;
            } else {
                $('.job-type-title').removeClass('red-border-title');
                $('.job-type').removeClass('red-border');
            }

            if ($("input.size:checked").length === 0) {
                $('.job-size-title').addClass('red-border-title');
                $('.job-size').addClass('red-border');

                isValid = false;
            } else {
                $('.job-size-title').removeClass('red-border-title');
                $('.job-size').removeClass('red-border');
            }

            if ($("input.product:checked").length === 0) {
                $('.job-product-title').addClass('red-border-title');
                $('.job-product').addClass('red-border');

                isValid = false;
            } else {
                $('.job-product-title').removeClass('red-border-title');
                $('.job-product').removeClass('red-border');
            }

            // check date
            if ($('.shotday').val() === "") {
                $('.div-calendar').addClass('red-border-date');

                isValid = false;
            } else {
                $('.div-calendar').removeClass('red-border-title');
            }

            var product_txt = "";
            $("input.product:checked").each(function(index){
                product_txt += $(this).parent().parent().find('.value').text() + ', ';
            });
            product_txt = product_txt.substring(0, product_txt.length - 2);

            // check valid
            if (isValid) {
                $('.alert-required').addClass('hidden');

                var body = "";

                body += $('.title-type').text() + " : " + $("input.type:checked").parent().parent().find('.value').text() + "</br>\n";
                body += $('.title-size').text() + " : " + $("input.size:checked").parent().parent().find('.value').text() + "</br>\n";
                body += $('.title-shotday').text() + " : " + $('.shotday').val() + "</br>\n";
                body += $('.title-product').text() + " : " + product_txt + "</br>\n";

                // step1 save to db
                $.ajax({
                    url: 'step1-save.php',
                    data: {
                        id: "<?php echo $id; ?>",
                        type: ($("input.type").index($("input.type:checked")) + 1),
                        size: ($("input.size").index($("input.size:checked")) + 1),
                        shotday: $('.shotday').val(),
                        product: product_txt,
                    },
                    type: "POST",
                    success: function (result) {
                        var job_id = JSON.parse(result);
                        window.location.href = 'step2.php?id=' + job_id['id'];
                    }
                });

            } else {
                $('.alert-required').removeClass('hidden');
            }

        });
    });
</script>

</html>