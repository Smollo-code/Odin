<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Games;

use GuzzleHttp\Psr7\Response;
use Monolog\User\Model\User\UserRepository;
use mysql_xdevapi\RowResult;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class RouletteGetHandler implements RequestHandlerInterface
{

    public function __construct(private Environment $renderer, private UserRepository $db)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $money = $this->db->select('roulette', ['geld'], ['id' => $_SESSION['userId']]);

        if ($money) {
        } else {
            $this->db->insert('roulette', ['id' => $_SESSION['userId'], 'geld' => '100']);
            $money = $this->db->select('roulette', ['geld'], ['id' => $_SESSION['userId']]);
        }

        return new Response(200, [], $this->renderer->render('roulette.twig', ['money' => $money]));
    }
}