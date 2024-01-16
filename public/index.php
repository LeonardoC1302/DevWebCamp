
<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EventsController;
use Controllers\GiftsController;
use Controllers\SpeakersController;
use Controllers\UsersController;
use Controllers\APIEvents;

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

// Dashboard
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/speakers', [SpeakersController::class, 'index']);

$router->get('/admin/speakers/create', [SpeakersController::class, 'create']);
$router->post('/admin/speakers/create', [SpeakersController::class, 'create']);

$router->get('/admin/speakers/update', [SpeakersController::class, 'update']);
$router->post('/admin/speakers/update', [SpeakersController::class, 'update']);

$router->post('/admin/speakers/delete', [SpeakersController::class, 'delete']);

$router->get('/admin/events', [EventsController::class, 'index']);

$router->get('/admin/events/create', [EventsController::class, 'create']);
$router->post('/admin/events/create', [EventsController::class, 'create']);

$router->get('/api/events-schedule', [APIEvents::class, 'index']);

$router->get('/admin/users', [UsersController::class, 'index']);

$router->get('/admin/gifts', [GiftsController::class, 'index']);
$router->checkRoutes();