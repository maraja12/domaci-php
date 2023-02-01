<?php

$host = 'localhost';
$user = 'marija';
$password = 'marija';
$database = 'film_review';
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    echo 'Connection failed: ' . mysqli_connect_error();
}
?>