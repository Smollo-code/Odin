<?php
$username = $_POST['username'];
$password = $_POST['password'];

$pdo = new PDO('mysql:host=mysql_db;dbname=odin', 'root', 'root');

$sql = 'SELECT
        username, password, id
        FROM `user` ';

$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->execute();

foreach ($users as $dbuser) {
    if ($dbuser['username'] === $username) {
        if (password_verify($password, $dbuser['password'])) {
            header("location: dashboard.php");
            session_start();
            $_SESSION['userId'] = $dbuser['id'];
            break;
        } else {
            $error = 'Wrong Password';
            require 'index.php';
            break;
        }
    } elseif (!next($users)) {
        $error = 'Wrong Username';
        require 'index.php';
        break;
    }
}

