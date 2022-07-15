<?php

include('conn.php');


session_start();

if (isset($_POST["username"])) {


    $adminuser = $_POST["username"];

    $adminpassword  = $_POST["password"];

    $sql = "SELECT * FROM proto_users WHERE Username = '$adminuser' AND password='$adminpassword'";

    $result = $conn->query($sql);

    $numrows = $result->num_rows;

    if ($numrows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION["bookuser"] = $row["Username"];
        }

        header("Location: index.php ");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN PAGE</title>
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
            <h2>BOOKAHOLIC LOG IN</h2>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-offset-3 col-xs-6 width-100">
                <form method="POST" action="login.php">
                    <div class="loginpage">

                        <input class="form-control placeholder-fix" type="text" placeholder="Username" name="username">
                        <input class="form-control placeholder-fix" type="password" placeholder="Password" name="password">

                    </div>
                    <div class="action-button">
                        <button class="btn-block" type="submit">LOG ON</button>
                        <a href="register.php" class="btn-block">SIGN UP</a>

                        
                    </div>
                </form>
            </div>


        </div>

        <div class="row">
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