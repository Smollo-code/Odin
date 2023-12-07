<?php

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
$routes = require __DIR__.'/../config/routes.php';

$matcher = new UrlMatcher($routes, new RequestContext());
try {
    $parameters = $matcher->match($request->getUri()->getPath());
    $handler = ($parameters['handler'])($applicationFactory);
    if ($handler instanceof RequestHandlerInterface) {
        $response = $handler->handle($request);
        $applicationFactory->emitter()->emmit($response);
    }
} catch (ResourceNotFoundException) {
    $content = $applicationFactory->createUserFactory()
        ->createErrorGetHandler()
        ->handle($request);
    $applicationFactory->emitter()->emmit($content);
}



/*if ($path === '/')
{
    if (isset($_SESSION['userId']) && is_numeric($_SESSION['userId']) > 0) {
        $content = $applicationFactory->createUserFactory()
            ->createDashboardGetHandler()
            ->handle($request);
    } else {
        $content = $applicationFactory->createUserFactory()
        ->createIndexGetHandler()
            ->handle($request);
    }

} elseif ($path === '/login') {
    $content = $applicationFactory->createUserFactory()
        ->createLoginGetHandler()
        ->handle($request);

} elseif ($path === '/logout') {
    $content = $applicationFactory->createUserFactory()                             //@phpstan-ignore-line
        ->createLogoutGetHandler()
        ->handle($request);

} elseif ($path === '/dashboard') {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        $content = $applicationFactory->createUserFactory()
        ->createDashboardGetHandler()
            ->handle($request);
    } else {
        header('Location: /');
    }
} elseif ($path === '/calc') {
    $content = $applicationFactory->createUserFactory()
        ->createCalculatorGetHandler()
        ->handle($request);
} elseif ($path === '/emailer') {
    $content = $applicationFactory->createUserFactory()
        ->createEmailerGetHandler()
        ->handle($request);
} elseif ($path === '/tictactoe') {
    $content = $applicationFactory->createUserFactory()
        ->createTicTacToeGetHandler()
        ->handle($request);
} elseif ($path === '/profile') {
    $content = $applicationFactory->createUserFactory()
        ->createProfileHandler()
        ->handle($request);
} elseif ($path === '/updatedb') {
    $content = $applicationFactory->createUserFactory()
        ->createProfileDataTransmitterGetHandler()
        ->handle($request);
} elseif ($path === '/register') {
    $content = $applicationFactory->createUserFactory()
        ->createRegisterGetHandler()
        ->handle($request);
} elseif ($path === '/delete') {
    $content = $applicationFactory->createUserFactory()
        ->createDeleteHandler()
        ->handle($request);
} elseif ($path === '/emailsender') {
    $content = $applicationFactory->createUserFactory()
        ->createEmailSenderGetHandler()
        ->handle($request);
} elseif ($path === '/gewinnt') {
    $content = $applicationFactory->createUserFactory()
        ->createGewinntHandler()
        ->handle($request);
} elseif ($path === '/roulette') {
    $content = $applicationFactory->createUserFactory()
        ->createRouletteHandler()
        ->handle($request);
} elseif ($path === '/404') {
    $content = $applicationFactory->createUserFactory()
        ->createRouletteHandler()
        ->handle($request);
}
if (isset($content)) {
    $applicationFactory->emitter()->emmit($content);
} else {
    $content = $applicationFactory->createUserFactory()
    ->createIndexGetHandler()
        ->handle($request);
}
*/