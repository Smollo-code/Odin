<?php

namespace Monolog\User\Handler\Dashboard;

use GuzzleHttp\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class DashboardGetHandler implements RequestHandlerInterface
{

    public function __construct(private PDO $pdo, private Environment $renderer)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();
        $username = $_SESSION['userName'];
        $profileUrl = $_SESSION['profileurl'] ?? '';

        return new Response(200, [], $this->renderer->render('dashboard.twig', ['name' => $username, 'picture' => $profileUrl]));
    }
}