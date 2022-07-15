<?php
include('functions.php');
if (isset($_GET['info'])) {
    $bookID = $_GET['info'];
    $endp = "http://cmcgee17.lampt.eeecs.qub.ac.uk/prototype-app/src/bookAPI/index.php?bookID=$bookID";

    $user = 'cmcgee480';

    $pw = 'Mus1c5020';

    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => 'Authorization: Basic ' . base64_encode("$user:$pw"),
        ],
    ];

    $context = stream_context_create($opts);

    $res = file_get_contents($endp, false, $context);

    $bookdata = json_decode($res, true);

    include('conn.php');

    $sql = "DELETE FROM proto_faves WHERE bookID = '$bookID'";
    deleteFromFavourites($bookID);
    header(
        'Location: deleteupload.php?info=$bookID'
    );

} ?>


