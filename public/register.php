<?php
require '../vendor/autoload.php';




$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);

$username = $_POST['new_username'];
$password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
$confirmPassword = $_POST['confirm_password'];

function checkPassword () : bool {
    $password = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    if ($password === $confirmPassword) {
        return True;
    } else {
        return False;
    }
}

$pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');

$sql = '
        INSERT INTO 
            user (username, password) 
        VALUES 
            (:username, :password)';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username' ,$username);
$stmt->bindParam(':password', $password);
$stmt->execute();

$userid = $pdo->lastInsertId();

echo $twig->render('register.twig');