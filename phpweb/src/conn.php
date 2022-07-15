<?php

$host = 'cmcgee17.lampt.eeecs.qub.ac.uk';
$user = 'cmcgee17';
$pass = 'khKmkBtMF430tPfs';
$mydatabase = 'cmcgee17';

$conn = new mysqli($host, $user, $pass, $mydatabase);

if($conn->error){
    echo "not connected".$conn->error;
}

?>