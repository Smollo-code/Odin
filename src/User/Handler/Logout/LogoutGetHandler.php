<?php

namespace Monolog\User\Handler\Logout;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class LogoutGetHandler implements RequestHandlerInterface
{

    public function __construct(private Environment $renderer, private SessionInterface $session)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        unset($_SESSION['userId']);
        session_destroy();
        return new Response(302, ['Location' => '/']);
    }
}