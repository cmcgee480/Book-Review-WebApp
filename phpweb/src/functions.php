<?php




function addNewUser(User $user1)
{
    include('conn.php');

    $sql = "INSERT INTO proto_users (userID,FullName,Email,Username,password)
    VALUES(null,'$user1->fullName','$user1->email','$user1->username','$user1->password');";

    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }
}

function addToNewsLetter($email)
{
    include('conn.php');
    $sql = "INSERT INTO practice_newslettertable (newsletterID,email) 
    VALUES(null,'$email')";

    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }
}


function addToFavourites(int $bookID)
{

    include('conn.php');
    $sql = "INSERT INTO proto_faves (favouriteID,bookID)
                    VALUES(null,'$bookID');";

    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }
}

function deleteFromFavourites(int $bookID)
{
    include('conn.php');
    $sql = "DELETE FROM proto_faves WHERE bookID ='$bookID';";

    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }
}




function uploadReview(int $bookID, string $review, string $username)
{
    include('conn.php');
    $sql2 = "SELECT userID FROM proto_users WHERE Username ='$username'";

    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $userID = $row["userID"];
        }
    } else {
        echo "0 results";
    }
    $bookReview = $conn->real_escape_string($review);
    $sql = "INSERT INTO proto_reviews (reviewID,bookID,userID,review)
             VALUES(null,'$bookID','$userID','$bookReview')";

    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }
}
