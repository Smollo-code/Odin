<?php
require '../vendor/autoload.php';

session_start();

$changed_username = $_POST['changed_Username'];
$picture = $_POST['profilePicture'];

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
$stmt->bindParam(':picture', $picture);
$stmt->bindParam(':id', $id);
$stmt->execute();

echo 'eakwjekiwejfklwajflewfaj';

header('Location: http://odin.scam/dashboard.php');
exit();
