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

    <div class="login">
        <a href="login.php" class="log-user">Login</a>
        <img src="img/login.png" alt="user" class="img-user" />
    </div>

    <div class="center logo-div">
        <a href="main.php"><img src="img/logo.svg" alt="logo" class="logo" /></a>
    </div>

    <div class="flex-column">

        <div class="description">
            <p>Ecommerce visual.</p>
            <p>Finally solved.</p>
            <p>Be the first to try it.</p>

            <div style="margin-top: 50px;">
                <button class="btn-round btn-long" id="start">Start your project</button>
            </div>
        </div>

        <div class="dash-border"></div>
        
        <div style="margin-left: 35px; margin-top: 30px;">
            <h4><b>Sign up for updates</b></h4>
        </div>
        
        <div class="flex">
            <div class="mail-border">
                <input type="text" class="mail" name="mail" placeholder="Your mail here" />
                <p class="alert"></p>
            </div>

            <div style="padding: 0 10px 50px;">
                <input type="submit" class="btn-round send" id="send" value="Send" />
            </div>
        </div>

    </div>

    <div class="footer">
        &copy; HOLB
        <a href="./terms.php">תנאי שימוש</a>
    </div>

</body>

<script type="text/javascript">
    function validateEmail(mail) {
        var emailReg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (emailReg.test(mail)) {
            return true;
        } else {
            return false;
        }
    }

    $('#send').click(function() {
        $(this).val('Sending');
        $('.alert').hide();
        $('.mail-border').removeClass('red-back');
        var mail = $('.mail').val();

        if (!validateEmail(mail)) {
            $('.alert').html("Invalid Email Address");
            $('.alert').show();
            $('.mail-border').addClass('red-back');

            $(this).val('Send');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "sendgrid-mail.php",
            data: {
                "senderMail" : "TEAM@holb.co",
                "senderName" : "Administrator",
                "receiverMail" : "nuna@holb.co",
                "receiverName" : "Nuna",
                "subject" : "House of Lookbook",
                "content" : mail + " is succcessfully registered!",
            },
        }).done(function(data) {
            $('.send').val('Send');

            var parsed_data = JSON.parse(data);

            if (parsed_data.result)
                alert("Message sent successfully!");
            else
                alert("Message sent failure");
        });
    });

    $('#start').click(function() {
        window.location.href = "/main.php";
    });
</script>

</html>
