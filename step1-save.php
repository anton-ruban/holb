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

if ($job_id == 0) {
    // insert
    $sql = "INSERT INTO jobs (user_id, type, size, shotday, product) VALUES ({$user_id}, {$type}, {$size}, '{$shotday}', {$product});";
    $result = mysqli_query($conn, $sql);
    $return['id'] = $conn->insert_id;
} else {
    // update
    $sql = "update jobs SET user_id = {$user_id}, type = {$type}, size = {$size}, shotday = '{$shotday}', product = {$product} where id = {$job_id};";
    $result = mysqli_query($conn, $sql);
    $return['id'] = $job_id;
}

if (!$result) {
    $result = mysqli_error($conn);
}
mysqli_close($conn);

$return['result'] = $result;

echo json_encode($return);

?>