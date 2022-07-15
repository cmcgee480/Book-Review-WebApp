

<?php
//bandwidth test function
//Once run, 1024Kb (Kilobytes) will be streamed and this function will record the total time this takes
//Returns the bandwidth in Mbps (Megabytes per second)
//Sqlquery will then update the argus bandwidthTests table using a serviceID (1001)
//This php script is executed from a shell_exec function in the shellExecBandwidth.php script
function bandwithTest()
{
    $serviceID = 1001;
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
    $serviceID = 1001;
    $duration = $deltat;
    $KB = $kb;
    include('../conn.php');
    $sql2 = "UPDATE argus_bandwithTests SET duration='$duration',speed='$speed' WHERE serviceID =$serviceID;";

    $result = $conn->query($sql2);
    if (!$result) {
        echo $conn->error;
    }
    return $speed;
}

bandwithTest();


?>

