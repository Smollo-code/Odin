<?php
namespace Monolog;
use Monolog\User\Handler\Profile\ProfileGetHandler;
use PDO;

require '../vendor/autoload.php';



$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);
$pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');



$handler = new ProfileGetHandler($pdo, $twig);
$response = $handler->handle($request);
echo $response->getBody();

