<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$id = 0;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

// Include config file
require_once "../config.php";

// get jobs with user contact info
$sql = "SELECT
    u.username,
    u.contact_name,
    u.company,
    u.phone,
    u.hp,
    u.address,
    
    type.title as type,
    size.title as size,
    j.product,
    shotday.title as shotday_result,
	makeup.title as makeup,
	hairday.title as hairday,

    s.status,
	
    j.shotday,
    j.url1,
    j.url2,
	j.comment,
    j.m1,
    j.m2,
    j.m3,
    j.m4,
    j.price

    FROM
    jobs j
    JOIN users u ON u.id = j.user_id
    JOIN job_type type ON type.id = j.type
    JOIN job_size size ON size.id = j.size
    JOIN job_shotday shotday ON shotday.id = j.result
    JOIN job_makeup makeup ON makeup.id = j.makeup
    JOIN job_hairday hairday ON hairday.id = j.hairday
    JOIN job_status s ON s.id = j.status

    WHERE j.id = " . $id;

$result = mysqli_query($conn, $sql);

if (!$result) {
    $result = mysqli_error($conn);
}

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

    .data-table tbody tr:nth-child(odd) td {
        background-color: #f4fbff;
    }
    .data-table tbody tr:hover {
        background-color: #ffffa2;
        border-color: #ffff0f;
    }

    /* Table Footer */
    .data-table tfoot th {
        background-color: #e5f5ff;
        text-align: right;
    }
    .data-table tfoot th:first-child {
        text-align: left;
    }
    
    .url {
        width: 600px;
        margin-left: 20px;
    }

    .model {
        margin: 10px 0;
    }

    label {
        width: 135px;
    }

    input[type=text] {
        width: 500px;
    }

    .float-left {
        float: left;
    }
</style>

    <div id="wrapper">

        <?php include("nav.php"); ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="page-header">Job Detail</h1>
                    
                    <?php while ($row = mysqli_fetch_array($result)) { ?>

                    <div class="div-user-info">
                        <div><h4>Company: <?php echo $row['company'];?> </h4></div>
                        <div><h4>Contact: <?php echo $row['contact_name'];?> </h4></div>
                        <div><h4>Phone: <?php echo $row['phone'];?> </h4></div>
                        <div><h4>HP: <?php echo $row['hp'];?> </h4></div>
                        <div><h4>Email: <?php echo $row['username'];?> </h4></div>
                        <div><h4>Address: <?php echo $row['address'];?> </h4></div>
                    </div>

                    <div class="div-flex">

                        <div class="div-model-section">
                        
                        <?php if ($row['status'] === 'Created') { ?>

                        <form method="post" action="send-model.php">

                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                            <h3>Select Model</h3>

                            <div class="model">
                                <label>Amount of Models:</label>
                                <input type="number" id="model_cnt" name="model_cnt" min="1" max="4" value="4">
                            </div>
                            
                            <div class="model" id="m1">
                                <label>Model 1</label><br/>
                                <label>Name:</label><input type="text" name="m1"><br/>
                                <label>Image(URL):</label><input type="text" name="m1_img"><br/>
                                <label>Link:</label><input type="text" name="m1_link"><br/>
                            </div>
                        
                            <div class="model" id="m2">
                                <label>Model 2</label><br/>
                                <label>Name:</label><input type="text" name="m2"><br/>
                                <label>Image(URL):</label><input type="text" name="m2_img"><br/>
                                <label>Link:</label><input type="text" name="m2_link"><br/>
                            </div>

                            <div class="model" id="m3">
                                <label>Model 3</label><br/>
                                <label>Name:</label><input type="text" name="m3"><br/>
                                <label>Image(URL):</label><input type="text" name="m3_img"><br/>
                                <label>Link:</label><input type="text" name="m3_link"><br/>
                            </div>

                            <div class="model" id="m4">
                                <label>Model 4</label><br/>
                                <label>Name:</label><input type="text" name="m4"><br/>
                                <label>Image(URL):</label><input type="text" name="m4_img"><br/>
                                <label>Link:</label><input type="text" name="m4_link"><br/>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg" id="send">Send Models to Customer Approval</button>
                            <br/><br/><br/>

                        </form>

                        <?php } else if ($row['status'] === 'Send to customer model approval') { ?>
                            <h3>Selected model(s) sent to customer</h3>

                            <?php if ($row['m1'] != '') { ?>
                                <div class="model"><label><?php echo $row['m1']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m2'] != '') { ?>
                                <div class="model"><label><?php echo $row['m2']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m3'] != '') { ?>
                                <div class="model"><label><?php echo $row['m3']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m4'] != '') { ?>
                                <div class="model"><label><?php echo $row['m4']; ?></label></div>
                            <?php } ?>
                            
                        <?php } else if ($row['status'] === 'Customer model confirmation') { ?>
                            <h3>Selected Model</h3>

                            <?php if ($row['m1'] != '') { ?>
                                <div class="model"><label><?php echo $row['m1']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m2'] != '') { ?>
                                <div class="model"><label><?php echo $row['m2']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m3'] != '') { ?>
                                <div class="model"><label><?php echo $row['m3']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m4'] != '') { ?>
                                <div class="model"><label><?php echo $row['m4']; ?></label></div>
                            <?php } ?>
                            
                            <form method="post" action="send-price.php" name="sendPriceForm" enctype="multipart/form-data" onsubmit="return validateSendPriceForm()">
                                <h4>Comment</h4>
                                <textarea name="comment" class="comment" rows="5" cols="100"></textarea>
                                <h4>Terms of payment</h4>
                                <input name="terms_of_payment" type="number" class="terms_of_payment" min="1" max="1000000">

                                <h4>Price Quote</h4>
                                
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <input name="price" type="number" class="price" min="1" max="1000000">

                                <h4>Attachment</h4>
                                <input name="attachment" type="file">
                                
                                <br/><br/>
                                <button type="submit" class="btn btn-primary btn-lg" id="send_price">Send Price Quote</button>
                            </form>
                            
                            <br/><br/><br/>

                        <?php } else if ($row['status'] === 'Customer approved') { ?>
                            <h3>Selected Model</h3>

                            <?php if ($row['m1'] != '') { ?>
                                <div class="model"><label><?php echo $row['m1']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m2'] != '') { ?>
                                <div class="model"><label><?php echo $row['m2']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m3'] != '') { ?>
                                <div class="model"><label><?php echo $row['m3']; ?></label></div>
                            <?php } ?>

                            <?php if ($row['m4'] != '') { ?>
                                <div class="model"><label><?php echo $row['m4']; ?></label></div>
                            <?php } ?>
                            
                            <h3>Approved Price</h3>

                            <?php if ($row['price'] != '') { ?>
                                <div class="model"><label><?php echo $row['price']; ?>$</label></div>
                            <?php } ?>
                            
                        <?php } ?>

                        </div>
                        
                        <div class="div-job-section">
                            <h3>Job information</h3>
                            <h4>Shot Type: <?php echo $row['type'];?> </h4>
                            <h4>Package Size: <?php echo $row['size'];?> </h4>
                            <h4>Product Usage: <?php echo $row['product'];?> </h4>
                            <h4>Shotday: <?php echo date('F d, Y', strtotime($row['shotday'])); ?></h4>
                            <h4>Look & Feel: <?php echo $row['shotday_result'];?> </h4>
                            <h4>Makeup: <?php echo $row['makeup'];?> </h4>
                            <h4>Hair: <?php echo $row['hairday'];?> </h4>
                            <h4>Url1: <?php echo $row['url1'];?> </h4>
                            <h4>Url2: <?php echo $row['url2'];?> </h4>
                            <h4>Comment: <?php echo $row['comment'];?> </h4>
                            <h4>Status: <?php echo $row['status'];?> </h4>
                        </div>
                    </div>

                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
</body>

<script type="text/javascript">
    function validateSendPriceForm() {
        var termsOfPaymentValue = document.forms["sendPriceForm"]["terms_of_payment"].value;
        var priceValue = document.forms["sendPriceForm"]["price"].value;

        if (termsOfPaymentValue == "") {
            alert("Terms of payment must be filled out");
            return false;
        }
        if (priceValue == "") {
            alert("Price Quote must be filled out");
            return false;
        }
    }

    $(document).ready(function () {

        $('input#model_cnt').on('keyup', function() {
            // show models
            var count = $(this).val();

            for (var i = 1 ; i < 5; i ++) {
                if (i <= count)
                    $('#m' + i).show();
                else
                    $('#m' + i).hide();
            }

        });
        
    });
</script>

</html>
