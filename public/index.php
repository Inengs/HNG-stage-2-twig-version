<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;

// Start session
session_start();

// Initialize Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src'); 
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
    echo $twig->render('views/landing.twig');
});

$router->get('/auth/login', function($twig) {
    echo $twig->render('views/login.twig');
});

$router->get('/auth/signup', function($twig) {
    echo $twig->render('views/signup.twig');
});

$router->get('/dashboard', function($twig) {
    requireAuth();
    echo $twig->render('views/dashboard.twig');
});

$router->get('/tickets', function($twig) {
    requireAuth();
    echo $twig->render('views/tickets.twig');
});

// API Routes for session management
$router->post('/api/login', function($twig) {
    header('Content-Type: application/json');
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['token'])) {
        $_SESSION['ticketapp_session'] = $input['token'];
        echo json_encode(['success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'No token provided']);
    }
    exit;
});

$router->post('/api/logout', function($twig) {
    header('Content-Type: application/json');
    
    unset($_SESSION['ticketapp_session']);
    session_destroy();
    
    echo json_encode(['success' => true]);
    exit;
});

// Run router
$router->run();