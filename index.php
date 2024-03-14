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
    require_once 'View/logout.php';}, 'logout');

$router->map('GET', '/search-product', function () {
    require_once 'View/search-product.php';
}, 'search-product');

$router->map('GET', '/my-products', function () {
    require_once 'View/my-products.php';
}, 'save-product');

$router->map('POST', '/login', function () {
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['form-name']) && $_POST['form-name'] === 'login-form') {
            $authentication = new AuthenticationController();
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            if ($authentication->login($email, $password)) {
                require_once 'View/home.php';
            } else {
                require_once 'View/login.php';
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
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
            $confirmPassword = filter_input(INPUT_POST, 'confirm-password', FILTER_DEFAULT);

            if ($authentication->register($email, $password, $confirmPassword)) {
                require_once 'View/login.php';
            } else {
                require_once 'View/register.php';
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