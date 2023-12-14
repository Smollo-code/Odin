<?php

namespace Monolog\User\Handler\Profile;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use Monolog\User\Model\User\UserRepository;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class UserGetHandler implements RequestHandlerInterface
{
    public function __construct(private PDO $PDO, private Environment $renderer, private SessionInterface $session, private UserRepository $db)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            if (!$this->session->isLoggedIn()) {
                return new Response(status: 302, headers: ['Location' => '/']);
            }

            $existingUserData = $this->db->select('userinfo', ['id'], ['id' => $_SESSION['userId']]);

            if (!$existingUserData) {
            $this->db->insert('userinfo', [
                'id' => $_SESSION['userId'],
                'username' => 'Benny',
                'name' => 'Testname',
                'surname' => 'Testsurname',
                'age' => '27.5.2000'
            ]);
            }

            // Benutzerdaten aus der Datenbank abrufen
            $userData = $this->db->select('userinfo', ['username', 'name', 'surname', 'age', 'job', 'profileurl'], ['id' => $_SESSION['userId']]);

            if (!$userData) {
                throw new \RuntimeException('Fehler beim Abrufen der Benutzerdaten.');
            }

            $username = $_SESSION['userName'];
            $usernameusers = $userData['username'] ?? '';
            $name = $userData['name'] ?? '';
            $surname = $userData['surname'] ?? '';
            $age = $userData['age'] ?? '';
            $job = $userData['job'] ?? '';
            $profilepictureusers = $userData['profileurl'] ?? '';
            $information = '';

            return new Response(
                200,
                [],
                $this->renderer->render('user.twig', [
                    'username' => $username,
                    'name' => $name,
                    'surname' => $surname,
                    'age' => $age,
                    'job' => $job,
                    'usernameusers' => $usernameusers,
                    'profilepictureusers' => $profilepictureusers,
                    'information' => $information
                ])
            );
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return new Response(status: 302, headers: ['Location' => '/404']);
        }
    }
}
