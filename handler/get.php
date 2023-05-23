<?php

require "../db/dbBroker.php";
require "../model/Film.php";

if (isset($_POST['id'])) {
    $myArray = Film::getById($_POST['id'], $conn);
    echo json_encode($myArray);
}