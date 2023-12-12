<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Profile;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use Monolog\User\Model\User\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class ProfileDeleteGetHandler implements RequestHandlerInterface
{

    public function __construct(private UserRepository $db, private Environment $renderer, private SessionInterface $session)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->session->isLoggedIn()) {
            return new Response(status: 302, headers: ['Location' => '/']);
        }

        $parseBody = $request->getParsedBody();
        if (password_verify(
            $parseBody['confirmDelete'],
            $this->db->select('user', array('password'), array('id' => $_SESSION['userId']))
        )) {
            if ($this->db->delete('user', array('id' => $_SESSION['userId']))) {
                unset($_SESSION['userId']);
                header('/');
            } else {
                $status = 'Database error';
            }
        }

        return new Response(200, [], $this->renderer->render('login.twig', ['status' => $status ?? '']));
    }
}