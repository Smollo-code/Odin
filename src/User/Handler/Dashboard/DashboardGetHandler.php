<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Dashboard;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class DashboardGetHandler implements RequestHandlerInterface
{

    public function __construct(private PDO $pdo, private Environment $renderer, private SessionInterface $session)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->session->isLoggedIn()) {
            return new Response(status: 302, headers: ['Location' => '/']);
        }


        $username = $_SESSION['userName'];
        $profileUrl = $_SESSION['profileurl'] ?? '';

        return new Response(
            200,
            [],
            $this->renderer->render('dashboard.twig', ['name' => $username, 'picture' => $profileUrl])
        );
    }
}