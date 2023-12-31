<?php

namespace Monolog\User\Handler\Error;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class ErrorGetHandler implements RequestHandlerInterface

{
    public function __construct(private Environment $renderer, private SessionInterface $session)
    {
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->session->isLoggedIn()) {
            return new Response(status: 302, headers: ['Location' => '/']);
        }


        return new Response(200, [], $this->renderer->render('404.twig'));
    }
}