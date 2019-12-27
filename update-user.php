<?php
require_once "config.php";

// Initialize the session
session_start();

$user_id = $_SESSION["id"];
$contact_name = $_POST['contact_name'];
$hp = $_POST['hp'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$address = $_POST["address"];

$sqlUpdate = "UPDATE users SET contact_name='" . $contact_name . "', hp='" . $hp . "', phone='" . $phone . "', company='" . $company . "', address='" . $address . "' WHERE id='" . $user_id ."'";

$result = mysqli_query($conn, $sqlUpdate);
mysqli_close($conn);

echo $result;

?>