<?php
/*
$formula = '2+2*2';

$pattern = '/([+\-\/\*])/';

$result = preg_split($pattern, $formula, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

$finishArray = [];

$positon = 0;
foreach ($result as $element) {
    if (in_array('*', $result) | in_array('/', $result)) {
        if ($element === '*' | $element === '/') {
            $finishArray[] = $result[$positon-1];
            $finishArray[] = $element;
            $finishArray[] = $result[$positon+1];
            unset($result[$positon-1], $result[$positon], $result[$positon+1]);

        }
    } else {
        $readyArray = array_merge($finishArray, $result);
    }
    $positon++;
}

function calculate (array $array) : float {
    $operator = '';
    $result = null;

    foreach ($array as $element) {
        if (is_numeric($element)) {
            $value = (float) $element;
            if ($result === null) {
                $result = $value;
            } else {
                if ($operator === '+') {
                    $result += $value;
                } elseif ($operator === '-') {
                    $result -= $value;
                } elseif ($operator === '*') {
                    $result *= $value;
                } elseif ($operator === '/') {
                    $result /= $value;
                }
            }
        } elseif (in_array($element, ['+', '-', '*', '/'])) {
            $operator = $element;
        }
    }
    return $result;
}

$result = calculate($readyArray);
echo $result;
*/

function fixArrayOrderWithRegex($array) {
    // Konvertiere das Array in eine Zeichenkette
    $string = implode('', $array);

    // Wende das Regex-Pattern an
    $pattern = '/(\d+)([-+*\/]?)/';
    preg_match_all($pattern, $string, $matches, PREG_SET_ORDER);

    // Kombiniere die Matches zu einem neuen Array
    $neuesArray = [];
    foreach ($matches as $match) {
        $neuesArray[] = $match[1];
        if (isset($match[2])) {
            $neuesArray[] = $match[2];
        }
    }

    return $neuesArray;
}

// Beispielarray
$array = ['2', '*', '2', '2', '+'];

// Korrigiere die Reihenfolge mit Regex
$korrigiertesArray = fixArrayOrderWithRegex($array);

// Ausgabe des korrigierten Arrays
print_r($korrigiertesArray);
