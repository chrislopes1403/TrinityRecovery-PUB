<?php
use app\controllers\MainController;
use app\controllers\AuthorizeController;
use app\core\Application;

require_once __DIR__.'./../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [ 
    'userClass'=> app\models\RegisterModel::class,
    'db' => [
        'dsn'=>$_ENV['DB_DSN'],
        'user'=>$_ENV['DB_USER'],
        'password'=>$_ENV['DB_PASSWORD']

    ]
];

$app= new Application( __DIR__,$config);

$app->router->get('/', [MainController::class, 'home']);
$app->router->get('/pricing', [MainController::class, 'pricing']);
$app->router->get('/appointment', [MainController::class, 'appointment']);
$app->router->get('/contact', [MainController::class, 'contact']);

$app->router->get('/appointment/booking', [MainController::class, 'booking']);
$app->router->get('/appointment/booking', [MainController::class, 'booking']);
$app->router->post('/appointment/booking/addAppointment', [MainController::class, 'addAppointment']);
$app->router->post('/appointment/booking/getAppointmentTimes', [MainController::class, 'getAppointmentTimes']);


$app->router->get('/login', [AuthorizeController::class, 'login']);
$app->router->post('/login', [AuthorizeController::class, 'login']);

$app->router->get('/register', [AuthorizeController::class, 'register']);
$app->router->post('/register', [AuthorizeController::class, 'register']);

$app->router->get('/logout', [AuthorizeController::class, 'logout']);

$app->router->get('/doctor', [AuthorizeController::class, 'doctor']);
$app->router->get('/doctor/appointments', [AuthorizeController::class, 'doctorAppointments']);
$app->router->get('/doctor/messages', [AuthorizeController::class, 'doctorMessage']);
$app->router->post('/doctor/messages', [AuthorizeController::class, 'doctorMessage']);

$app->router->get('/contact/chat', [AuthorizeController::class, 'chat']);
$app->router->post('/contact/getChats', [AuthorizeController::class, 'getChats']);
$app->router->post('/contact/sendChatMessage', [AuthorizeController::class, 'sendChatMessage']);

$app->router->get('/contact/message', [AuthorizeController::class, 'message']);
$app->router->post('/contact/message', [AuthorizeController::class, 'message']);


$app->run();
?>