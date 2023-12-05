<?php

namespace Monolog\User\Handler\Profile;

use GuzzleHttp\Psr7\Response;
use Monolog\User\Model\User\UserRepository;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class ProfileDataTransmitterGetHandler implements RequestHandlerInterface
{
    public function __construct(private UserRepository $db, private Environment $renderer, private PDO $pdo)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parseBody = $request->getParsedBody();
        $changed_username = $parseBody['changed_Username'];
        $picture = $parseBody['profilePicture'] ?? '';
        $id = $_SESSION['userId'];

        if ($this->checkIfNameExists($changed_username)) {
            $status = 'Username ist schon vergeben';
        } else {
            $this->db->update('user', array('username' => $changed_username, 'profileurl' => $picture), array('id' => $id));
            $status = 'Daten erfolgreich geändert';
        }

        return new Response(200, [], $this->renderer->render('profile.twig', ['name' => $changed_username, 'profileurl' => $picture, 'status' => $status]));
    }

    private function checkIfNameExists (string $username) : bool
    {
        if ($username === $_SESSION['userName']) {
            return False;
        }

        $sql = 'SELECT 
            `username`
            FROM
            `user`
            WHERE 
            `username` = :username';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            return True;
        } else {
            return False;
        }
    }

    /*private function changeProfileData (string $changed_username, string $picture, int $id) : void
    {
        $this->pdo->setAttribute($this->pdo::ATTR_ERRMODE, $this->pdo::ERRMODE_EXCEPTION);

        $sql = 'UPDATE 
            `user` 
            SET 
                `username` = :changed_username, 
                `profileurl` = :profileurl 
            WHERE 
                `id` = :id
        ';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':changed_username' ,$changed_username);
        $stmt->bindParam(':profileurl', $picture);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $_SESSION['userName'] = $changed_username;
        $_SESSION['profileUrl'] = $picture;
    }*/
}