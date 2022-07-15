<?php

include('conn.php');


session_start();

$sql = 'SELECT `reviewID`,proto_reviews.bookID,books.title,proto_reviews.userID,proto_users.FullName,`review`,books.url
FROM proto_reviews JOIN books 
ON proto_reviews.bookID = books.bookID JOIN proto_users 
ON proto_users.userID = proto_reviews.userID;';

$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="css/userreviewUI.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $("#header").css({
                        "opacity": "0"
                    })
                } else {
                    $("#header").css({
                        "opacity": "1"
                    })
                }
            })
        })
    </script>


</head>

<body>
    <section data-aos="fade-down" data-aos-duration="800" data-aos-delay='600' id="header">
        <nav class="navbar navbar-expand-lg fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-book"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                        <a class="nav-link" href="index.php">HOME PAGE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="books.php">BOOKS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reviews.php">USER REVIEWS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">SIGN OUT</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <div class="jumbotron text-center" style="height:60vh;">
        <div class="intro ">
            <div class='gameHeader'>
                <h2 data-aos="fade" data-aos-duration="2000">User Reviews <i class="fa fa-book"></i></h2>
            </div>




        </div>
    </div>
    <div class="Maincontent">


        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            echo "<div data-aos='fade-up' 
            data-aos-duration='1000' 
            data-aos-delay='800' class='card' style='width: 400 >
            <img class='card-img-top' src='{$row['url']}' alt='Card image cap'>
                <div class='card-body'>
                 <h5 class='card-title'>{$row['title']}</h5>
                <p class='card-text'>User: {$row['FullName']}<br><br>{$row['review']}</p>
                 <a href='inspect.php?info={$row['bookID']}' class='btn btn-primary'>Go to Book</a>
                </div>
                 </div>";
            }
        }
        ?>



    </div>

    </div>
    <footer  id="mainfooter">
        <h3 id="getintouch">Get in touch with us
            <p>Subscribe to our monthly news letter to be updated on new book news and reviews</p>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <label for="mail">EMAIL: <input type='email' name='useremail' required /></label>
                <input type="submit" value="SUBSCRIBE"></button>




            </form>
            <p id="copyright">Copyright © 2021 BOOKAHOLIC</p>
        </h3>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>