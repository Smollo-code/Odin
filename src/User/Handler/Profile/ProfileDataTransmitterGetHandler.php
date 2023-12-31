<?php

declare(strict_types=1);

namespace Monolog\User\Handler\Profile;

use GuzzleHttp\Psr7\Response;
use Monolog\App\Session\SessionInterface;
use Monolog\User\Model\User\UserRepository;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class ProfileDataTransmitterGetHandler implements RequestHandlerInterface
{
    public function __construct(private UserRepository $db, private Environment $renderer, private PDO $pdo, private SessionInterface $session)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if (!$this->session->isLoggedIn()) {
            return new Response(status: 302, headers: ['Location' => '/']);
        }

        $parseBody = $request->getParsedBody();
        $changed_username = $parseBody['changed_Username'];
        $email = $parseBody['email'] ?? '';
        $picture = $parseBody['profilePicture'] ?? '';
        $id = $_SESSION['userId'];

        if ($this->checkIfNameExists($changed_username)) {
            $status = 'Benutzername ist schon vergeben';
        } else {
            $this->db->update(
                'user',
                array('username' => $changed_username, 'profileurl' => $picture, 'email' => $email),
                array('id' => $id)
            );
            $_SESSION['userName'] = $changed_username;
            $_SESSION['profileurl'] = $picture;
            $_SESSION['email'] = $email;
            $status = 'Daten erfolgreich geändert';
        }

        return new Response(
            200,
            [],
            $this->renderer->render(
                'profile.twig',
                ['name' => $changed_username, 'profileurl' => $picture, 'status' => $status, 'email' => $email]
            )
        );
    }

    private function checkIfNameExists(string $username): bool
    {
        if ($username === $_SESSION['userName']) {
            return false;
        }

        $sql = $this->db->profileDataTransmitter();
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}