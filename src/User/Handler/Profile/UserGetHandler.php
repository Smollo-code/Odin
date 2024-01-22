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

        $sql = $this->db->userDataTransmitter();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $userResult = $stmt->fetchAll();


        return new Response(
            200,
            [],
            $this->renderer->render('user.twig', [
                'username' => $userResult
            ])
        );
    }
}
