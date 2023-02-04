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

<div class="container">
    <div class="row">
        <?php foreach ($films as $film): ?>
            <div class="col s12 m12 l6 xl6">
                <div class="image">
                    <img class="image__img" src="images/starbig.png" alt="Star">
                    <div class="image__overlay image__overlay--primary">
                        <div class="image__title">
                            <h5>
                                <?php echo htmlspecialchars($film['name']); ?>
                            </h5>
                        </div>
                        <p class="image__description">
                        <h1>
                            <?php echo htmlspecialchars($film['rate']); ?>
                        </h1>
                        Go to the film:
                        <a href="film.php?id=<?php echo $film['id']; ?>" class="white-text">
                            <i class="medium material-icons">camera_roll</i>
                        </a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php include('templates/footer.php'); ?>

</html>