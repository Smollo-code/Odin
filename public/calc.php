<?php

namespace Monolog;

use Monolog\User\Handler\Calc\CalculatorGetHandler;

require '../vendor/autoload.php';
$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

$calculator = new Calculator();


$handler = new CalculatorGetHandler($calculator, $twig);
$response = $handler->handle($request);
echo $response->getBody();