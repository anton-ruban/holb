<!-- <?php
$to = 'yuping15@yandex.com';
$subject = 'Marriage Proposal';
$from = 'peterparker@email.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">Hi Jane!</h1>';
$message .= '<p style="color:#080;font-size:18px;">Will you marry me?</p>';
$message .= '</body></html>';
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
?> -->

<html lang="en">
<head>

<meta charset="UTF-8"><meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="css/fonts.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>

  <div class="center logo-div">
    <img src="img/logo.svg" alt="logo" class="logo" />
  </div>
  
  <div class="description">
    <p>Ecommerce visual.</p>
    <p>Finally solved.</p>
    <p>Be the first to try it.</p>
  </div>

  <div class="mail-box">
    <div class="mail-border">
        <input type="text" class="mail" placeholder="Your mail here" />
    </div>
    <input type="button" class="send" value="Send" />
  </div>

</body>

</html>