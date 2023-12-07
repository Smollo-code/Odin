<?php

use Monolog\App\ApplicationFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$route = new Route('/', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createIndexGetHandler();
}]);
$routes->add('startpage', $route);


$route = new Route('/dashboard', ['handler' => 'dashboard']);
$routes->add('dashboard', $route);

$route = new Route('/foo/{id}', ['handler' => 'foo']);
$routes->add('foo', $route);

return $routes;