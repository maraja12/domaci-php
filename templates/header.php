<?php
include('session.php');

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: login.php');
}

?>

<head>
    <title>FILM REVIEWS</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/star.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>


<body>
    <nav>
        <div class="nav-wrapper black">
            <a href="index.php" class="brand-logo center"><img src="images/title.png" alt="icon" class="icon-card"></a>
            <?php if ($loggedId != 0): ?>
                <ul class="left hide-on-med-and-down;position:relative">
                    <li> <a href="watchlist.php?id=<?php echo $loggedId ?>"><span
                                class="deep-orange-text text-accent-3"><b><big>Watchlist</big></b></span></a></li>
                    <li> <a href="add.php"><span class="deep-orange-text text-accent-3"><b><big>Add
                                        film</big></b></span></a></li>
                    <li style="padding-left:15px; position: absolute;top: 8px;right: 16px;">
                        <form action="" method="POST">
                            <input type="submit" name="logout" value="logout"
                                class="btn-small yellow accent-3 black-text nav-text z-depth-0">
                        </form>
                    </li>

                </ul>
            <?php else: ?>
                <ul class="left hide-on-med-and-down">
                    <li><a href="registration.php"><span
                                class="deep-orange-text text-accent-3"><b><big>Registration</big></b></span></a></li>
                    <li><a href="login.php"><span class="deep-orange-text text-accent-3"><b><big>Login</big></b></span></a>
                    </li>

                </ul>
            <?php endif; ?>
        </div>
    </nav>