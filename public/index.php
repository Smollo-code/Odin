<?php
require '../vendor/autoload.php';

session_start();
$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$applicationFactory = new \Monolog\App\ApplicationFactory();
$path = $request->getUri()->getPath();





if ($path === '/')
{
    if (isset($_SESSION['userId']) && is_numeric($_SESSION['userId']) > 0) {
        $content = $applicationFactory->createUserFactory()                         //@phpstan-ignore-line
            ->createDashboardGetHandler()
            ->handle($request);
    } else {
        $content = $applicationFactory->createUserFactory()                         //@phpstan-ignore-line
        ->createIndexGetHandler()
            ->handle($request);
    }

} elseif ($path === '/login') {
    $content = $applicationFactory->createUserFactory()                             //@phpstan-ignore-line
        ->createLoginGetHandler()
        ->handle($request);

} elseif ($path === '/logout') {
    unset($_SESSION['UserId']);
    header('Location: /');
} elseif ($path === '/dashboard') {
    $userId = $_SESSION['userId'] ?? 0;

    if ($userId != 0) {
        $content = $applicationFactory->createUserFactory()                         //@phpstan-ignore-line
        ->createDashboardGetHandler()
            ->handle($request);
    } else {
        header('Location: /');
    }
} elseif ($path === '/calc') {
    $content = $applicationFactory->createUserFactory()                             //@phpstan-ignore-line
        ->createCalculatorGetHandler()
        ->handle($request);
} elseif ($path === '/emailer') {
    $content = $applicationFactory->createUserFactory()                             //@phpstan-ignore-line
        ->createEmailerGetHandler()
        ->handle($request);
} elseif ($path === '/tictactoe') {
    $content = $applicationFactory->createUserFactory()                             //@phpstan-ignore-line
        ->createTicTacToeGetHandler()
        ->handle($request);
} elseif ($path === '/profile') {
    $content = $applicationFactory->createUserFactory()                             //@phpstan-ignore-line
        ->createProfileHandler()
        ->handle($request);
} elseif ($path === '/updatedb') {
    $content = $applicationFactory->createUserFactory()                             //@phpstan-ignore-line
        ->createProfileDataTransmitterGetHandler()
        ->handle($request);
} elseif ($path === '/register') {
    $content = $applicationFactory->createUserFactory()                             //@phpstan-ignore-line
        ->createRegisterGetHandler()
        ->handle($request);
} elseif ($path === '/delete') {
    $content = $applicationFactory->createUserFactory()
        ->createDeleteHandler()
        ->handle($request);
}

if (isset($content)) {
    $applicationFactory->emitter()->emmit($content);
} else {
    $content = $applicationFactory->createUserFactory()                         //@phpstan-ignore-line
    ->createIndexGetHandler()
        ->handle($request);
}

