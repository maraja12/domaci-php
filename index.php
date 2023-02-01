<?php

include('db/dbBroker.php');

$query = "SELECT * FROM film ORDER BY rate DESC";
$result = mysqli_query($conn, $query);
$films = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php include('templates/footer.php'); ?>

</html>