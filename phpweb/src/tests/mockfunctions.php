<?php

//Mock Page load time function
//Records the total time it takes for the file_get_contents function to finish
//Mock Function takes Rancher URL as a constructor variable
//Returns the page load time
function mockPageload($site)
{
    $t = microtime(TRUE);
    file_get_contents($site);
    $t = microtime(TRUE) - $t;
    $pageloadtime = sprintf('%.6f', $t);
    return $pageloadtime;
}


//Mock Ping function that takes a service's host as its constructor variable
//It times how long it takes for fsockopen to open a TCP connection to the host on port 80 and then
//ping the host, having a timeout value of 5 seconds.
//Returns the ping time
function mockPing($host)
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
function mockWebResponse($ch)
{
    $ch = curl_init($ch);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if (curl_exec($ch)) {
        $info = curl_getinfo($ch);
        $time = sprintf('%.6f', $info['total_time']);
        return $time;
    }
}

//Mock BandwidthTest
//Returns the Bandwidth in MBps wehen 1024 kb are streamed
//Uses mock database that holds bandwidth array as constructor variable
 function mockBandwithTest()
{
    $kb = 1024;
    flush();
    $time = explode(" ", microtime());
    $start = $time[0] + $time[1];
    for ($x = 0; $x < $kb; $x++) {
        echo str_pad('', 1024, '.');
        flush();
    }
    $time = explode(" ", microtime());
    $finish = $time[0] + $time[1];
    $deltat = $finish - $start;

    $speed = round($kb / $deltat, 3);
    $duration = $deltat;
    $KB = $kb;
    return $speed;
}
