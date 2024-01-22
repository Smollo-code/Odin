<?php

namespace Monolog\User\Handler\Games;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use Monolog\User\Model\User\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class RouletteDatabaseHandler implements RequestHandlerInterface
{

    public function __construct(private Environment $renderer, private UserRepository $db, private SessionInterface $session)
    {
    }



    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->session->isLoggedIn()) {
            return new Response(status: 302, headers: ['Location' => '/']);
        }
        $money = $_GET['data'];

        $this->db->update('roulette', ['geld' => $money], ['id' => $_SESSION['userId']]);

        return new Response(200);
    }
}