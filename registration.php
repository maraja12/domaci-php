<?php

include('db/dbBroker.php');
include('model/User.php');

$email = $username = $password = $confirmPassword = '';

$errors = [
    'email' => '',
    'username' => '',
    'password' => '',
    'confirmPassword' => ''
];

if (isset($_POST['registration'])) {

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required!';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address!';
        }
    }

    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required!';
    } else {
        $username = $_POST['username'];

        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $userWithSameUsername = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($userWithSameUsername != null) {
            $errors['username'] = "User with username $username already exists!";
        }
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required!';
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long!';
        }
    }

    if (empty($_POST['confirmPassword'])) {
        $errors['confirmPassword'] = 'Password confirmation is required!';
    } else {
        $confirmPassword = $_POST['confirmPassword'];
        if ($confirmPassword != $password) {
            $errors['confirmPassword'] = 'Passwords do not match!';
            $confirmPassword = '';
            $password = '';
        }
    }

    if (!array_filter($errors)) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];


        $newUser = new User(null, $email, $username, $password);
        $newUser->createUser();
    }
}
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>


<div class="reg-form">
    <div class="main-div">
        <form class="formating" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h2><b>Registration</b></h2>
            <div class="container">
                <input type="text" placeholder="Email" name="email" class="form-control"
                    value="<?php echo htmlspecialchars($email); ?>">
                <div class="red-text">
                    <?php echo $errors['email']; ?>
                </div>
                <br>

                <input type="text" placeholder="Username" name="username" class="form-control"
                    value="<?php echo htmlspecialchars($email); ?>">
                <div class="red-text">
                    <?php echo $errors['username']; ?>
                </div>
                <br>

                <input type="password" placeholder="Password" name="password" class="form-control"
                    value="<?php echo htmlspecialchars($password); ?>">
                <div class="red-text">
                    <?php echo $errors['password']; ?>
                </div>
                <br>

                <input type="password" placeholder="Confirm password" name="confirmPassword" class="form-control"
                    value="<?php echo htmlspecialchars($confirmPassword); ?>">
                <div class="red-text">
                    <?php echo $errors['confirmPassword']; ?>
                </div>
                <br>
                <input type="submit" name="registration" value="Create account" class="btn btn-outline-success" style="width: 150px;
                text-align: center;color: white;border-color: white;">
        </form>

    </div>


    <?php include('templates/footer.php') ?>



</html>