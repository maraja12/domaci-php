<?php

include('db/dbBroker.php');

session_unset();

$username = $password = '';
$errors = ['username' => '', 'password' => ''];

if (isset($_POST['login'])) {

    if (empty($_POST['username'])) {
        $errors['username'] = 'Username is required!';
    } else {
        $username = $_POST['username'];
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        if ($user == null) {
            $errors['username'] = "This user does not exist!";
        } elseif (empty($_POST['password'])) {
            $errors['password'] = "Password is required!";
        } else {
            $password = $_POST['password'];

            if (strcmp($password, $user['password'])) {
                $errors['password'] = "Wrong password!";
            } else {

                session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];

                header('Location: index.php');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php') ?>

<div class="log-form">
    <div class="main-div">
        <form class="formating" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <h2><b>Login</b></h2>
            <div class="container">

                <input type="text" placeholder="Username" name="username" class="form-control"
                    value="<?php echo htmlspecialchars($username) ?>">
                <div class="red-text">
                    <?php echo $errors['username']; ?>
                </div>
                <br>

                <input type="password" placeholder="Password" name="password" class="form-control"
                    value="<?php echo htmlspecialchars($password) ?>">
                <div class="red-text">
                    <?php echo $errors['password']; ?>
                </div>
                <br>

                <input type="submit" name="login" value="Login" class="btn btn-outline-success" style="width: 150px;
                text-align: center; color: white;border-color: white;">

        </form>
    </div>
</div>



<?php include('templates/footer.php') ?>

</html>