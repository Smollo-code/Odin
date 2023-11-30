<?php
require '../vendor/autoload.php';

$changed_username = $_POST['changed_username'];
$picture = $_POST['profilePicture'];



session_start();
$username = $_SESSION['userName'];
$profileUrl = $_SESSION['profileUrl'] ?? '';
$id = $_SESSION['userId'];

$pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'UPDATE
        user
        SET
        username = :changed_username,
        profileurl = :picture
        WHERE 
        id = :id
        ';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':changed_username' ,$changed_username);
$stmt->bindParam(':profileurl', $picture);
$stmt->execute();


$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);

echo $twig->render('profile.twig');
