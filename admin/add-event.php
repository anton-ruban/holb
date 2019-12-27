<?php
require_once "../config.php";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$start = isset($_POST['start']) ? $_POST['start'] : "";
$end = isset($_POST['end']) ? $_POST['end'] : "";
$size = isset($_POST['size']) ? intval($_POST['size']) : 0;
$color = isset($_POST['color']) ? $_POST['color'] : "#3a87ad";
$custom = isset($_POST['custom']) ? $_POST['custom'] : "";
$type = isset($_POST['type']) ? intval($_POST['type']) : 0;

// get size count by date
$sqlSizes = "SELECT count(id) as cnt, package_size FROM events WHERE `start` = '". $start . "' GROUP BY package_size";
$result = mysqli_query($conn, $sqlSizes);

if (! $result) {
    $result = mysqli_error($conn);
}

$canAdd = true;

/* package size limit case
1L + 2S
2M + 2S
7S
*/
/*

$canAdd = false;

$cnt_s = 0;
$cnt_m = 0;
$cnt_l = 0;

while ($row = mysqli_fetch_array($result)) {
    if ($row['package_size'] === '1') {
        $cnt_s = intval($row['cnt']);
    } else if ($row['package_size'] === '2') {
        $cnt_m = intval($row['cnt']);
    } else if ($row['package_size'] === '3') {
        $cnt_l = intval($row['cnt']);
    }
}

if ($size === 1) {
    // add small
    if (($cnt_l <= 1 && $cnt_m === 0 && $cnt_s <= 1) ||
        ($cnt_l === 0 && $cnt_m <= 2 && $cnt_s <= 1) ||
        ($cnt_l === 0 && $cnt_m === 0 && $cnt_s <= 6)) {
        $canAdd = true;
    }
} else if ($size === 2) {
    // add medium
    if ($cnt_l === 0 && $cnt_m <= 1 && $cnt_s <=2) {
        $canAdd = true;
    }
} else if ($size === 3) {
    // add large
    if ($cnt_l === 0 && $cnt_m === 0 && $cnt_s <=2) {
        $canAdd = true;
    }
}
*/

if ($canAdd) {
    $sqlInsert = "INSERT INTO events (title,start,end,package_size,color,custom,type) VALUES ('".$title."','".$start."','".$end ."', ".$size.", '". $color ."','".$custom."','".$type . "')";
    $result = mysqli_query($conn, $sqlInsert);
    
    if (! $result) {
        $result = mysqli_error($conn);
    }
}

echo json_encode($canAdd);

?>