<?php
$host = "localhost";
$db = "film_review";
$username = "marija";
$password = "marija";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_errno) {
    exit("Connection failed: " . $conn->connect_errno);
}
?>