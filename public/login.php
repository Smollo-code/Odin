<?php

require '../vendor/autoload.php';
require './MyHandler.php';

session_start();
$username = MyHandler::handleServerRequest('post', 'username');
$password = MyHandler::handleServerRequest('post', 'password');

$pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT
        username, password, id, profileurl
        FROM
        `user`
        WHERE
        username = :username';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);

try {
    $stmt->execute();
    $dbuser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dbuser) {
        if (password_verify($password, $dbuser['password'])) {      //@phpstan-ignore-line
            $_SESSION['userId'] = $dbuser['id'];                    //@phpstan-ignore-line
            $_SESSION['userName'] = $dbuser['username']; //@phpstan-ignore-line
            $_SESSION['profileurl'] = $dbuser['profileurl'];
            header("location: dashboard.php");
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

$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);

echo $twig->render('login.twig', ['error' => $error]);