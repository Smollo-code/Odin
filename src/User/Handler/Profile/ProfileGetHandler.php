<?php

namespace Monolog\User\Handler\Profile;

use GuzzleHttp\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class ProfileGetHandler implements RequestHandlerInterface
{

    public function __construct(private PDO $pdo, private Environment $renderer)
    {

    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();
        $username = $_SESSION['userName'];
        $profileurl = $_SESSION['profileUrl'] ?? '';
        $loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);

        return new Response(200, [], $this->renderer->render('profile.twig', ['name' => $username, 'profileurl' => $profileurl]));
    }
}