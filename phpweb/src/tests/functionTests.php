<?php

include('../conn.php');
include('../functions.php');
include('../classes/user.php');
include('../classes/book.php');

// Instrumentation that will test the Book review apps functions


//This function will calculate the total time taken for a book review to be uploaded to the database
//Creates a new User and executes the uploadReview function
//If the test is successful it returns the Review Upload Execution time in milliseconds
//Then enters the metrics into the database
function reviewUploadtime()
{
    include('../conn.php');
    $serviceID = 1001;
    $user = new User('Conor McGee', 'mcgee.cp@gmail.com', 'cmcgee480', 'password54321');
    $start_timestamp = microtime(true);

    $user->username;
    uploadReview(1, 'TEST DATA: upload test review', $user->username);

    $end_timestamp = microtime(true);
    $duration = $end_timestamp - $start_timestamp;
    $durationTime = $duration * 1000;
    $title = "Review Upload Execution time Test";
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result = "PASS";
    echo ("Review Upload Execution took " . $durationTime . " milliseconds.\n");
    $log = "Review Upload Execution took " . $durationTime . " milliseconds.\n";
    $sqlquery = "INSERT INTO argus_methodTimeTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
    VALUES(NULL,'$title',$serviceID,'$durationTime','$Result','$timeStamp','$log');";
    $result = $conn->query($sqlquery);
    if (!$result) {
        echo $conn->error;
    }
}

reviewUploadtime();

//This function will calculate the total time taken for an email to be uploaded to the Newsletter
//Creates a test email and executes the addToNewsLetter function
//If the test is successful it returns the AddToNewsLetter Upload Execution in milliseconds
//Then enters the metrics into the database
function newsLetterUploadTime()
{
    include('../conn.php');
    $serviceID = 1001;
    $email = "fakeemail@email.com";
    $start_timestamp = microtime(true);
    addToNewsLetter($email);
    $end_timestamp = microtime(true);
    $duration = $end_timestamp - $start_timestamp;
    $durationTime = $duration * 1000;
    $title = "NewsLetter Upload Execution time Test";
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result = "PASS";
    echo ("AddToNewsLetter Upload Execution took " . $durationTime . " milliseconds.\n");
    $log = "AddToNewsLetter Upload Execution took " . $durationTime . " milliseconds.\n";
    $sqlquery = "INSERT INTO argus_methodTimeTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
    VALUES(NULL,'$title',$serviceID,'$durationTime','$Result','$timeStamp','$log');";
    $result = $conn->query($sqlquery);
    if (!$result) {
        echo $conn->error;
    }
}

newsLetterUploadTime();


function didAddToNewsLetter()
{
    include('../conn.php');
    $title = "didAddToNewsletter Method Test";
    $serviceID = 1001;
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result;
    $newsletterUploaded;
    $email = "fakeemail245@email.com";
    addToNewsLetter($email);

    $sql3 = "SELECT * FROM practice_newslettertable WHERE email ='$email';";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {
        $Result = "PASS";
        $newsletterUploaded = true;
        echo "didAddToNewsletter Test: Passed\n";
        $log = "Added to Newsletter successfully";
        $sqlquery1 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
        VALUES(NULL,'$title',$serviceID,'$newsletterUploaded','$Result','$timeStamp','$log');";
        $result1 = $conn->query($sqlquery1);
        if (!$result1) {
            echo $conn->error;
        }
    } else {
        $Result = "FAILED";
        $newsletterUploaded = false;
        echo "didAddToNewsletter Test: Failed\n";
        $log = "Email not added to Newsletter";
        $sqlquery2 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
        VALUES(NULL,'$title',$serviceID,'$newsletterUploaded','$Result','$timeStamp','$log');";
        $result2 = $conn->query($sqlquery2);
        if (!$result2) {
            echo $conn->error;
        }
    }
}
didAddToNewsLetter();



function isAddNewUser()
{
    include('../conn.php');
    $title = "AddNewUser Method Test";
    $serviceID = 1001;
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result;
    $newUser = new User('Test fullname data', 'testemail@gmail.com', 'testusername123', 'testemail@testemail');
    $userAdded = false;
    addNewUser($newUser);

    $sql2 = "SELECT userID FROM proto_users WHERE Username ='$newUser->username';";

    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        $userAdded = true;
        $Result = "PASS";
        echo "didUserAdded Method: $userAdded. Test passed\n";
        $log = "User has been added successfully";
        $sqlquery = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
      VALUES(NULL,'$title',$serviceID,'$userAdded','$Result','$timeStamp','$log');";
        $result = $conn->query($sqlquery);
        if (!$result) {
            echo $conn->error;
        }
    } else {
        $userAdded = false;
        $Result = "FAILED";
        $log = "User has not been added";
        $sqlquery1 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
        VALUES(NULL,'$title',$serviceID,'$userAdded','$Result','$timeStamp','$log');";
        $result1 = $conn->query($sqlquery1);
        if (!$result1) {
            echo $conn->error;
        }
        echo "didUserAdded Method: $userAdded. Test failed\n";
    }
}

isAddNewUser();


function duplicateUserAlert(){

    include('../conn.php');
    $title = "Duplicate User Alert Test";
    $serviceID = 1001;
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result;
    $newUser = new User('Test fullname data', 'testemail@gmail.com', 'testusername123', 'testemail@testemail');
    $newUser2 = new User('Test fullname data', 'testemail@gmail.com', 'testusername123', 'testemail@testemail');
    $username2=$newUser2->username;
    addNewUser($newUser);
    $sql = "SELECT * FROM proto_users WHERE Username='$username2'";

    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }
    if ($result->num_rows > 0) {
        $Result= "PASS";
        $duplicateUser=false;
        $log="Test Passed: Duplicate User Alert. User not added.";
        $sqlquery1 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
        VALUES(NULL,'$title',$serviceID,'$duplicateUser','$Result','$timeStamp','$log');";
        $result1 = $conn->query($sqlquery1);
        if (!$result1) {
            echo $conn->error;
        }
    }else{
        $duplicateUser=true;
        $Result="FAIL";
        $log = "Test Failed: A Duplicate user has been added.";
        $sqlquery2 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
        VALUES(NULL,'$title',$serviceID,'$duplicateUser','$Result','$timeStamp','$log');";
         $result2 = $conn->query($sqlquery2);
         if (!$result2) {
             echo $conn->error;
         }
    }

     

}

duplicateUserAlert();


function didReviewUpload()
{
    include('../conn.php');
    $title = "didReviewUpload Method Test";
    $serviceID = 1001;
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result;
    $reviewUploaded;
    $user = new User('Conor McGee', 'mcgee.cp@gmail.com', 'cmcgee480', 'password54321');

    $user->username;
    uploadReview(1, "TEST UPLOAD DATA: this is conor's review", $user->username);

    $sql3 = "SELECT * FROM proto_reviews WHERE review LIKE '%TEST UPLOAD DATA%';";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {
        $Result = "PASS";
        $reviewUploaded = true;
        echo "didReviewUpload Test: Passed\n";
        $log = "Review uploaded successfully";
        $sqlquery1 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
        VALUES(NULL,'$title',$serviceID,'$reviewUploaded','$Result','$timeStamp','$log');";
        $result1 = $conn->query($sqlquery1);
        if (!$result1) {
            echo $conn->error;
        }
    } else {
        $Result = "FAILED";
        $reviewUploaded = false;
        echo "didReviewUpload Test: Failed\n";
        $log = "Review did not upload";
        $sqlquery2 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
        VALUES(NULL,'$title',$serviceID,'$reviewUploaded','$Result','$timeStamp','$log');";
        $result2 = $conn->query($sqlquery2);
        if (!$result2) {
            echo $conn->error;
        }
    }
}

didReviewUpload();


//This function will test whether a book has been added to Favourites or not
//Creates a test favourite book and attempts to add it to the favourites tables in database
//If the book is already in favourites or the function doesnt work for some reasion it fails
//Test also fails if the book is unknown
//If upload is successful it returns a Boolean value of true
//If it fails it returns a Boolean value of false
function didFavouriteUpload()
{
    include('../conn.php');
    $title = "didFavouriteUpload Method Test";
    $serviceID = 1001;
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result;
    $book = new Book('TEST FAVE BOOK', 1003, 1000, 'TEST SUMMARY', 'TESTURL/TEST/TEST');
    $sql2 = "SELECT * FROM books WHERE title ='$book->title';";
    $favouriteAdded;
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $bookID = $row['bookID'];
            $sql3 = "SELECT * FROM proto_faves WHERE bookID ='$bookID';";
            $result3 = $conn->query($sql3);
            if ($result3->num_rows > 0) {
                $favouriteAdded = false;
                $Result = "FAIL";
                $log = "didFavouriteUpload : Test failed. Book already in favourites.";
                echo "didFavouriteUpload : Test failed. Book already in favourites.";
                $sqlquery2 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
               VALUES(NULL,'$title',$serviceID,'$favouriteAdded','$Result','$timeStamp','$log');";
                $result5 = $conn->query($sqlquery2);
                if (!$result5) {
                    echo $conn->error;
                }
            } else {
                addToFavourites($bookID);
                $sql4 = "SELECT * FROM proto_faves WHERE bookID = '$bookID';";
                $result4 = $conn->query($sql4);
                if ($result4->num_rows > 0) {
                    $favouriteAdded = true;
                    $Result = "PASS";
                    echo "didFavouriteUpload Test: Book uploaded to Favourites\n";
                    $log = "Book uploaded to Favourites";
                    $sqlquery3 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
                   VALUES(NULL,'$title',$serviceID,'$favouriteAdded','$Result','$timeStamp','$log');";
                    $result7 = $conn->query($sqlquery3);
                    if (!$result7) {
                        echo $conn->error;
                    }
                    deleteFromFavourites($bookID);
                } else {
                    $favouriteAdded = false;
                    $Result = "FAIL";
                    echo "didFavouriteUpload Test: Failed\n";
                    $log = "Book failed to upload to Favourites";
                    $sqlquery4 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
                   VALUES(NULL,'$title',$serviceID,'$favouriteAdded','$Result','$timeStamp','$log');";
                    $result71 = $conn->query($sqlquery4);
                    if (!$result71) {
                        echo $conn->error;
                    }
                }
            }
        }
    } else {
        $favouriteAdded = false;
        $Result = "FAIL";
        echo "didFavouriteUpload: Test Failed. Book Unknown..";
        $log = "Test Failed. Book Unknown..";
        $sqlquery5 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
        VALUES(NULL,'$title',$serviceID,'$favouriteAdded','$Result','$timeStamp','$log');";
        $result72 = $conn->query($sqlquery5);
        if (!$result72) {
            echo $conn->error;
        }
    }
}

didFavouriteUpload();

function didFavouriteDelete()
{
    include('../conn.php');
    $title = "didFavouriteDelete Method Test";
    $serviceID = 1001;
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result;
    $book = new Book('TEST FAVE BOOK', 1003, 1000, 'TEST SUMMARY', 'TESTURL/TEST/TEST');
    $sql2 = "SELECT * FROM books WHERE title ='$book->title';";
    $favouriteDeleted;
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $bookID = $row['bookID'];
            addToFavourites($bookID);
            $sql4 = "SELECT * FROM proto_faves WHERE bookID = '$bookID';";
            $result4 = $conn->query($sql4);

            if ($result4->num_rows > 0) {
                deleteFromFavourites($bookID);
                $sql5 = "SELECT * FROM proto_faves WHERE bookID = '$bookID';";
                $result5 = $conn->query($sql5);
                if ($result5->num_rows > 0) {
                    $favouriteDeleted = false;
                    $Result = "FAIL";
                    echo "didFavouriteDelete: Test failed. Book was not deleted.";
                    $log = "Book was not deleted";
                    $sqlquery5 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
                    VALUES(NULL,'$title',$serviceID,'$favouriteDeleted','$Result','$timeStamp','$log');";
                    $result72 = $conn->query($sqlquery5);
                    if (!$result72) {
                        echo $conn->error;
                    }
                } else {
                    $favouriteDeleted = true;
                    $Result = "PASS";
                    echo "didFavouriteDelete: Test passed. Book deleted from Favourites.";
                    $log = "Book deleted from Favourites successfully";
                    $sqlquery6 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
                    VALUES(NULL,'$title',$serviceID,'$favouriteDeleted','$Result','$timeStamp','$log');";
                    $result73 = $conn->query($sqlquery6);
                    if (!$result73) {
                        echo $conn->error;
                    }
                }
            } else {
                $favouriteDeleted = false;
                $Result = "FAIL";
                echo "didFavouriteDelete: Test Failed. Book not in Favourites.";
                $log = "Book Not in Favourites";
                $sqlquery7 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
                    VALUES(NULL,'$title',$serviceID,'$favouriteDeleted','$Result','$timeStamp','$log');";
                $result74 = $conn->query($sqlquery7);
                if (!$result74) {
                    echo $conn->error;
                }
            }
        }
    } else {
        $favouriteDeleted = false;
        $Result = "FAIL";
        $log = "Book Unknown..";
        echo "didFavouriteDelete: Test Failed. Book Unknown";
        $sqlquery8 = "INSERT INTO argus_methodTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
                    VALUES(NULL,'$title',$serviceID,'$favouriteDeleted','$Result','$timeStamp','$log');";
        $result75 = $conn->query($sqlquery8);
        if (!$result75) {
            echo $conn->error;
        }
    }
}

didFavouriteDelete();


function favouriteUploadtime()
{
    include('../conn.php');
    $title = "Favourite Upload Execution time Test";
    $serviceID = 1001;
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result;
    $book = new Book('TEST FAVE BOOK', 1008, 1003, 'TEST SUMMARY jndfslkjndflak', 'TESTURL/URL/TEST/TEST');
    $sql2 = "SELECT * FROM books WHERE title ='$book->title';";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $bookID = $row['bookID'];
        }
    }
    $start_timestamp = microtime(true);
    addToFavourites($bookID);


    $end_timestamp = microtime(true);
    $duration = $end_timestamp - $start_timestamp;
    $durationTime = $duration * 1000;
    echo ("Favourite Upload Execution took " . $durationTime . " milliseconds.\n");
    $log = "Favourite Upload Execution took " . $durationTime . " milliseconds";
    $Result = "PASS";
    $sqlquery8 = "INSERT INTO argus_methodTimeTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
                    VALUES(NULL,'$title',$serviceID,'$durationTime','$Result','$timeStamp','$log');";
    $result75 = $conn->query($sqlquery8);
    if (!$result75) {
        echo $conn->error;
    }

    deleteFromFavourites($bookID);
}

favouriteUploadtime();


function favouriteDeletetime()
{
    include('../conn.php');
    $title = "Favourite Delete Execution time Test";
    $serviceID = 1001;
    date_default_timezone_set("Europe/London");
    $date = date("Y-m-d H:i:s");
    $timeStamp = $date;
    $Result;
    $book = new Book('TEST FAVE BOOK', 1008, 1003, 'TEST SUMMARY jndfslkjndflak', 'TESTURL/URL/TEST/TEST');
    $sql2 = "SELECT * FROM books WHERE title ='$book->title';";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $bookID = $row['bookID'];
        }
    }
    addToFavourites($bookID);
    $start_timestamp = microtime(true);
    deleteFromFavourites($bookID);



    $end_timestamp = microtime(true);
    $duration = $end_timestamp - $start_timestamp;
    $durationTime = $duration * 1000;
    echo ("Favourite Delete Execution took " . $durationTime . " milliseconds.\n");
    $log = "Favourite Delete Execution took " . $durationTime . " milliseconds";
    $Result = "PASS";
    $sqlquery8 = "INSERT INTO argus_methodTimeTests (testID,testName,serviceID,Data,Result,TimeStamp,log) 
    VALUES(NULL,'$title',$serviceID,'$durationTime','$Result','$timeStamp','$log');";
    $result75 = $conn->query($sqlquery8);
    if (!$result75) {
        echo $conn->error;
    }
}

favouriteDeletetime();
