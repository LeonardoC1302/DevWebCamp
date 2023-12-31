<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Register
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

// Forgot Password
$router->get('/forgot', [AuthController::class, 'forgot']);
$router->post('/forgot', [AuthController::class, 'forgot']);

// Reset Password
$router->get('/reset', [AuthController::class, 'reset']);
$router->post('/reset', [AuthController::class, 'reset']);

// Confirm Account
$router->get('/message', [AuthController::class, 'message']);
$router->get('/confirm', [AuthController::class, 'confirm']);


$router->checkRoutes();