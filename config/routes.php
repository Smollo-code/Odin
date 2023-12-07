<?php

use Monolog\App\ApplicationFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$route = new Route('/', ['handler' => function (ApplicationFactory $factory): requestHandlerInterface{
    return $factory->createUserFactory()
        ->createIndexGetHandler();
}]);
$routes->add('startpage', $route);


$route = new Route('/dashboard', ['handler' => 'dashboard']);
$routes->add('dashboard', $route);

$route = new Route('/login', ['handler' => 'login']);
$routes->add('login', $route);

$route = new Route('/logout', ['handler' => 'logout']);
$routes->add('logout', $route);

$route = new Route('/login', ['handler' => 'login']);
$routes->add('login', $route);


return $routes;