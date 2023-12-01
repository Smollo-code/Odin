<?php

namespace Monolog\User\Handler\Register;

use GuzzleHttp\Psr7\Response;
use PDO;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class RegisterGetHandler implements RequestHandlerInterface
{

    public function __construct(private PDO $pdo, private Environment $renderer)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {


        $parseBody = $request->getParsedBody();
        $username = $parseBody['new_username'];
        $password = password_hash($parseBody['new_password'], PASSWORD_BCRYPT);
        $confirmPassword = $parseBody['confirm_password'];

        function checkPassword () : bool {
            $password = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];
            if ($password === $confirmPassword) {
                return True;
            } else {
                return False;
            }
        }


        $sql = '
        INSERT INTO 
            user (username, password) 
        VALUES 
            (:username, :password)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username' ,$username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $this->pdo->lastInsertId();





        return new Response(200, [], $this->renderer->render('register.twig'));
    }
}