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

    public function __construct(private PDO $pdo, private Environment $renderer, private SessionInterface $session, private UserRepository $db)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        if (!$this->session->isLoggedIn()) {
            return new Response(status: 302, headers: ['Location' => '/']);
        }

        $existingUserData = $this->db->select('userinfo', ['id'], ['id' => $_SESSION['userId']]);

        if (!$existingUserData) {
        $this->db->insert('userinfo', [
            'id' => $_SESSION['userId'],
            'username' => $_SESSION['userName'],
            'name' => '',
            'surname' => '',
            'age' => ''
        ]);
        }

        $sql = $this->db->findUserById();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['userId']);
        $stmt->execute();
        $result = $stmt->fetch();


        $username = $_SESSION['userName'];
        $name = $result['name'] ?? '';
        $surname = $result['surname'] ?? '';
        $age = $result['age'] ?? '';
        $job = $result['job'] ?? '';
        $usernameUsers = '';
        $profilepictureusers = '';
        $information = '';

        return new Response(
            200,
            [],
            $this->renderer->render('user.twig', [
                'selfUsername' => $username,
                'selfName' => $name,
                'selfSurname' => $surname,
                'selfAge' => $age,
                'selfJob' => $job,
                'usernameUsers' => $usernameUsers,
                'profilePictureUsers' => $profilepictureusers,
                'information' => $information
            ])
        );
    }
}
