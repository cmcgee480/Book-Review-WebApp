<?php
session_start();

if (isset($_GET['info'])) {
    $find = $_GET['info'];

    $endp = "http://cmcgee17.lampt.eeecs.qub.ac.uk/prototype-app/src/bookAPI/index.php?bookID=$find";

    $user = 'cmcgee480';

    $pw = 'Mus1c5020';

    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => 'Authorization: Basic ' . base64_encode("$user:$pw"),
        ],
    ];

    $context = stream_context_create($opts);

    $res = file_get_contents($endp, false, $context);

    $bookdata = json_decode($res, true);
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK DETAILS</title>
    <link rel="stylesheet" href="css/inspectUI.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    <div class="jumbotron text-center">
        <div class="intro">
            <h2 data-aos="fade" data-aos-duration="2000">Book Details
                <i class="fa fa-book"></i>
            </h2>
        </div>
    </div>
    <div class='content'>
        <div class='reviewbox'>

            <?php foreach ($bookdata as $value) {
                echo "  <div class='section-heading'>
                        <img data-aos='fade-up' data-aos-duration='1000' src='{$value['url']}' alt='image' width ='250' height='250'>
                        <h2 data-aos='fade-up' data-aos-duration='1000'data-aos-delay='400'><u>{$value['title']}</u></h2>
                        </div>
                        <p data-aos='fade' 
                        data-aos-duration='1000' 
                        data-aos-delay='500'>Author: {$value['Name']}
                        <br>Genre: {$value['Genre']}
                        <br>Book ID: {$value['bookID']}</p>
                        <p data-aos='fade' 
                        data-aos-duration='1000' 
                        data-aos-delay='600'>{$value['summary']}
                        </p>
                        <a data-aos='fade-up' data-aos-duration='1000'data-aos-delay='400' href='userreview.php?info={$value['bookID']}' class='btn btn-primary'>REVIEW THIS BOOK</a>
                        <a data-aos='fade-up' data-aos-duration='1000'data-aos-delay='400' href='favourite.php?info={$value['bookID']}' class='btn btn-primary'>ADD TO FAVOURITES <i class='fa fa-heart'></i></a>
                        </section>";
            } ?>

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