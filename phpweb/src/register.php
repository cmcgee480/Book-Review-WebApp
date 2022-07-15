<?php




include('conn.php');





?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIGN UP PAGE</title>
        <!-- Bootstrap core CSS -->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">  
        <!-- Custom styles for this template -->
        <link rel="icon" href="img/favicon.png"/>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="content">
        <header>
            <div class="logo text-center">
                <h2>SIGN UP PAGE</h2>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-offset-3 col-xs-6 width-100">
                    <form method="POST" action="regupload.php">
                        <div class="loginpage">
                            
                            <input class="form-control placeholder-fix" type="text" placeholder="Username" name="reguser">
                            <input class="form-control placeholder-fix" type="text" placeholder="Password" name="regpassword">
                            <input class="form-control placeholder-fix" type="text" placeholder="Full Name" name="regname">
                            <input class="form-control placeholder-fix" type="email" placeholder="Email" name="regemail">
                        </div>
                        <div class="action-button">
                            <button class="btn-block" type="submit">JOIN</button> 
                        </div>
                    </form>
                </div>

                
            </div>
            
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
