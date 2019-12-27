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

    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>

    <div class="brief">
        2<b>/2 BRIEF</b>

        <span class="brief-summary">
            <?php echo $_POST['type_txt']; ?> /
            <b><?php echo $_POST['size_txt']; ?></b> /
            <?php echo date('d F', strtotime($_POST['shotday'])); ?> /
            <?php echo $_POST['product_txt']; ?>
        </span>
    </div>

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

    <div class="container-fluid">
        <div class="desc-main">
            <p>YOUR</p>
            <p>HOLB</p>
            <p>PROJECT</p>
            <p class="bottom"> </p>
        </div>
    </div>

    <div class="container-fluid text-center">

        <input type="hidden" id="body" value="<?php echo $_POST['body']; ?>">
        
        <div class="section row">
            <h3 class="section"><b>Look & Feel</b></h3>

            <span class="hidden title-result">5. Type of visual</span>

            <div class="job-result">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">A</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">B</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey landscape">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">C</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">D</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey landscape">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">E</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">F</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">G</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey landscape">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">H</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">I</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-result">
                <div class="rect-grey landscape">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">J</h4>
                <label class="input-container">
                    <input type="radio" class="result" name="result">
                    <span class="checkmark"></span>
                </label>
            </div>

        </div>

        <div class="row section-60p">
        
            <h3 class="section"><b>Makeup</b></h3>
            <span class="hidden title-makeup">6. Type of makeup</span>

            <div class="job-makeup">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">A</h4>
                <label class="input-container">
                    <input type="radio" class="makeup" name="makeup">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-makeup">
                <div class="rect-grey landscape">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">B</h4>
                <label class="input-container">
                    <input type="radio" class="makeup" name="makeup">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-makeup">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">C</h4>
                <label class="input-container">
                    <input type="radio" class="makeup" name="makeup">
                    <span class="checkmark"></span>
                </label>
            </div>
        
        </div>

        <div class="row section-60p">
        
            <h3 class="section"><b>Hair</b></h3>
            <span class="hidden title-hair">7. Type of hair</span>

            <div class="job-hair">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">A</h4>
                <label class="input-container">
                    <input type="radio" class="hairday" name="hairday">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-hair">
                <div class="rect-grey landscape">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">B</h4>
                <label class="input-container">
                    <input type="radio" class="hairday" name="hairday">
                    <span class="checkmark"></span>
                </label>
            </div>

            <div class="job-hair">
                <div class="rect-grey portrait">
                    <div class="rect-white"></div>
                </div>

                <h4 class="value hidden">C</h4>
                <label class="input-container">
                    <input type="radio" class="hairday" name="hairday">
                    <span class="checkmark"></span>
                </label>
            </div>
        
        </div>

        <div class="row section-60p">
            <h3><b>לינקים לרפרנסים - אם יש</b></h3>
            <span class="hidden title-ref">8. Additional references</span>
            <h4 class="num-ref">1.</h4> <input type="text" class="form-control input-ref" name="url1" placeholder="http://" />
            <br/>
            <h4 class="num-ref">2.</h4> <input type="text" class="form-control input-ref" name="url2" placeholder="http://" />
        </div>

        <div class="row section-60p">
            <h3><b>הערות נוספות - אם יש</b></h3>
            <span class="hidden title-comment">9. Additional comments</span>
            <textarea name="comment" class="form-control comment" rows="10" cols="50"></textarea>
        </div>

        <div class="row section-60p">
            <h4 class="arial">בלחיצה על כפתור שליחה, המידע שהזנת נשלח לעיבוד נתונים.</h4>
            <h4 class="arial">.לאחר העיבוד, יישלח מייל לבחירה משותפת של הדוגמניות / הדוגמנים המתאימים</h4>
        </div>

        <div class="row section-60p">
            <input type="submit" class="btn btn-black form-control" id="send" disabled="disabled" value="שליחה">
        </div>

    </div>
    
    <div class="div-process content-main text-center">
        <p class="huge">Processing</p>
        <p class="huge">data &</p>
        <p class="huge">preparing</p>
        <p class="huge">models.</p>
        <br/>
        <h4 class="arial">זמן קבלת מייל לבחירת דוגמנים/ות וסיום ההזמנה: יום עבודה.</h4>
        <br/>
        <input type="submit" class="btn btn-black form-control" value="להוספת יום צילום נוסף">
        <br/><br/>
    </div>

    <div class="footer">&copy; HOLB</div>

</body>

<script type="text/javascript">
    $('.div-process').hide();

    $(document).ready(function () {

        $('.s_username').on('click', function() {
            $('.popup').toggleClass('hidden');
        });

        $('input').on('change', function() {
            // check fields
            var sendEnabled = true;
            $('input').each(function(index) {

                if ($("input:checked").length != 3) {
                    sendEnabled = false;
                    return false;
                }

            });

            $('#send').prop('disabled', !sendEnabled);
        });

        $('#send').on('click', function() {

            // processing
            $('.brief').html("<b>PROCESSING...</b>");
            $('.desc-main').parent().removeClass("container-fluid");
            $('.desc-main').html('<p>BACK</p><p>OFFICE</p><p class="bottom"></p>');

            $('.container-fluid').hide();
            $('.div-process').fadeIn();

            var body = $('#body').val();

            body += $('.title-result').text() + " : " +  $("input.result:checked").parent().parent().find('.value').text() + "</br>\n";
            body += $('.title-makeup').text() + " : " + $("input.makeup:checked").parent().parent().find('.value').text() + "</br>\n";
            body += $('.title-hair').text() + " : " + $("input.hairday:checked").parent().parent().find('.value').text() + "</br>\n";
            body += $('.title-ref').text() + " : 1. " + $('input[name=url1]').val() + " 2. " + $('input[name=url2]').val() + "</br>\n";
            body += $('.title-comment').text() + " : " + $('textarea.comment').val() + "</br>\n";

            // insert db
            $.ajax({
                url: 'insert-job.php',
                data: {
                    type: "<?php echo $_POST['type']; ?>",
                    size: "<?php echo $_POST['size']; ?>",
                    shotday: "<?php echo $_POST['shotday']; ?>",
                    product: "<?php echo $_POST['product']; ?>",

                    result: ($("input.result").index($("input.result:checked")) + 1),
                    makeup: ($("input.makeup").index($("input.makeup:checked")) + 1),
                    hairday: ($("input.hairday").index($("input.hairday:checked")) + 1),
                    reference: $('input[name=url1]').val() + " " + $('input[name=url2]').val(),
                    comment: $('textarea.comment').val(),
                },
                type: "POST",
                success: function (result) {

                    // send mail and show result
                    var data = {
                        body: body,
                    };
                    
                    const form = document.createElement('form');
                    form.method = 'post';
                    form.action = 'send-mail.php';

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
    });
</script>

</html>