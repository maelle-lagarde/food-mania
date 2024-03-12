<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controller\AuthenticationController;

session_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$router = new AltoRouter();
$router-> setBasePath('/food-mania');


$router->map('GET', '/', function(){
    require_once 'View/home.php';
}, 'home');

$router->map('GET', '/register', function(){
    require_once 'View/register.php';
}, 'register');

$router->map('GET', '/login', function(){
    require_once 'View/login.php';
}, 'login');

$router->map('GET', '/logout', function () {
    header('Location: View/logout.php');
    exit();
});

$router->map('GET', '/search-product', function () {
    header('Location: View/search-product.php');
    exit();
});

$router->map('POST', '/login', function () {
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['form-name']) && $_POST['form-name'] === 'login-form') {
            $authentication = new AuthenticationController();
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            if ($authentication->login($email, $password)) {
                header("Location: View/home.php");
            } else {
                header("Location: View/login.php");
            }
            exit;
        }
    }
});

$router->map('POST', '/register', function () {
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['form-name']) && $_POST['form-name'] === 'register-form') {
            $authentication = new AuthenticationController();
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $confirmPassword = filter_input(INPUT_POST, 'confirm-password', FILTER_SANITIZE_STRING);

            if ($authentication->register($email, $password, $confirmPassword)) {
                header("Location: View/login.php");
            } else {
                header("Location: View/register.php");
            }
            exit;
        }
    }
});


$match = $router->match();

// call closure or throw 404 status
if( is_array($match) && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}