<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Monolog\App\ApplicationFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require '../vendor/autoload.php';

session_start();
$request = ServerRequest::fromGlobals();
$applicationFactory = new ApplicationFactory();
$routes = require __DIR__ . '/../config/routes.php';

$matcher = new UrlMatcher($routes, new RequestContext());
try {
    $parameters = $matcher->match($request->getUri()->getPath());
    $handler = ($parameters['handler'])($applicationFactory);
    if ($handler instanceof RequestHandlerInterface) {
        $response = $handler->handle($request);
        $applicationFactory->emitter()->emmit($response);
    }
} catch (ResourceNotFoundException) {
    $content = $applicationFactory->createUserFactory()                     //@phpstan-ignore-line
        ->createErrorGetHandler()
        ->handle($request);
    $applicationFactory->emitter()->emmit($content);
} catch (Exception $exception) {
    error_log($exception->getMessage());
    $applicationFactory->emitter()->emmit(
        new Response(status: 302, headers: ['Location' => '/404'])
    );
}