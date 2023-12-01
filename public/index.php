<?php

require '../vendor/autoload.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);

$hanlder = new \Monolog\User\Handler\Index\IndexGetHandler($twig);
$response = $hanlder->handle($request);
echo $response->getBody();