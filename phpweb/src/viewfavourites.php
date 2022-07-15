<?php

include('conn.php');


session_start();

$sql = 'SELECT proto_faves.favouriteID,proto_faves.bookID,books.title,proto_authors.Name,books.summary,
    proto_genre.Genre
            FROM proto_faves 
            JOIN books ON proto_faves.bookID = books.bookID 
            JOIN proto_authors ON proto_authors.authorID = books.authorID
            JOIN proto_genre ON proto_genre.genreID = books.genreID;';

$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favourites</title>
    <link rel="stylesheet" href="css/reviewUI.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/script.js"></script>
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
    <div class="jumbotron text-center" style="height:50vh;">
        <div class="intro">
            <h2 data-aos="fade" data-aos-duration="2000">Your Favourites
                <i class="fa fa-book"></i>
            </h2>
        </div>
    </div>
    <div data-aos="fade" data-aos-duration="2000" class='favecontent'>
        <a href='books.php' class='btn btn-primary'>BACK TO BOOKS</a>

    </div>



    <div data-aos='fade-up' data-aos-duration='800' class='reviewfaves'>

        <table class='table table-dark table-hover'>
            <thead>
                <tr>
                    <th>BookID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Summary</th>
                    <th>Genre</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <?php
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo "  
                  <tbody>
                    <tr>
                      <td>{$row['bookID']}</td>
                      <td>{$row['title']}</td>
                      <td>{$row['Name']}</td>
                      <td>{$row['summary']}</td>
                      <td>{$row['Genre']}</td>
                      <td><a href='inspect.php?info={$row['bookID']}' class='viewbutton'>View</a></td>
                      <td><a href='deletefavourite.php?info={$row['bookID']}' class='deletebutton'>Delete</a></td>
                    </tr>
                  </tbody>
                
                        ";
                }
            } ?>


        </table>



    </div>




    <footer id="mainfooterfave">
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