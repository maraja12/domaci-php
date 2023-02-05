<?php

include('db/dbBroker.php');

if (isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM user WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $profile = mysqli_fetch_assoc($result);
}

$query = "SELECT * FROM film WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);
$films = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($user_id != $loggedId): ?>

    <h1 class="center">This profil is exclusively visible by its creator.</h1>
    <div class="center">
        <a href="index.php" class="btn center yellow accent-3 black-text nav-text">Return</a>
    </div>

<?php elseif ($films != null): ?>

    <div class="container">
        <div class="center">

            <h2 style="color: white;"><b>Hi,
                    <?php echo $profile['username']; ?>! <br> YOUR WATCHLIST:
                </b></h2>

            <img src="images/popcorn.png" alt="Popcorn" class="smallpic">
        </div>
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
<?php else: ?>

    <h1 class="center"><span class="white-text">Be creator of your own watchlist...add film!<span></h1>
    <div class="center">
        <a href="add.php" class="btn center yellow accent-3 black-text nav-text">Add film</a>
    </div>

<?php endif; ?>
<?php include('templates/footer.php'); ?>

</html>