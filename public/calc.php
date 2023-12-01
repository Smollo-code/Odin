<?php

namespace Monolog;

require '../vendor/autoload.php';


error_reporting(5);

function hasOneOperator (string $input) : bool {
    $operatorArray = ['+', '-', '*', '/',];
    foreach ($operatorArray as $operator) {
        if (str_contains($input, $operator)) {
            return true;
        }
    }
    return false;
}

function hasBracket (string $input) : bool
{
    $brackets = ['(', ')', '[', ']', '{', '}'];
    foreach ($brackets as $bracket) {
        if (str_contains($input, $bracket)) {
            return true;
        }
    }
    return false;
}

$result = $_REQUEST['input'] ?? '';

if (!hasOneOperator($result)) {
    $error = 'Fehler bei Eingabe';

} elseif (hasBracket($result)) {
    $error = 'Fehler bei Eingabe';

} else {
    $calc = new Calculator($result);
    $result = $calc->getResult();
}


$loader = new \Twig\Loader\FilesystemLoader('../src/User/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);


echo $twig->render('main.twig', ['result' => $result, 'error' => $error ?? '']);




