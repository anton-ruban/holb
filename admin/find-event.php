<?php
require_once "../config.php";

$start = isset($_POST['start']) ? $_POST['start'] : "";
$type = isset($_POST['type']) ? intval($_POST['type']) : 0;

// get size count by date
$sqlSizes = "SELECT count(id) as cnt FROM events WHERE `start` = '". $start . "' AND `type` = ". $type;
$result = mysqli_query($conn, $sqlSizes);
$find = false;

if ($result) {
    $result = mysqli_fetch_array($result);
    if (intval($result[0]) > 0) {
        $find = true;
    }
}

echo json_encode($find);
?>