<?php

use Monolog\App\ApplicationFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();







$route = new Route('/', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createIndexGetHandler();
}]);
$routes->add('index', $route);

$route = new Route('/dashboard', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createDashboardGetHandler();
}]);
$routes->add('dashboard', $route);

$route = new Route('/login', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createLoginGetHandler();
}]);

$routes->add('login', $route);

$route = new Route('/logout', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createLogoutGetHandler();
}]);

$routes->add('logout', $route);

$route = new Route('/calc', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createCalculatorGetHandler();
}]);

$routes->add('calc', $route);

$route = new Route('/emailer', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createEmailerGetHandler();
}]);

$routes->add('emailer', $route);

$route = new Route('/tictactoe', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createTicTacToeGetHandler();
}]);

$routes->add('tictactoe', $route);

$route = new Route('/profile', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createProfileHandler();
}]);

$routes->add('profile', $route);

$route = new Route('/updatedb', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createProfileDataTransmitterGetHandler();
}]);

$routes->add('updatedb', $route);

$route = new Route('/register', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createRegisterGetHandler();
}]);

$routes->add('register', $route);

$route = new Route('/delete', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createDeleteHandler();
}]);

$routes->add('delete', $route);

$route = new Route('/emailsender', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createEmailSenderGetHandler();
}]);

$routes->add('emailsender', $route);

$route = new Route('/gewinnt', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createGewinntHandler();
}]);

$routes->add('gewinnt', $route);

$route = new Route('/roulette', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    return $factory->createUserFactory()
        ->createRouletteHandler();
}]);

$routes->add('roulette', $route);


return $routes;