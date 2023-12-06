<?php
require '../vendor/autoload.php';

session_start();
$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$applicationFactory = new \Monolog\App\ApplicationFactory();
$path = $request->getUri()->getPath();





if ($path === '/')
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
}

if (isset($content)) {
    $applicationFactory->emitter()->emmit($content);
} else {
    $content = $applicationFactory->createUserFactory()
    ->createIndexGetHandler()
        ->handle($request);
}

