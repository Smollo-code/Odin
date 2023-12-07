<?php

use Monolog\App\ApplicationFactory;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();







$route = new Route('/', ['handler' => function (ApplicationFactory $factory): requestHandlerInterface{
    if (isset($_SESSION['userId']) && is_numeric($_SESSION['userId']) > 0) {
        return $factory->createUserFactory()
            ->createDashboardGetHandler();
    } else {
        return $factory->createUserFactory()
            ->createIndexGetHandler();
    }

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
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createCalculatorGetHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('calc', $route);

$route = new Route('/emailer', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createEmailerGetHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('emailer', $route);

$route = new Route('/tictactoe', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createTicTacToeGetHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('tictactoe', $route);

$route = new Route('/profile', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createProfileHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('profile', $route);

$route = new Route('/updatedb', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createProfileDataTransmitterGetHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('updatedb', $route);

$route = new Route('/register', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createRegisterGetHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('register', $route);

$route = new Route('/delete', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createDeleteHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('delete', $route);

$route = new Route('/emailsender', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createEmailSenderGetHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('emailsender', $route);

$route = new Route('/gewinnt', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createGewinntHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('gewinnt', $route);

$route = new Route('/roulette', ['handler' => function (ApplicationFactory $factory): RequestHandlerInterface {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        return $factory->createUserFactory()
            ->createRouletteHandler();
    } else {
        header('Location: /');
    }
}]);

$routes->add('roulette', $route);


return $routes;