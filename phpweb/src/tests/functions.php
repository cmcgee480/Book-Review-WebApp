<?php

//Page load time function
//Records the total time it takes for the file_get_contents function to finish
//Function takes Rancher URL as a constructor variable
//The code below the function then updates the page load time field in MySQL Database
//Using the serviceID
function pageload($site)
{
    $t = microtime(TRUE);
    file_get_contents($site);
    $t = microtime(TRUE) - $t;
    return sprintf('%.6f', $t);
}


//Ping function that takes an IP address of a service's host as its constructor variable
//It times how long it takes for fsockopen to open a TCP connection to the host on port 80 and then
//ping the host, having a timeout value of 5 seconds.
function ping($host)
{
    $start = microtime(true);
    $fp = fsockopen($host, 80, $errorCode, $errorCode, 5);
    $end = microtime(true);
    if ($fp === false) {
        return false;
    }
    fclose($fp);
    $diff = $end - $start;
    return sprintf('%.6f', $diff);
}


//If the service is active, the web response time is collected below/
    //The Rancher URL is provided from the database
    //curl_getinfo function that returns the total time it takes to transfer a request
    //Total time in milliseconds is returned


    function webresponse($ch)
    {
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (curl_exec($ch)) {
            $info = curl_getinfo($ch);
            $time = sprintf('%.6f', $info['total_time']);
            return $time;
        }
    }



?>