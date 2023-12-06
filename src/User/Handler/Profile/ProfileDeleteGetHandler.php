<?php declare(strict_types=1);

namespace Monolog\User\Handler\Profile;

use GuzzleHttp\Psr7\Response;
use Monolog\User\Model\User\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class ProfileDeleteGetHandler implements RequestHandlerInterface
{

    public function __construct(private UserRepository $db, private Environment $renderer)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->db->delete('user', $_SESSION['userId']);
        unset($_SESSION['userId']);
        return new Response(200, [], $this->renderer->render('login.twig'));
    }
}