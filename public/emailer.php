<?php
require '../vendor/autoload.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

$applicationFactory = new \Monolog\App\ApplicationFactory();
echo $applicationFactory->createUserFactory()                       //@phpstan-ignore-line
    ->createEmailerGetHandler()
    ->handle($request)
    ->getBody();
