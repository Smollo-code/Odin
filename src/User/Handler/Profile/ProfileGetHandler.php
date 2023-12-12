<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Profile;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use Monolog\User\Model\User\userRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class ProfileGetHandler implements RequestHandlerInterface
{

    public function __construct(private UserRepository $db, private Environment $renderer, private SessionInterface $session)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->session->isLoggedIn()) {
            return new Response(status: 302, headers: ['Location' => '/']);
        }

        $username = $_SESSION['userName'];
        $email = $_SESSION['email'] ?? '';
        $profileurl = $_SESSION['profileurl'] ?? '';

        return new Response(
            200,
            [],
            $this->renderer->render(
                'profile.twig',
                ['name' => $username, 'profileurl' => $profileurl, 'email' => $email]
            )
        );
    }
}