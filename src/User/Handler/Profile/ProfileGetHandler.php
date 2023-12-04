<?php

namespace Monolog\User\Handler\Profile;

use GuzzleHttp\Psr7\Response;
use Monolog\User\Model\User\userRepository;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class ProfileGetHandler implements RequestHandlerInterface
{

    public function __construct(private UserRepository $db, private Environment $renderer)
    {

    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();
        $parseBody = $request->getParsedBody();
        $username = $_SESSION['userName'];
        $profileurl = $_SESSION['profileUrl'] ?? '';
        $changed_username = $parseBody('changed_Username');
        $picture = $parseBody('profilePicture') ?? '';
        $id = $_SESSION['userId'];

        function checkIfNameExists (string $username) : bool
        {
            if ($username === $_SESSION['userName']) {
                return False;
            }

            // Select sql

            if ($stmt->rowCount() > 0)
            {
                return True;
            } else {
                return False;
            }
        }

        function changeProfileData (string $changed_username, string $picture, int $id) : void
        {


            $pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // update

            $_SESSION['userName'] = $changed_username;
            $_SESSION['profileUrl'] = $picture;
        }


        if (checkIfNameExists($changed_username)) {
            $status = 'Username ist schon vergeben';
        } else {
            changeProfileData($changed_username, $picture, $id);
            $status = 'Daten erfolgreich geändert';
        }

        return new Response(200, [], $this->renderer->render('profile.twig', ['name' => $username, 'profileurl' => $profileurl]));
    }
}