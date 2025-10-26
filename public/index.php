<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;

// Start session
session_start();

// Initialize Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/views', __DIR__ . '/../src/components',);
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Disable cache for development
    'debug' => true,
]);

// Add debug extension
$twig->addExtension(new \Twig\Extension\DebugExtension());

// Create router
$router = new Router($twig);

// Helper function to check authentication
function requireAuth() {
    if (!isset($_SESSION['ticketapp_session'])) {
        header('Location: /auth/login');
        exit;
    }
}

// Routes
$router->get('/', function($twig) {
    echo $twig->render('landing.twig');
});

$router->get('/auth/login', function($twig) {
    echo $twig->render('login.twig');
});

$router->get('/auth/signup', function($twig) {
    echo $twig->render('signup.twig');
});

$router->get('/dashboard', function($twig) {
    requireAuth();
    echo $twig->render('dashboard.twig');
});

$router->get('/tickets', function($twig) {
    requireAuth();
    echo $twig->render('tickets.twig');
});

// Run router
$router->run();