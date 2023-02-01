<body>
    <footer style="padding-top: 70px">
        <?php if ($loggedId == 0): ?>

            <div class="center">
                <form action="" method="POST">
                    <a href="login.php" class="btn yellow accent-3 black-text nav-text">
                        <b><big>Login</big></b>
                    </a>
                </form>
            </div>
            <div class="center black-text text-darken-2"><b>&copy; FILM REVIEW 2023</b></div>

        <?php else: ?>

            <div class="center black-text text-darken-2"><b>&copy; FILM REVIEW 2023</b></div>

        <?php endif; ?>
    </footer>
</body>