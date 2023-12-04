<?php

namespace Monolog;

use Monolog\User\Handler\Calc\CalculatorGetHandler;

require '../vendor/autoload.php';
$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

$applicationFactory = new \Monolog\App\ApplicationFactory();
echo $applicationFactory->createUserFactory()                       //@phpstan-ignore-line
    ->createCalculatorGetHandler()
    ->handle($request)
    ->getBody();