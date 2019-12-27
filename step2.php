<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$type = 0;
$type_str = '';
$size = 0;
$size_str = '';
$product = '';
$shotday = '';
$lookfeel = 0;
$hairday = 0;
$makeup = 0;
$url1 = '';
$url2 = '';
$comment = '';

// DB connection
require_once "config.php";

$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$sql = "SELECT type, t.title AS type_str, size, s.title AS size_str, product, shotday, result, hairday, makeup, url1, url2, comment
FROM jobs j
	JOIN job_type t ON t.id = j.type 
	JOIN job_size s ON s.id = j.size
WHERE
    j.id = " . $id;

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    // step 1 values
    $type = $row['type'];
    $type_str = $row['type_str'];
    $size = $row['size'];
    $size_str = $row['size_str'];
    $product = $row['product'];
    $shotday = $row['shotday'];

    // step 2 values
    if ($row['result'])
        $lookfeel = $row['result'];
    
    if ($row['hairday'])
        $hairday = $row['hairday'];
    
    if ($row['makeup'])
        $makeup = $row['makeup'];
    
    if ($row['url1'])
        $url1 = $row['url1'];

    if ($row['url2'])
        $url2 = $row['url2'];
    
    if ($row['comment'])
        $comment = $row['comment'];
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

    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <link  href="css/jquery.fancybox.min.css" rel="stylesheet">
    <script src="js/jquery.fancybox.min.js"></script>

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

    <div class="brief">
        2/<b>3</b>&nbsp;&nbsp;YOUR HOLB PROJECT

        <span class="brief-summary">
            <?php echo $type_str; ?> /
            <b><?php echo $size_str; ?></b> /
            <?php echo date('d F', strtotime($shotday)); ?> /
            <?php echo $product; ?>
        </span>
    </div>

    <div class="desc">

        <a href="step1.php?id=<?php echo $id; ?>">
        <div class="desc-main step-clickable">
            <p>1</p>
            <p>Choose</p>
            <p>Basics</p>
        </div>
        </a>

        <div class="desc-main active">
            <p>2</p>
            <p>Choose</p>
            <p>Style</p>
            <p class="bottom"> </p>
        </div>

        <div class="desc-main">
            <p>3</p>
            <p>Choose</p>
            <p>Models</p>
        </div>
    </div>

    <div class="step2 flex-column">

        <div class="step-1-values hidden">
            <span class="hidden title-type">1. Type of visual : <?php echo $type_str; ?></span>
            <span class="hidden title-size">2. Package size : <?php echo $size_str; ?></span>
            <span class="hidden title-product">3. Product Usage : <?php echo $product; ?></span>
            <span class="hidden title-shotday">4. Shot Day : <?php echo $shotday; ?></span>
        </div>

        <div class="look-and-feel">
            <h2 class="step-title"><b>Look & Feel</b></h2>

            <span class="hidden title-result">5. Look & Feel</span>

            <div class="row3">
                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-look" href="img/img-look-trendy.jpg">
                            <img alt="placeholder" src="img/img-look-trendy.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="result" name="result" <?php if ($lookfeel == 1) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Trendy</div>
                </div>

                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-look" href="img/img-look-young.jpg">
                            <img alt="placeholder" src="img/img-look-young.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="result" name="result" <?php if ($lookfeel == 2) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Young</div>
                </div>

                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-look" href="img/img-look-classic.jpg">
                            <img alt="placeholder" src="img/img-look-classic.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="result" name="result" <?php if ($lookfeel == 3) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Classic</div>
                </div>

                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-look" href="img/img-look-moody.jpg">
                            <img alt="placeholder" src="img/img-look-moody.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="result" name="result" <?php if ($lookfeel == 4) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Moody</div>
                </div>

                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-look" href="img/img-look-modern.jpg">
                            <img alt="placeholder" src="img/img-look-modern.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="result" name="result" <?php if ($lookfeel == 5) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Modern</div>
                </div>

            </div>
            
        </div>

        <div class="makeup">
            
            <h2 class="step-title"><b>Makeup</b></h2>
            <span class="hidden title-makeup">6. Type of makeup</span>

            <div class="row3">

                <div class="row3-item first">
                    <div class="rect-img">
                        <a data-fancybox="gallery-makeup" href="img/img-makeup-natural.jpg">
                            <img alt="placeholder" src="img/img-makeup-natural.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="makeup" name="makeup" <?php if ($makeup == 1) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Natural</div>
                </div>

                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-makeup" href="img/img-makeup-eyes.jpg">
                            <img alt="placeholder" src="img/img-makeup-eyes.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="makeup" name="makeup" <?php if ($makeup == 2) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Eyes</div>
                </div>

                <div class="row3-item last">
                    <div class="rect-img">
                        <a data-fancybox="gallery-makeup" href="img/img-makeup-lips.jpg">
                            <img alt="placeholder" src="img/img-makeup-lips.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="makeup" name="makeup" <?php if ($makeup == 3) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Lips</div>
                </div>

                <div class="row3-item last">
                    <div class="rect-img">
                        <a data-fancybox="gallery-makeup" href="img/img-makeup-eyes+lips.jpg">
                            <img alt="placeholder" src="img/img-makeup-eyes+lips.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="makeup" name="makeup" <?php if ($makeup == 4) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Eyes+lips</div>
                </div>

            </div>

        </div>

        <div class="hair">
        
            <h2 class="step-title"><b>Hair</b></h2>
            <span class="hidden title-hair">7. Type of hair</span>

            <div class="row3">

                <div class="row3-item first">
                    <div class="rect-img">
                        <a data-fancybox="gallery-hair" href="img/img-nonchalant-hair-up.jpg">
                            <img alt="placeholder" src="img/img-nonchalant-hair-up.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="hairday" name="hairday" <?php if ($hairday == 1) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Nonchalant hair up</div>
                </div>

                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-hair" href="img/img-nonchalant-hair-down.jpg">
                            <img alt="placeholder" src="img/img-nonchalant-hair-down.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="hairday" name="hairday" <?php if ($hairday == 2) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Nonchalant hair down</div>
                </div>

                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-hair" href="img/img-hair-bold.jpg">
                            <img alt="placeholder" src="img/img-hair-bold.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="hairday" name="hairday" <?php if ($hairday == 3) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Bold</div>
                </div>

                <div class="row3-item">
                    <div class="rect-img">
                        <a data-fancybox="gallery-hair" href="img/img-hair-glam.jpg">
                            <img alt="placeholder" src="img/img-hair-glam.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="hairday" name="hairday" <?php if ($hairday == 4) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Glam</div>
                </div>

                <div class="row3-item last">
                    <div class="rect-img">
                        <a data-fancybox="gallery-hair" href="img/img-hair-wet.jpg">
                            <img alt="placeholder" src="img/img-hair-wet.jpg">
                        </a>
                    </div>

                    <label class="input-container">
                        <input type="radio" class="hairday" name="hairday" <?php if ($hairday == 5) echo 'checked'; ?> >
                        <span class="checkmark-rect"></span>
                    </label>
                    <div class="value">Wet</div>
                </div>

            </div>

        </div>

        <div class="reference">
            <h2 class="step-title"><b>References</b><b class="optional">(Optional)</b></h2>
            <span class="hidden title-ref">8. Additional references</span>

            <h4 class="optional">1.</h4>
            <input type="text" class="form-control input-ref" name="url1" placeholder="http://" value="<?php echo $url1; ?>" />
            <br/>
            <h4 class="optional">2.</h4>
            <input type="text" class="form-control input-ref" name="url2" placeholder="http://" value="<?php echo $url2; ?>" />
            <br/><br/>
        </div>

        <div class="additional-comments">
            <h2 class="step-title"><b>Additional comments</b><b class="optional">(Optional)</b></h2>
            <span class="hidden title-comment">9. Additional comments</span>
            <textarea name="comment" class="form-control comment" rows="10" cols="50" placeholder="background colour, site proportions, etc..."><?php echo $comment; ?></textarea>
        </div>

        <div class="text-center" style="margin: 60px 0 0;">
            <button type="button" class="btn-round btn-big btn-send" id="send">Next</button>
        </div>
        <div class="text-center" style="padding: 20px 0 50px;">
            <span class="alert-required hidden">Additional selection required</span>
        </div>

    </div>
    
    <div class="flex-column div-process">
        <div class="dash-content">
            <h1>Almost done.</h1>
            <h4 class="arial">.בעוד יום עבודה יישלח מייל עם הצעה לבחירת דוגמנים/יות</h4>
        </div>
    </div>

    <div class="footer">&copy; HOLB</div>

</body>

<script type="text/javascript">
    $('.div-process').hide();

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
            $(this).parent().parent().parent().find('.rect-img').removeClass('selected');
            $(this).addClass('selected');
        });

        $('.step2 .value').on('click', function() {
            $(this).parent().find('input').click();
            $(this).parent().parent().parent().find('.rect-img').removeClass('selected');
            $(this).parent().find('.rect-img').addClass('selected');
        });

        $('input[type=radio]').on('change', function() {
            $(this).parent().parent().parent().parent().find('.rect-img').removeClass('selected');
            $(this).parent().parent().find('.rect-img').addClass('selected');
        });

        $('#send').on('click', function() {
            var isValid = true;

            // check option
            if ($("input.result:checked").length === 0) {
                $('.look-and-feel .step-title').addClass('red-text');
                isValid = false;
            } else {
                $('.look-and-feel .step-title').removeClass('red-text');
            }

            if ($("input.makeup:checked").length === 0) {
                $('.makeup .step-title').addClass('red-text');
                isValid = false;
            } else {
                $('.makeup .step-title').removeClass('red-text');
            }

            if ($("input.hairday:checked").length === 0) {
                $('.hair .step-title').addClass('red-text');
                isValid = false;
            } else {
                $('.hair .step-title').removeClass('red-text');
            }

            // check valid
            if (isValid) {

                $('.alert-required').addClass('hidden');

                // processing
                $('.brief-summary').html("PROCESSING...");
                // $('.desc').hide();
                // $('.step2').hide();
                // $('.div-process').fadeIn();

                var body = "";

                body += $('.title-type').text() + "</br>\n";
                body += $('.title-size').text() + "</br>\n";
                body += $('.title-product').text() + "</br>\n";
                body += $('.title-shotday').text() + "</br>\n";
                body += $('.title-result').text() + " : " +  $("input.result:checked").parent().parent().find('.value').text() + "</br>\n";
                body += $('.title-makeup').text() + " : " + $("input.makeup:checked").parent().parent().find('.value').text() + "</br>\n";
                body += $('.title-hair').text() + " : " + $("input.hairday:checked").parent().parent().find('.value').text() + "</br>\n";
                body += $('.title-ref').text() + "</br>\n";
                body += "URL1: " + $('input[name=url1]').val() + "</br>\n";
                body += "URL2: " + $('input[name=url2]').val() + "</br>\n";
                body += $('.title-comment').text() + " : " + $('textarea.comment').val() + "</br>\n";

                // insert db
                $.ajax({
                    url: 'step2-save.php',
                    data: {
                        id: "<?php echo $id; ?>",
                        type: "<?php echo $type; ?>",
                        size: "<?php echo $size; ?>",
                        shotday: "<?php echo $shotday; ?>",
                        product: "<?php echo $product; ?>",
                        result: ($("input.result").index($("input.result:checked")) + 1),
                        makeup: ($("input.makeup").index($("input.makeup:checked")) + 1),
                        hairday: ($("input.hairday").index($("input.hairday:checked")) + 1),
                        url1: $('input[name=url1]').val(),
                        url2: $('input[name=url2]').val(),
                        comment: $('textarea.comment').val(),
                    },
                    type: "POST",
                    success: function (result) {
                        var job_id = JSON.parse(result);

                        // send mail and show result
                        var data = {
                            body: body,
                        };
                        
                        const form = document.createElement('form');
                        form.method = 'post';
                        form.action = 'step2-mail.php?id=' + job_id['id'];

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

            } else {
                $('.alert-required').removeClass('hidden');
            }

        });
    });
</script>

</html>