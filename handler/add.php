<?php
require "../db/dbBroker.php";
require "../model/Film.php";

if (
    isset($_POST['name']) && isset($_POST['genre'])
    && isset($_POST['actors']) && isset($_POST['duration'])
    && isset($_POST['year']) && isset($_POST['rate'])

) {
    $status = Film::add(
        $_POST['name'], $_POST['genre'], $_POST['actors'], $_POST['duration']
        , $_POST['year'], $_POST['rate'],
        $conn
    );

    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}
?>