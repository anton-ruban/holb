<?php

require "../curl-mail.php";
require_once "../config.php";

// Initialize the session
session_start();

$id = $_POST['id'];
$model_cnt = $_POST['model_cnt'];

$m1 = mysqli_real_escape_string($conn, $_POST['m1']);
$m1_img = mysqli_real_escape_string($conn, $_POST['m1_img']);
$m1_link = mysqli_real_escape_string($conn, $_POST['m1_link']);

$m2 = mysqli_real_escape_string($conn, $_POST['m2']);
$m2_img = mysqli_real_escape_string($conn, $_POST['m2_img']);
$m2_link = mysqli_real_escape_string($conn, $_POST['m2_link']);

$m3 = mysqli_real_escape_string($conn, $_POST['m3']);
$m3_img = mysqli_real_escape_string($conn, $_POST['m3_img']);
$m3_link = mysqli_real_escape_string($conn, $_POST['m3_link']);

$m4 = mysqli_real_escape_string($conn, $_POST['m4']);
$m4_img = mysqli_real_escape_string($conn, $_POST['m4_img']);
$m4_link = mysqli_real_escape_string($conn, $_POST['m4_link']);

$sqlUpdate = 'UPDATE jobs SET
    m1 = "' . $m1 . '",
    m1_img = "' . $m1_img . '",
    m1_link = "' . $m1_link . '",

    m2 = "' . $m2 . '",
    m2_img = "' . $m2_img . '",
    m2_link = "' . $m2_link . '",

    m3 = "' . $m3 . '",
    m3_img = "' . $m3_img . '",
    m3_link = "' . $m3_link . '",

    m4 = "' . $m4 . '",
    m4_img = "' . $m4_img . '",
    m4_link = "' . $m4_link . '",

    model_cnt = ' . $model_cnt . ',

    status = 3
    
    WHERE
	id = ' . $id;

$result = mysqli_query($conn, $sqlUpdate);

if (!$result) {
    $result = mysqli_error($conn);
}

// get user name
$sqlUserName = "SELECT username, contact_name FROM users u JOIN jobs j ON u.id = j.user_id WHERE j.id = " . $id;
$result = mysqli_query($conn, $sqlUserName);
$user_info = mysqli_fetch_array($result);

$username = $user_info['username'];
$contact_name = $user_info['contact_name'];

// close connection
mysqli_close($conn);

$base_url = "http://" . $_SERVER['SERVER_NAME'] ."/";
$model_url = $base_url . 'step3.php?id=' . $id;

$content = "
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>CHOOSE MODEL</title>
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

                            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
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

                            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-top: 100px;'>
                                <tr>
                                    <td align='left'>
                                        <span style='font-size: 96px;font-weight: bold;color: #19191a;line-height: 115px;margin-left:90px;'>Choose</span><br/>
                                        <span style='font-size: 96px;font-weight: bold;color: #19191a;line-height: 115px;margin-left:90px;'>models.</span><br/>
                                    </td>
                                </tr>
                            </table>

                            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-top: 45px;'>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href='" . $model_url . "' style = 'color: #222;
                                                padding: 5px 50px;
                                                border: 1px solid #222;
                                                border-radius: 30px;
                                                font-size: 40px;
                                                background-color: #fff;
                                                outline: none;
                                                box-shadow: 0 0 10px 0px #ccc;
                                                -moz-box-shadow: 0 0 10px 0px #ccc;
                                                -webkit-box-shadow: 0 0 10px 0px #ccc;
                                                font-family: Arial;
                                                text-decoration: none;
                                                margin-left:90px;'>Click</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='margin-top: 50px; margin-bottom: 50px; text-align: center; font-size: 20px;'>
                                <tbody>
                                    <tr><td >Amount of Models: ".$model_cnt."</td></tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>

</body>

</html>
";

sendMail('TEAM@holb.co', 'Administrator of HOLB', $username, $username, 'Select model from House of Lookbook', $content);

header("location: jobs.php");
exit;
?>
