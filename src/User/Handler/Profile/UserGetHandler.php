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
            'age' => '',
            'job' => '',
            'profileurl' => ''
        ]);
        }

        $id = $_SESSION['userId'];

        if (!empty($_POST)) {
            $this->db->update(
                'user',
                array('username' => $_POST['recipient']),
                array('id' => $id)
            );

            $this->db->update(
                'userinfo',
                array('username' => $_POST['recipient'], 'name' => $_POST['name'], 'surname' => $_POST['surname'], 'age' => $_POST['age'], 'job' => $_POST['job']),
                array('id' => $id)
            );
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


        $sql = $this->db->userDataTransmitter();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $userResult = $stmt->fetch();

        $usernameUsers = $userResult['username'];
        $nameUsers = $userResult['name'];
        $surnameUsers = $userResult['surname'];
        $ageUsers = $userResult['age'];
        $jobUsers = $userResult['job'];
        $profileUrlUsers = $userResult['profileurl'];


        return new Response(
            200,
            [],
            $this->renderer->render('user.twig', [
                'selfUsername' => $username,
                'selfName' => $name,
                'selfSurname' => $surname,
                'selfAge' => $age,
                'job' => $job,

                'usernameUsers' => $usernameUsers,
                'nameUsers' => $nameUsers,
                'surnameUsers' => $surnameUsers,
                'ageUsers' => $ageUsers,
                'jobUsers' => $jobUsers,
                'profileUrlUsers' => $profileUrlUsers
            ])
        );
    }
}
