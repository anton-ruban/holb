<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if logged in redirect to homepage
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: dashboard.php");
  exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$usertype = 0;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, usertype FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $usertype);

                    if(mysqli_stmt_fetch($stmt)){
                        // Check user type
                        if ($usertype != 1) {
                            $username_err = "This user is not administrator.";
                        } else {
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                                
                                // Redirect user to welcome page
                                header("location: dashboard.php");
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>
    <link rel="icon" href="favicon.png" sizes="any" type="image/png">

    <link rel="stylesheet" type="text/css" href="../css/fonts.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="../js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>

<body>
    <div class="center logo-div">
        <img src="../img/logo.svg" alt="logo" class="logo" />
    </div>

    <div class="form-user">
        <h1>Admin Login</h1>
        <br/>
    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <br/>
            <div class="form-group">
                <input type="submit" class="btn btn-black form-control" value="Login">
            </div>
            <br/>
            <p class="center">Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>

    </div>
</body>
</html>