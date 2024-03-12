<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if ($user->getState() == 1) {
        header('Location: /food-mania');
        exit();
    }
}

?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="public/assets/burger.png" type="image/x-icon">
        <title>Register</title>

        <link rel="stylesheet" href="../public/assets/css/style.css">

    </head>
    <body>
        <div class="register-form_container">
            <h1>Register</h1>

            <form action="/food-mania/register" method="post" class="register-form" name="register-form">
                <input type="hidden" name="form-name" value="register-form">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" value="<?= (isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['email'] : ''); unset($_SESSION['old_inputs']) ?>" required>

                <label for="password">Password</label>
                <input class="password" type="password" name="password" id="password" placeholder="Password" required>

                <label for="confirm-password">Confirm Password</label>
                <input class="password" type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required>

                <button type="submit">Register</button>
            </form>

            <?php if (isset($_SESSION['errors'])) { ?>
                <div class="errors">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php } ?>

            <button class="login-button">
                <a href="/food-mania/login">Login</a>
            </button>
        </div>
    </body>
</html>