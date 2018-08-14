<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 28/06/18
 * Time: 11:08
 */


require __DIR__.'/vendor/autoload.php';

use React\Http\Server;
use React\Http\Response;
use React\EventLoop\Factory;
use Psr\Http\Message\ServerRequestInterface;
use \App\Router;



// ------ Router
$loop = React\EventLoop\Factory::create();
$router = new Router($loop);
$router->load(__DIR__ . '/routes.php');

$server = new Server(function (ServerRequestInterface $request) use ($router){

     return $router($request);
});


$socket = new \React\Socket\Server('127.0.0.1:8080', $loop);
$server->listen($socket);

echo 'Listening on '
    .str_replace('tcp:', 'http:', $socket->getAddress())
    .PHP_EOL;



$loop->run();
