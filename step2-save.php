<?php
require_once "config.php";

// Initialize the session
session_start();

$user_id = $_SESSION["id"];
$job_id = $_POST["id"];
$type = $_POST['type'];
$size = $_POST['size'];
$shotday = $_POST['shotday'];
$product = '"' . $_POST['product'] . '"';
$result = $_POST['result'];
$makeup = $_POST['makeup'];
$hairday = $_POST['hairday'];
$url1 = mysqli_real_escape_string($conn, $_POST['url1']);
$url2 = mysqli_real_escape_string($conn, $_POST['url2']);
$comment = mysqli_real_escape_string($conn, $_POST['comment']);

// set status
$status = 1;

$sql = "update jobs set user_id = {$user_id}, type = {$type}, size = {$size}, shotday = '{$shotday}', product = {$product}, result = {$result}, makeup = {$makeup}, hairday = {$hairday}, url1 = '{$url1}', url2 = '{$url2}', comment = '{$comment}', status = ${status} where id = {$job_id};";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $result = mysqli_error($conn);
}
mysqli_close($conn);

$return['id'] = $job_id;
$return['result'] = $result;

echo json_encode($return);

?>