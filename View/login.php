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
        <link rel="stylesheet" type="text/css" href="public/assets/style/style.css">
        <link rel="icon" href="public/assets/burger.png" type="image/x-icon">
        <title>Food Mania - Login</title>

        <link rel="stylesheet" href="../public/assets/css/style.css">

    </head>

    <body>

        <div class="wrapper">
            
            <h1>Login</h1>

                <form action="/food-mania/login" method="post" name="login-form">
                    <input type="hidden" name="form-name" value="login-form">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']->getEmail() : (isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['email'] : ''); unset($_SESSION['old_inputs']) ?>" required>

                    <label for="password">Password</label>
                    <input class="password" type="password" name="password" id="password" placeholder="Password" required>

                    <button class="submit" type="submit">Login</button>
                </form>

                <?php if (isset($_SESSION['error'])) { ?>
                    <p><?= $_SESSION['error'] ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php } ?>
                
                <div class="back-button">
                    <a href="/food-mania/" class="home-button">Home</a>
                    <a href="/food-mania/register" class="home-button">Register</a>
                </div>
        
        </div>
       
    </body>
</html>