<?php

use Monolog\User\Handler\Profile\ProfileGetHandler;
use Monolog\User\Model\User\userRepository;

require '../vendor/autoload.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$applicationFactory = new \Monolog\App\ApplicationFactory();
echo $applicationFactory->createUserFactory()                       //@phpstan-ignore-line
    ->createProfileHandler()
    ->handle($request)
    ->getBody();

