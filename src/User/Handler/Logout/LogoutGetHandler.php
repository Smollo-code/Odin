<?php

namespace Monolog\User\Handler\Logout;

use http\Env\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class LogoutGetHandler implements RequestHandlerInterface
{

    public function __construct(private Environment $renderer)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        unset($_SESSION['userId']);
        return new \GuzzleHttp\Psr7\Response(200, [], $this->renderer->render('login.twig',));
    }
}