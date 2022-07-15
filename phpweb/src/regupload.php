<?php

session_start();


include('conn.php');

include('classes/user.php');
include('functions.php');




$userName = $conn->real_escape_string($_POST['reguser']);
$password = $conn->real_escape_string($_POST['regpassword']);
$name = $conn->real_escape_string($_POST['regname']);
$email = $conn->real_escape_string($_POST['regemail']);
$userAlreadyAdded;
$sql = "SELECT * FROM proto_users WHERE Username='$userName';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userAlreadyAdded = true;
} else {
    $userAlreadyAdded = false;
    $newUser = new User($name, $email, $userName, $password);

    addNewUser($newUser);
}


$newUser = new User($name, $email, $userName, $password);

addNewUser($newUser);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REG UPLOAD PAGE</title>
    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="icon" href="img/favicon.png" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="content">
    <header>
        <div class="logo text-center">
            <?php
            if($userAlreadyAdded=true){
                echo "<h2>ERROR: $userName ALREADY REGISTERED</h2>";
            }else{
                echo "<h2>WELCOME $userName YOU ARE NOW REGISTERED</h2>";
            }
            
            ?>
        </div>
    </header>
    <div class="container">


        <div class="row">
            <ul class="page-links">
                <li><a href="login.php">Back to Login?</a></li>
            </ul>
            <div class="copyright-box">
                <div class="copyright">
                    <!--Do not remove Backlink from footer of the template. To remove it you can purchase the Backlink !-->
                    &copy; 2021 All right reserved. Designed by <strong>BOOKAHOLIC.</strong>
                </div>
            </div>
        </div>
    </div>
</body>

</html>