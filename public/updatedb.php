<?php
require '../vendor/autoload.php';
require './MyHandler.php';



session_start();
$changed_username = MyHandler::handleServerRequest('post', 'changed_Username');
$picture = MyHandler::handleServerRequest('post', 'profilePicture') ?? '';
$id = $_SESSION['userId'];

function checkIfNameExists (string $username) : bool
{
    if ($username === $_SESSION['userName']) {
        return False;
    }

    $pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');
    $sql = 'SELECT 
            `username`
            FROM
            `user`
            WHERE 
            `username` = :username';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
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

    $sql = 'UPDATE 
            `user` 
            SET 
                `username` = :changed_username, 
                `profileurl` = :profileurl 
            WHERE 
                `id` = :id
        ';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':changed_username' ,$changed_username);
    $stmt->bindParam(':profileurl', $picture);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $_SESSION['userName'] = $changed_username;
    $_SESSION['profileUrl'] = $picture;
}


if (checkIfNameExists($changed_username)) {
    $status = 'Username ist schon vergeben';
} else {
    changeProfileData($changed_username, $picture, $id);
    $status = 'Daten erfolgreich geändert';
}

$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);

echo $twig->render('profile.twig', ['status' => $status, 'name' => $changed_username, 'profileurl' => $picture]);
