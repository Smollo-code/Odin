<?php
require '../vendor/autoload.php';


$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);
session_start();
$username = $_SESSION['userName'];
$profileUrl = $_SESSION['profileUrl'] ?? '';

echo $twig->render('dashboard.twig', ['name' => $username, '0picture' => $profileUrl]);
