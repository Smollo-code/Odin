<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Games;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class TicTacToeGetHandler implements RequestHandlerInterface
{
    public function __construct(private Environment $renderer)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, [], $this->renderer->render('tictactoe.twig', ['name' => 'Florian']));
    }
}