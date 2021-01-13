<?php
use app\controllers\SiteController;
use app\controllers\AuthorizeController;
use app\core\Application;

require_once __DIR__.'./vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
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



$app->db->applyMigrations();
?>