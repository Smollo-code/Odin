<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Emailer;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use Monolog\User\Model\User\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class EmailSenderGetHandler implements RequestHandlerInterface
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
        mail(
            $parseBody['recipient'],
            $parseBody['subject'],
            $parseBody['message']
        );
        return new Response(200, [], $this->renderer->render('emailer.twig'));
    }
}