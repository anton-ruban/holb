<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "../config.php";

// get jobs with user contact info
$sql = "SELECT
        j.id,
        u.contact_name,
        u.company,
        u.phone,
        type.title as type,
        size.title as size,
        j.product,
        j.shotday,
        s.status
    FROM
        jobs j
    JOIN users u ON u.id = j.user_id
    JOIN job_type type ON type.id = j.type
    JOIN job_size size ON size.id = j.size
    JOIN job_status s ON s.id = j.status
    ORDER BY j.created_at DESC";

$result = mysqli_query($conn, $sql);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="holb">

    <title>Holb Dashboard</title>
    <link rel="icon" href="favicon.png" sizes="any" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/fullcalendar.min.css" />

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/menuinit.js"></script>
    <!-- Calendar JavaScript -->
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.min.js"></script>
    <!-- bootbox code -->
    <script src="js/bootbox.min.js"></script>

</head>

<body>

<script>
    $(document).ready(function () {
        $("#side-menu a").removeClass("active");
        $("#side-menu a.jobs").addClass("active");
    });
</script>

    <style type="text/css">
		
		table {
			margin: auto;
			font-size: 12px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			width: 100%;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}

		.data-table tbody tr:nth-child(odd) {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover {
			background-color: #ccc;
            cursor: pointer;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
	</style>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("nav.php"); ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="page-header">Jobs</h1>

                    <table class="data-table">
                    <!-- <caption class="title">Jobs Data</caption> -->
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>CONTACT NAME</th>
                            <th>COMPANY</th>
                            <th>PHONE</th>
                            <th>SHOT DAY</th>
                            <th>TYPE</th>
                            <th>SIZE</th>
                            <th>PRODUCT</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no 	= 1;
                    while ($row = mysqli_fetch_array($result))
                    {
                        echo '<tr>
                                <input type="hidden" id="id" value="' . $row['id'] . '">
                                <td>'.$no.'</td>
                                <td>'.$row['contact_name'].'</td>
                                <td>'.$row['company'].'</td>
                                <td>'.$row['phone'].'</td>
                                <td>'. date('F d, Y', strtotime($row['shotday'])) . '</td>
                                <td>'.$row['type'].'</td>
                                <td>'.$row['size'].'</td>
                                <td>'.$row['product'].'</td>
                                <td>'.$row['status'].'</td>
                            </tr>';
                        $no++;
                    }?>
                    </tbody>
                    <tfoot>
                        <tr>
                        </tr>
                    </tfoot>
                </table>
                
                </div>
            </div>
        </div>

    </div>
</body>


<script>
$(document).ready(function () {
    $(document).on("click", ".data-table tbody tr", function(e) {
        window.location.href = "job-detail.php?id=" + $(this).find('#id').val();
    });
});
</script>

</html>