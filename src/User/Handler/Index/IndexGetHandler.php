<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Index;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class IndexGetHandler implements RequestHandlerInterface
{

    public function __construct(private Environment $renderer)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, [], $this->renderer->render('login.twig'));
    }
}