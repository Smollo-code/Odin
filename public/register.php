<?php
require '../vendor/autoload.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);
$pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');



$hanlder = new \Monolog\User\Handler\Register\RegisterGetHandler($pdo, $twig);
$response = $hanlder->handle($request);
echo $response->getBody();
