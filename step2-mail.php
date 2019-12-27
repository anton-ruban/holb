<?php

require "curl-mail.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$body = isset($_POST['body']) ? $_POST['body'] : 'Empty body';

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
        2/<b>3</b>&nbsp;&nbsp;YOUR HOLB PROJECT

        <span class="brief-summary">SENDING MAIL</span>
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
            <h1>Thanks for your request.</h1>
            <h4>Here is the information you submitted recently.</h4>
            <h4 style="line-height: 30px;"><?php echo $_POST['body']; ?></h4>
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

$content = "
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>RECEIVE</title>
    <meta name='viewport' content='width=device-width' initial-scale='1'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <style>
        * {font-family: Roboto, sans-serif;}
    </style>
</head>

<body id='body' style='margin:0px; padding:0px;'>
    <table bgcolor='#ffffff' role='presentation' aria-hidden='true' cellspacing='0' cellpadding='30' border='0'
        align='center'>
        <tr>
            <td>
                <!-- Main -->
                <table bgcolor='#ffffff' role='presentation' aria-hidden='true' cellspacing='0' cellpadding='0'
                    style='width:700px; border: 1px dashed #535353;'>
                    <tr>
                        <td>

                            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-bottom: 50px;'>
                                <tr>
                                    <td align='center'>
                                        <img src='data:image/jpg;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAA5CAQAAADZn6ypAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA
                                        IGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAb4SURBVHja7Jw/cBtF
                                        FMZ/YlIxI4n2xr42DJKGoYCJc9CRYLlMYqE6xhq6jG3UgiYuaGKbYYYKGVwSy4YylmcoydmEGZpI
                                        7iiYE70ldzSPQqvVnXV3lh2FO8n61Jxu9/bPfbvvvX379hIfyV/4YYY/CMPXfBeQUuddosYX/BSQ
                                        8gczI6xng61LPpEiC6TJYnHbJ/0GU/yv6HCkhu0mKfIsk/OkvzF9RVGSU+MTlmhPCYkT6tyiMSUk
                                        XjNlUVMSKx1yhA00aZMjhcltzGtDyRIv4kSIzTZ1DzVdzFLk02tBS4sNyvEQWTZ3WfTQ4W7mJrdY
                                        8ai9ScV2PHTIJos0L8hT465L7U2u2LKjJqTNXTaHnNCfsDvxlNhR65DKhXPDjVVMrDF5tXP8EvDK
                                        qxwGPuVEO0O+onbJJ5bGXnBZ7JCJJyGOUmKXk7KVCRBMxdDUyAi52qvtrlTGG7Mh8ycyQhoBZu4w
                                        Vtm44ygwJRudUq+FqEML6LDLWUB3nLFeKNqBojqJFUZIh43Qgl+8llHymJK6+oIHnAR0qTgG627/
                                        mVwPsStLpMMIObv01stlFLp/s+Y1HZBmhzu+s6Q+xoSEGcrl6JS6E3B/3fPPJO+bq8nkIcNOlFaW
                                        PyEzA7ohHzD6Jg3L/EpaXd+IDyGDqjrH5KNA2dPzGG1QWUNQFC7yxhF7VDxrqxgR0hk652Q54+ss
                                        upbJMSKkMfRMmDxRVmUpSkLSQyrryd8Dcc+TlegIyQYQ4gw00t8am0zUOIjKysoG3K/wo0dg7Q2p
                                        /OOHmYDFq0M9wCUEsMVCMCFJ16rZD7+9gvMkTcbXLVKnqmtta6k6joSYat3try+CPN1NGsGEpEKK
                                        BPj3lbxZVoCfqkKNPF3nYmeMCQlDCTtw17Aelbe3FOjzbF7gGpmbgKCgTwMJsaMye00KV3yyPAHq
                                        Ox2SFtk65Govdm7sBVZXCgThJLqoE5PHl97GTWqf6NXxJ38Pnfc93nwNPW+HuOYzUYYBlWgEGLZB
                                        2Amd7MPh80vk/TUkQuSqZByyEeokijQuax2GpiTJ+hiJqxMe+KxBWkPIjUgJSfMt6aHCgZL8PFYe
                                        rE5IKEMY8tE7F9fZZ+6CPMu8uBZ7I8mwlfr/B4tfOKCG7eNUmGGB0rU5JVIiNudDFlgAbGygQwML
                                        SJO/NlR0B1+ZmJ2gsiZilXFVcbUT7cJwCn+jZUpIDDDvMlqmHw6IGAWKHkE9JSQizJEjS37A95AQ
                                        mb6cq8O5dEiSeYHlOCUkZpgq9SkhU4RhhErdoUWGtOcK2pzo70I1OFP3+1cOLWaVXHX7QzMeddcg
                                        rWWvTULfv63vpc55u9z19vJkXW3q1tngTNc+2J+2p0x3if0e2iTOtfUVISPDEzHkuefqVB6KIYYY
                                        8r2IiNzTOXpXX6r0+3Kqnuv9nutyn8nbYoghd+SliIgrj6HzGHLP1ZJTuS+GGPK2PHW1zRBDHsqp
                                        iDwXQ56IyDMx5KacynNXiU9EROSl3FElPFMl9nqy4enh92LIx3I6upcor9XsXeGQebLUqTDLwkD6
                                        AdvMU6LJAVW1qVtQ49XUc+MzkqzRYVt/oGXmgiM7DzlW9XbPtlfZIkOeJnWSfKtLXiXJz2p0FyjS
                                        5iu2KAFLtFgmRZVVcphsUlclbpLSoUq7VMjoEmInsgCaJOgHhR4yww5Q5BZVH0LSQIsWOVcMWI6c
                                        R4jUgXWKQJs9bCzgLT4cEGpuUXOsDsB067U4AHYwgQ/YU4Q4LCKuXZYECd4iQRJo0qLAOmCyyi5l
                                        tlVPSrxDTbXWZstFaEwJqXhkdi+GygTfOCyLeQ5ZAVJ8owirAGuuEAib3sEdE2hiAU0eAPsBrkjH
                                        84QDHJPS8+4fFTG8BxRcOqKmDqKukR6os6FnbJqMDlHYAtZHTMfIrawCa6ypDacsvfj1Nt3T2ea5
                                        JRLs8Ds/sExHn2h8zL5HIHVfCXSPK8wqhb/PfmBAako/0Vb/MnoXu6NbMU+SPdfJjAL77JNhS53y
                                        7ZdgkgO9V3OiY4sLQGXkAeEjJqRImbIauWkyHFPFoaLmSg7Y5IgaxyQx2eUBdRYoAf31aYIWR7qj
                                        eaCCwwE1kmpEp7Cwzo3NM47UL8cMh9Rc9VrACg5VTrSgy7KO+2MdJhamsvsskmxj02BLWXJzNKni
                                        sEI/crLIGh1WR31a5XVaWS/lprJNupbIqXysrZln5/4/PWdl9a2mR5485y0q8bG8+vXeUzZSr56b
                                        8tJlZT0VQz44Z2W9L6cqpft7pKwub096PXwkhtyRUWKErhMbmyKm56pNHYesS6Ef0PTsBdrYanT2
                                        dgx7I7boWoXUXc9seNJQ9/oo040ybw/UaypnnsOu2gzbxSFLTn/6ydTuvm4Jea1luj3p1dzvYdWT
                                        69Xx3wC9dE0P0TGDaQAAAABJRU5ErkJggg==' style='width:200px; margin-top: 25px;' alt='HOLB' />
                                    </td>
                                </tr>
                            </table>

                            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-top: 75px;'>
                                <tr>
                                    <td align='left'>
                                        <span style='font-size: 96px;font-weight: bold;color: #19191a;line-height: 115px;margin-left:90px;'>Data</span><br/>
                                        <span style='font-size: 96px;font-weight: bold;color: #19191a;line-height: 115px;margin-left:90px;'>Received.</span>
                                    </td>
                                </tr>
                            </table>

                            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-top: 45px;'>
                                <tbody>
                                    <tr>
                                        <td style='width: 100px;'></td>
                                        <td style='padding: 45px;
                                        border: 1px solid #222;
                                        border-radius: 10px;
                                        font-size: 24px;
                                        background-color: #fff;
                                        outline: none;
                                        box-shadow: 0 0 10px 0px #ccc;
                                        -moz-box-shadow: 0 0 10px 0px #ccc;
                                        -webkit-box-shadow: 0 0 10px 0px #ccc;
                                        text-align: center;'>
                                                In 1 business day you'll receive a follow-up email.
                                        </td>
                                        <td style='width: 100px;'></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='height: 250px;'>
                                <tr><td></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

</body>

</html>";

sendMail('TEAM@holb.co', 'Administrator of HOLB', 'info@holb.co', 'info@holb.co', 'House of Lookbook', $content);
sendMail('TEAM@holb.co', 'Administrator of HOLB', 'nuna@holb.co', 'nuna@holb.co', 'House of Lookbook', $content);
sendMail('TEAM@holb.co', 'Administrator of HOLB', $_SESSION["username"], $_SESSION["username"], 'House of Lookbook', $content);

?>
