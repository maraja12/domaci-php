<?php
include('session.php');

if (isset($_POST['logout'])) {
    session_unset();
    header('Location: login.php');
}

?>

<head>
    <title>FILM REVIEWS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/star.css">
    <link rel="stylesheet" href="css/film.css">
    <style>
        table,
        td,
        th,
        tr {
            border: none;
        }
    </style>
</head>


<body>

    <nav data-bs-theme="dark" class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="images/title.png" alt="icon" width="300" height="70"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <?php if ($loggedId != 0): ?>
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <form action="" method="POST">
                                <input type="submit" name="logout" value="logout" class="btn btn-outline-success btn-lg"
                                    style="margin-top: 6px;">
                            </form>
                        </li>
                        <li class="nav-item">

                            <button id="btn-izmeni" class="btn btn-primary btn-lg"
                                style="margin-top: 6px; margin-left: 25px;" onclick="sortTable()">sort</button>

                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a a class="nav-link active" aria-current="page"
                                href="registration.php"><b><big>Registration</big></b></a>
                        </li>
                        <li class="nav-item">
                            <a a class="nav-link active" aria-current="page" href="login.php"><b><big>Login</big></b></a>
                        </li>

                    </ul>
                <?php endif; ?>


                <form class=" d-flex" role="search">
                    <input id="myInput" class="form-control me-2" type="search" placeholder="Search"
                        onkeyup="pretrazi()">
                </form>

            </div>

        </div>

    </nav>