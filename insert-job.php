<?php
require_once "config.php";

// Initialize the session
session_start();

$user_id = $_SESSION["id"];
$type = $_POST['type'];
$size = $_POST['size'];
$shotday = $_POST['shotday'];
$product = '"' . $_POST['product'] . '"';
$result = $_POST['result'];
$makeup = $_POST['makeup'];
$hairday = $_POST['hairday'];
$reference = mysqli_real_escape_string($conn, $_POST['reference']);
$comment = mysqli_real_escape_string($conn, $_POST['comment']);

// set status
$status = 1;

$sqlInsert = "INSERT INTO jobs (user_id, type, size, shotday, product, result, makeup, hairday, reference, comment, status) VALUES ({$user_id}, {$type}, {$size}, '{$shotday}', {$product}, {$result}, {$makeup}, {$hairday}, '{$reference}', '{$comment}', {$status});";
$result = mysqli_query($conn, $sqlInsert);

if (!$result) {
    $result = mysqli_error($conn);
}
mysqli_close($conn);

echo $result;

?>
