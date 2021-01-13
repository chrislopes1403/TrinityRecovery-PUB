<?php
namespace app\chatServer;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use app\chatServer\Chat;
require dirname(__DIR__) . './vendor/autoload.php';
$server = IoServer::factory(
  new HttpServer(
    new WsServer(
      new Chat()
    )
  ),
  8085

);
$server->run();
?>