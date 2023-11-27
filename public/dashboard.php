<?php
require '../vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => False,
]);

echo $twig->render('dashboard.twig');
