<?php

include('../conn.php');
include('functions.php');

$find = 1001;
$sql2 = "SELECT * FROM argus_services WHERE serviceID=$find;";

$result2 = $conn->query($sql2);

if (!$result2) {
    echo $conn->error;
}


if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $ch = curl_init($row['url']);
        $url = $row['url'];
        $hostname = $row['hostName'];
        $status = $row['Status'];
        $serviceName = $row['ServiceName'];
    }
}

if ($status == "NOT ACTIVE") {
    $minutes = 0;
    $pageload = 0;
    $pingtime = 0;
    $time = 0;
    $timeInMilliseconds = 0;
    $pingmilliseconds = 0;
    $pageloadmilliseconds = 0;

    include('../conn.php');
    $sql200 = "UPDATE argus_webresponse SET timeinMilliseconds = $timeInMilliseconds WHERE serviceID=$find;";
    $result600 = $conn->query($sql200);
    if (!$result600) {
        echo $conn->error;
    }

    $sql201 = "UPDATE argus_pingtimes SET timeinMilliseconds = $pingmilliseconds WHERE serviceID=$find;";
    $result601 = $conn->query($sql201);
    if (!$result601) {
        echo $conn->error;
    }

    $sql202 = "UPDATE argus_pageloadtimes SET timeinMilliseconds = $pageloadmilliseconds WHERE serviceID=$find;";
    $result602 = $conn->query($sql202);
    if (!$result602) {
        echo $conn->error;
    }
} else if ($status == "ACTIVE") {
    
    $webresponseTime = webresponse($ch);
    $timeInMilliseconds = $webresponseTime * 1000;

    //Below is the code used to update the webresponse time field in the database
    //Using the serviceID
    include('../conn.php');
    $sqlquery57 = "SELECT * FROM argus_webresponse WHERE serviceID = $find;";
    $result5 = $conn->query($sqlquery57);
    if (mysqli_num_rows($result5) == 1) {
        include('../conn.php');
        $sql75 = "UPDATE argus_webresponse SET timeinMilliseconds = $timeInMilliseconds WHERE serviceID=$find;";
        $result6 = $conn->query($sql75);
        if (!$result6) {
            echo $conn->error;
        }
    } else {
        include('../conn.php');
        $sqlquery70 = "INSERT INTO argus_webresponse (responseID,serviceID,timeInMilliseconds) 
                    VALUES(NULL,$find,$timeInMilliseconds);";
        $result10 = $conn->query($sqlquery70);
        if (!$result10) {
            echo $conn->error;
        }
    }

    curl_close($ch);

    // Uses the gethostbyname function to return the IP Address of the service's HostName
    $ip_address = gethostbyname($hostname);

    
    //ping function with services IP address
    //Converts to milliseconds
    //Sql queries then update the database field in argus pingtimes table
    //Or inserts new service and ping time into services table if not recognised
    $pingtime = ping($ip_address);
    $pingmilliseconds = $pingtime * 1000;

    include('../conn.php');
    $sqlquery56 = "SELECT * FROM argus_pingtimes WHERE serviceID = $find;";
    $result12 = $conn->query($sqlquery56);
    if (mysqli_num_rows($result12) == 1) {
        include('../conn.php');
        $sql17 = "UPDATE argus_pingtimes SET timeinMilliseconds = $pingmilliseconds WHERE serviceID=$find;";
        $result11 = $conn->query($sql17);
        if (!$result11) {
            echo $conn->error;
        }
    } else {
        include('../conn.php');
        $sqlquery71 = "INSERT INTO argus_pingtimes (pingID,serviceID,timeInMilliseconds) 
                    VALUES(NULL,$find,$pingmilliseconds);";
        $result9 = $conn->query($sqlquery71);
        if (!$result9) {
            echo $conn->error;
        }
    }


    //page load time function
    $pageload = pageload($url);
    $pageloadmilliseconds = $pageload * 1000;
    include('../conn.php');
    $sqlquery1 = "SELECT * FROM argus_pageloadtimes WHERE serviceID = $find;";
    $result3 = $conn->query($sqlquery1);
    if (mysqli_num_rows($result3) == 1) {
        include('../conn.php');
        $sql3 = "UPDATE argus_pageloadtimes SET timeinMilliseconds = $pageloadmilliseconds WHERE serviceID=$find;";
        $result4 = $conn->query($sql3);
        if (!$result4) {
            echo $conn->error;
        }
    } else {
        include('../conn.php');
        $sqlquery = "INSERT INTO argus_pageloadtimes (loadID,serviceID,timeInMilliseconds) 
                    VALUES(NULL,$find,$pageloadmilliseconds);";
        $result1 = $conn->query($sqlquery);
        if (!$result1) {
            echo $conn->error;
        }
    }
}
