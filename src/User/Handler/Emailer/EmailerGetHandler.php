<?php

namespace Monolog\User\Handler\Emailer;

use GuzzleHttp\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class EmailerGetHandler implements RequestHandlerInterface
{
    public function __construct(private Environment $renderer)
    {

    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();


        return new Response(200, [], $this->renderer->render('emailer.twig',));
    }



}