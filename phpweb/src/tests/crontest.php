<?php

include('../conn.php');
$hello = 'Hello';

$sql2 = "INSERT INTO crontest (cronID,Hello) VALUES(NULL,'$hello');";
$result = $conn->query($sql2);
if (!$result) {
    echo $conn->error;
}


?>