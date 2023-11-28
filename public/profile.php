<?php
require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);

session_start();
$username = $_SESSION['userName'];
$profileurl = $_SESSION['profileUrl'] ?? '';


echo $twig->render('profile.twig', ['name' => $username, 'profileurl' => $profileurl]);