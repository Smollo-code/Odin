<?php
require '../vendor/autoload.php';

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();

$applicationFactory = new \Monolog\App\ApplicationFactory();
$path = $request->getUri()->getPath();
$content = "404 not Found for $path";
if ($path === '/')
{
    $content = $applicationFactory->createUserFactory()                       //@phpstan-ignore-line
    ->createIndexGetHandler()
        ->handle($request)
        ->getBody();

} elseif ($path === '/dashboard') {
    $content = $applicationFactory->createUserFactory()                       //@phpstan-ignore-line
    ->createDashboardGetHandler()
        ->handle($request)
        ->getBody();
}
echo $applicationFactory->emitter()->Emmit();