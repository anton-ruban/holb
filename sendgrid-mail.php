<?php
require "vendor/autoload.php"; // If you"re using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$senderMail = isset($_POST["senderMail"]) ? $_POST["senderMail"] : "TEAM@holb.co";
$senderName = isset($_POST["senderName"]) ? $_POST["senderName"] : "Holb";
$receiverMail = isset($_POST["receiverMail"]) ? $_POST["receiverMail"] : "anton.ruban2018@yandex.com";
$receiverName = isset($_POST["receiverName"]) ? $_POST["receiverName"] : "anton.ruban2018@yandex.com";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "HOLB";
$content = isset($_POST["content"]) ? $_POST["content"] : "Mail from House of Lookbook";

$unsubscribe = '<a href="UNSUBSCRIBE_LINK">Unsubscribe</a>';
// $content .= $unsubscribe;

$htmlContent = "<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>" . $content . "</body>
</html>
";

$email = new \SendGrid\Mail\Mail();
$email->setFrom($senderMail, $senderName);
$email->addTo($receiverMail, $receiverName);
$email->setSubject($subject);
//$email->addContent("text/plain", $content);
$email->addContent("text/html", $content);

if (!empty($_POST["attachment"])) {
    $filename = basename($_POST["attachment"]["name"]);

    $file_encoded = base64_encode(file_get_contents($_POST["attachment"]['tmp_name']));
    $attachment = new \SendGrid\Mail\Attachment();
    $attachment->setType(mime_content_type($_POST["attachment"]['tmp_name']));
    $attachment->setContent($file_encoded);
    $attachment->setDisposition("attachment");
    $attachment->setFilename($filename);
    $email->addAttachment($attachment);
}

$key = trim(file_get_contents('sendgrid.key'));

$sendgrid = new \SendGrid($key);

$data["result"] = false;

try {
    $response = $sendgrid->send($email);

    if (substr($response->statusCode(), 0, 1) === '2') {
        $data["result"] = true;
    } else {
        $data["msg"] = $response->body();
    }
    
} catch (Exception $e) {
    $data["msg"] = $e->getMessage();
}

echo json_encode($data);
?>
