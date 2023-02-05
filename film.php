<?php

include('db/dbBroker.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM film WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $film = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    $user_id = $film['user_id'];
    $query = "SELECT * FROM user WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $profile = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

if (isset($_POST['delete'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "DELETE FROM film WHERE id = $id AND user_id = $user_id";
    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<?php if ($film == null): ?>
    <h1 class="center">No more information</h1>
    <div class="center">
        <a href="index.php" class="btn center yellow accent-3 black-text nav-text">Home</a>
    </div>

<?php else: ?>
    <div class="center">
        <div class="image1">
            <img class="image__img" src="images/starbig.png" alt="Star">
            <div class="image__overlay image__overlay--primary">
                <div class="image__title1">
                    <h5>
                        <?php echo htmlspecialchars($film['name']); ?>
                    </h5>
                </div>
                <h1>
                    <?php echo htmlspecialchars($film['rate']); ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="film-form">
        <div class="main-div">
            <form class="formating1">
                <h3 style="color: white">
                    <?php echo 'Genre: ' . htmlspecialchars($film['genre']); ?>
                </h3>
                <h5 style="color: white">
                    <?php echo 'Duration: ' . htmlspecialchars($film['duration']); ?>
                </h5>
                <h5 style="color: white">
                    <?php echo 'Release year: ' . htmlspecialchars($film['year']); ?>
                </h5>
                <h5 style="color: white">
                    <?php echo 'Stars: ' . htmlspecialchars($film['actors']); ?>
                </h5>
                <h5 style="color: white">
                    <b><big>REVIEW: </b></big>
                    <?php echo htmlspecialchars($film['review']); ?>
                </h5>
            </form>
        </div>
        <?php if ($user_id == $loggedId) { ?>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" style="padding-top:20px">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <div class="center">
                    <input type="submit" name="delete" value="delete" class="btn center yellow accent-3 black-text nav-text">
                </div>
            </form>

        <?php }
        ; ?>


    </div>
    </div>

<?php endif; ?>

<?php include('templates/footer.php'); ?>

</html>