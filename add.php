<?php
include('db/dbBroker.php');
include('model/Film.php');

$name = $genre = $actors = $duration = $year = $rate = $review = '';

$errors = [
    'name' => '',
    'genre' => '',
    'actors' => '',
    'duration' => '',
    'year' => '',
    'rate' => '',
    'review' => ''
];

if (isset($_POST['add'])) {

    if (empty($_POST['name'])) {
        $errors['name'] = 'Name is required!';
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['genre'])) {
        $errors['genre'] = 'Genre is required!';
    } else {
        $genre = $_POST['genre'];
    }

    if (empty($_POST['actors'])) {
        $errors['actors'] = 'Actors are required!';
    } else {
        $type = $_POST['actors'];
    }

    if (empty($_POST['duration'])) {
        $errors['duration'] = 'Duration is required!';
    } else {
        $duration = $_POST['duration'];
    }
    if (empty($_POST['year'])) {
        $errors['year'] = 'Year is required!';
    } else {
        $year = $_POST['year'];
    }
    if (empty($_POST['rate'])) {
        $errors['rate'] = 'Rate is required!';
    } else {
        $rate = $_POST['rate'];
    }
    if (empty($_POST['review'])) {
        $errors['review'] = 'Review is required!';
    } else {
        $review = $_POST['review'];
    }

    if (!array_filter($errors)) {
        $name = $_POST['name'];
        $genre = $_POST['genre'];
        $actors = $_POST['actors'];
        $duration = $_POST['duration'];
        $year = $_POST['year'];
        $rate = $_POST['rate'];
        $review = $_POST['review'];
        $user_id = $_POST['user_id'];

        $newFilm = new Film(
            null,
            $user_id,
            $name,
            $genre,
            $actors,
            $duration,
            $year,
            $rate,
            $review,
        );

        $newFilm->createFilm();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>


<div class="add-form">
    <div class="main-div">
        <form class="formating" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h2><b>Add film</b></h2>
            <div class="container">

                <input type="text" placeholder="Name of film" name="name" value="<?php echo htmlspecialchars($name) ?>">
                <div class="red-text">
                    <?php echo $errors['name']; ?>
                </div>
                <br>

                <input type="text" placeholder="Genre" name="genre" value="<?php echo htmlspecialchars($genre) ?>">
                <div class="red-text">
                    <?php echo $errors['genre']; ?>
                </div>
                <br>

                <input type="text" placeholder="Main actors" name="actors"
                    value="<?php echo htmlspecialchars($actors) ?>">
                <div class="red-text">
                    <?php echo $errors['actors']; ?>
                </div>
                <br>

                <input type="text" placeholder="Duration" name="duration"
                    value="<?php echo htmlspecialchars($duration) ?>">
                <div class="red-text">
                    <?php echo $errors['duration']; ?>
                </div>
                <br>

                <input type="number" placeholder="Release year" name="year"
                    value="<?php echo htmlspecialchars($year) ?>">
                <div class="red-text">
                    <?php echo $errors['year']; ?>
                </div>
                <br>

                <input type="number" placeholder="Rating" name="rate" value="<?php echo htmlspecialchars($rate) ?>">
                <div class="red-text">
                    <?php echo $errors['rate']; ?>
                </div>
                <br>

                <input type="text" placeholder="Review" name="review" value="<?php echo htmlspecialchars($review) ?>">
                <div class="red-text">
                    <?php echo $errors['review']; ?>
                </div>
                <br>

                <input type="hidden" name="user_id" value="<?php echo $loggedId; ?>">

                <div class="center">
                    <input type="submit" name="add" value="Submit"
                        class="btn yellow accent-3 black-text nav-text z-depth-0">
                </div>

        </form>
    </div>


    <?php include('templates/footer.php'); ?>


</html>