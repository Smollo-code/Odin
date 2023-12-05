<?php

namespace Monolog\User\Handler\Login;

use GuzzleHttp\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class LoginGetHandler implements RequestHandlerInterface
{

    public function __construct(private PDO $pdo, private Environment $renderer)
    {

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();
        $parseBody = $request->getParsedBody();
        $username = $parseBody['username'];
        $password = $parseBody['password'];

        $this->pdo->setAttribute($this->pdo::ATTR_ERRMODE, $this->pdo::ERRMODE_EXCEPTION);

        $sql = 'SELECT
        username, password, id, profileurl
        FROM
        `user`
        WHERE
        username = :username';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username, $this->pdo::PARAM_STR);

        try {
            $stmt->execute();
            $dbuser = $stmt->fetch($this->pdo::FETCH_ASSOC);

            if ($dbuser) {
                if (password_verify($password, $dbuser['password'])) {      //@phpstan-ignore-line
                    $_SESSION['userId'] = $dbuser['id'];                    //@phpstan-ignore-line
                    $_SESSION['userName'] = $dbuser['username'];            //@phpstan-ignore-line
                    $_SESSION['profileurl'] = $dbuser['profileurl'];        //@phpstan-ignore-line
                    header("location: /dashboard");
                    exit();
                } else {
                    $error = 'Wrong Password';
                }
            } else {
                $error = 'Wrong Username';
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }



        return new Response(200, [], $this->renderer->render('login.twig', ['error' => $error]));
    }
}