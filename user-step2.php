<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
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
    <link rel="stylesheet" type="text/css" href="css/datepicker.min.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <!-- Include English language -->
    <script src="js/datepicker.en.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>

    <div class="brief">1<b>/2 BRIEF</b></div>

    <div class="logout">
        <span class="s_username"><?php echo $_SESSION["username"]; ?></span>
        
        <img src="img/user.png" alt="user" class="img-user" />

        <div class="popup hidden">
            <a href="logout.php" class="log-user">Log Out</a>
            <div class="divider"></div>
            <a href="reset-password.php" class="log-user">Edit</a>
        </div>
    </div>

    <div class="center logo-div">
        <img src="img/logo.svg" alt="logo" class="logo" />
    </div>

    <div class="text-center huge-title">
        <span class="huge">Let's get to work.</span>
    </div>

    <div class="container-fluid job text-center">
        
        <div class="row section-60p">
            <h3><b>סוג הויז׳ואל</b></h3><br/>
            <span class="hidden title-type">1. Type of visual</span>

            <div class="job-type">
                <img src="img/icon.png" alt="icon" class="icon" />
                <h4 class="value">Packshot</h4>
                <label class="input-container">
                    <input type="radio" name="type" class="type">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-type">
                <img src="img/icon.png" alt="icon" class="icon" />
                <h4 class="value">Beauty</h4>
                <label class="input-container">
                    <input type="radio" name="type" class="type">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-type">
                <img src="img/icon.png" alt="icon" class="icon" />
                <h4 class="value">Video</h4>
                <label class="input-container">
                    <input type="radio" name="type" class="type">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-type">
                <img src="img/icon.png" alt="icon" class="icon" />
                <h4 class="value">Lookbook</h4>
                <label class="input-container">
                    <input type="radio" name="type" class="type">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <div class="section row">
            <h3><b>היקף</b></h3>
            <span class="hidden title-size">2. Package size</span>

            <div class="job-size">
                <span class="huge value">S</span>
                <h3><b>לפי פריט</b></h3>
                <h5>מינימום 5 לוקים</h5>
                <label class="input-container">
                    <input type="radio" name="size" class="size">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-size">
                <span class="huge value">M</span>
                <h3><b>חצי יום צילום</b></h3>
                <h5>פירוט?</h5>
                <label class="input-container">
                    <input type="radio" name="size" class="size">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-size">
                <span class="huge value">L</span>
                <h3><b>יום צילום</b></h3>
                <h5>פירוט?</h5>
                <label class="input-container">
                    <input type="radio" name="size" class="size">
                    <span class="checkmark"></span>
                </label>
            </div>

        </div>

        <div class="section row">
            <h3><b>תאריך</b></h3><br/>
            <span class="hidden title-shotday">3. Shot Day</span>

            <div class="datepicker-here shotday" data-language='en'></div>
        </div>

        <div class="section row">
            <h3><b>שימושים</b></h3><br/>
            <span class="hidden title-product">4. Product Usage</span>

            <div class="job-product">
                <img src="img/icon.png" alt="icon" class="icon" />
                <h4 class="arial">חנות</h4>
                <h3 class="hidden value">Stores</h3>
                <label class="input-container">
                    <input type="radio" name="product" class="product">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-product">
                <img src="img/icon.png" alt="icon" class="icon" />
                <h4 class="arial">יח״צ</h4>
                <h3 class="hidden value">PR</h3>
                <label class="input-container">
                    <input type="radio" name="product" class="product">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-product">
                <img src="img/icon.png" alt="icon" class="icon" />
                <h4 class="arial">דיגיטל</h4>
                <h3 class="hidden value">Digital</h3>
                <label class="input-container">
                    <input type="radio" name="product" class="product">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-product">
                <img src="img/icon.png" alt="icon" class="icon" />
                <h4 class="arial">אתר</h4>
                <h3 class="hidden value">Ecommerce</h3>
                <label class="input-container">
                    <input type="radio" name="product" class="product">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>

        <div class="section row">
            <b><</b><button type="button" class="btn btn-send btn-lg" id="send" disabled="disabled">שליחה</button>
        </div>

    </div>

    <div class="footer">&copy; HOLB</div>

</body>

<script type="text/javascript">
    $(document).ready(function () {

        $('.s_username').on('click', function() {
            $('.popup').toggleClass('hidden');
        });

        function checkSendEnabled() {
            // check fields
            var sendEnabled = true;
            $('input').each(function(index) {

                if ( ($("input:checked").length != 3) || ($('.shotday').val() === "")) {
                    sendEnabled = false;
                    return false;
                }

            });

            $('#send').prop('disabled', !sendEnabled);
        }

        $('input').on('change', function() {
            checkSendEnabled();
        });

        $('.shotday').on('click', function() {
            checkSendEnabled();
        });

        $('#send').on('click', function() {
            var body = "";

            body += $('.title-type').text() + " : " + $("input.type:checked").parent().parent().find('.value').text() + "</br>\n";
            body += $('.title-size').text() + " : " + $("input.size:checked").parent().parent().find('.value').text() + "</br>\n";
            body += $('.title-shotday').text() + " : " + $('.shotday').val() + "</br>\n";
            body += $('.title-product').text() + " : " + $("input.product:checked").parent().parent().find('.value').text() + "</br>\n";

            // valid
            if (!$('.alert-danger').is(":visible")) {
                $('.alert-info').fadeIn();

                // send with form
                var data = {
                        type: ($("input.type").index($("input.type:checked")) + 1),
                        type_txt: $("input.type:checked").parent().parent().find('.value').text(),

                        size: ($("input.size").index($("input.size:checked")) + 1),
                        size_txt: $("input.size:checked").parent().parent().find('.value').text(),

                        shotday: $('.shotday').val(),
                        product: ($("input.product").index($("input.product:checked")) + 1),
                        product_txt: $("input.product:checked").parent().parent().find('.value').text(),

                        body: body,
                    };
                
                const form = document.createElement('form');
                form.method = 'post';
                form.action = 'user-step3.php';

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