<?php

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



function sortMathArray($array) {
    $operands = [];
    $operators = [];



    // Trennen Sie Operanden und Operatoren
    foreach ($array as $item) {
        if (is_numeric($item)) {
            $operands[] = $item;
        } else {
            $operators[] = $item;
        }
    }

    // Sortieren Sie die Operatoren nach Priorität
    usort($operators, function($a, $b) {
        $priority = ['*' => 1, '/' => 1, '+' => 2, '-' => 2];
        return $priority[$a] <=> $priority[$b];
    });

    // Rekonstruieren Sie das Array
    $sortedArray = [];
    foreach ($operators as $operator) {
        $sortedArray[] = array_shift($operands);
        $sortedArray[] = $operator;
    }
    // Fügen Sie verbleibende Operanden hinzu
    $sortedArray = array_merge($sortedArray, $operands);

    return $sortedArray;
}


$sortedArray = sortMathArray($readyArray);
$result = calculate($sortedArray);
var_dump($result);
