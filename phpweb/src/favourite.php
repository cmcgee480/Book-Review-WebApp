<?php

ob_start();
session_start();
include('functions.php');

if (isset($_GET['info'])) {
    $bookID = $_GET['info'];
    $endp = "http://cmcgee17.lampt.eeecs.qub.ac.uk/prototype-app/src/bookAPI/index.php?bookID=$bookID";

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

    $gamedata = json_decode($res, true);

    foreach ($gamedata as $value) {
        include('conn.php');
        
        $bookID = $conn->real_escape_string($value['bookID']);
        $bookTitle = $conn->real_escape_string($value['title']);

        $sqlcheck = "SELECT * FROM proto_faves WHERE bookID = '$bookID'";
        $resultcheck = mysqli_query($conn, $sqlcheck);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKAHOLIC</title>
    <link rel="stylesheet" href="css/reviewUI.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
<section id="header">
        <nav data-aos="fade-down" data-aos-duration="800" data-aos-delay='600' class="navbar navbar-expand-lg fixed-top">
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
    <div class="jumbotron text-center" style="height:50vh;">
        <div class="intro">
            <h2 data-aos="fade" data-aos-duration="2000">Thank you!
                <i class="fa fa-book"></i>
            </h2>
        </div>
    </div>
    <script>
        swal("Add to favourites successful!");
    </script>
    <div class='content'>
        <div data-aos="fade" data-aos-duration="2000" class='reviewbox'>

            <?php foreach ($gamedata as $value) {
                if (mysqli_num_rows($resultcheck) == 1) {
                    $rowcheck = mysqli_fetch_assoc($resultcheck);
                    header("Location: errorfave.php?info=$bookID");

                } else {
                    addToFavourites($bookID);

                    echo "<h2>$bookTitle added to Favourites</h2>";
                }
            } ?>
            <a href='viewfavourites.php' class='btn btn-primary'>VIEW FAVOURITES</a>
            <a href='books.php' class='btn btn-primary'>BACK TO BOOKS</a>

        </div>


    </div>
    <footer id="mainfooter">
        <h3 id="getintouch">

            <p id="copyright">Copyright © 2021 BOOKAHOLIC</p>
        </h3>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>