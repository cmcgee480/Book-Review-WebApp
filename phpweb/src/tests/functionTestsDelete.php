<?php


include('../conn.php');


$sql2 = "DELETE FROM argus_methodTests;";

$result = $conn->query($sql2);
        if (!$result) {
            echo $conn->error;
        }

$sql3 = "DELETE FROM argus_methodTimeTests;";

$result1 = $conn->query($sql3);
        if (!$result1) {
            echo $conn->error;
        }

?>