<?php
require '../vendor/autoload.php';
require './MyHandler.php';

$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);
session_start();
$client = new GuzzleHttp\Client();
$username = $_SESSION['userName'];
$profileUrl = $_SESSION['profileurl'] ?? '';

echo $twig->render('dashboard.twig', ['name' => $username, 'picture' => $profileUrl]);
