<?php

function sendMail($senderMail, $senderName, $receiverMail, $receiverName, $subject, $content, $attachedFile) {
    //The url you wish to send the POST request to
    $url = "http://" . $_SERVER['SERVER_NAME'] ."/sendgrid-mail.php";

    //The data you want to send via POST
    $fields = array(
        'senderMail'      => $senderMail,
        'senderName'      => $senderName,
        'receiverMail'    => $receiverMail,
        'receiverName'    => $receiverName,
        'subject'         => $subject,
        'content'         => $content,
        'attachment'      => $attachedFile
    );

    //url-ify the data for the POST
    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    //execute post
    $result = curl_exec($ch);
    // echo $result;
}

?>
