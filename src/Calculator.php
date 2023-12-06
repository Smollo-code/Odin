<?php declare(strict_types=1);

namespace Monolog;

class Calculator implements CalcInterface
{
    private const MATH_PLUS = '+';
    private const MATH_MINUS = '-';
    private const MATH_MULTI = '*';
    private const MATH_DIVIDE = '/';

    public function __construct(
    ) {
    }

    public function getResult(string $formula): float
    {
        $sortedArray = $this->sortMathOperations($formula);
        $placementArray = $this->sortPlacement($sortedArray);
        return $this->performCalculation($placementArray);
    }

    /**
     * @return array<int|string>
     */
    private function sortMathOperations(string $formula): array
    {
        $pattern = '/([+\-\/\*])/';
        $result = preg_split($pattern, $formula, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $finishArray = [];
        $position = 0;

        if ($result === false) {
            return [];
        }

        foreach ($result as $element) {
            if (in_array('*', $result, true) || in_array('/', $result, true)) {
                if ($element === '*' || $element === '/') {
                    $finishArray[] = $result[$position - 1];
                    $finishArray[] = $element;
                    $finishArray[] = $result[$position + 1];
                    unset($result[$position - 1], $result[$position], $result[$position + 1]);
                }
            } else {
                return array_merge($finishArray, $result);
            }
            $position++;
        }

        return array_merge($finishArray, $result);
    }

    /**
     * @param array<int|string> $array
     * @return array<int|string>
     */
    /**
     * @param array<int|string> $array
     * @return array<int|string>
     */
    private function sortPlacement(array $array): array
    {
        $operands = [];
        $operators = [];

        foreach ($array as $item) {
            if (is_numeric($item)) {
                $operands[] = $item;
            } else {
                $operators[] = $item;
            }
        }

        if (empty($operators)) {
            return $operands;  // Keine Operatoren, Rückgabe der Operanden
        }

        usort($operators, function ($a, $b) {
            $priority = ['*' => 1, '/' => 1, '+' => 2, '-' => 2];
            return $priority[$a] <=> $priority[$b];
        });

        $sortedArray = [];
        foreach ($operators as $operator) {
            $sortedArray[] = (string) array_shift($operands); // sicherstellen, dass die Operanden als Strings zurückgegeben werden
            $sortedArray[] = $operator;
        }

        while (!empty($operands)) {
            $sortedArray[] = (string) array_shift($operands); // sicherstellen, dass die Operanden als Strings zurückgegeben werden
        }

        return $sortedArray;
    }


    /**
     * @param array<int|string> $array
     * @return float
     */
    private function performCalculation(array $array): float
    {
        $operator = '';
        $result = null;

        foreach ($array as $element) {
            if (is_numeric($element)) {
                $value = (float) $element;
                if ($result === null) {
                    $result = $value;
                } else {
                    switch ($operator) {
                        case self::MATH_PLUS:
                            $result += $value;
                            break;
                        case self::MATH_MINUS:
                            $result -= $value;
                            break;
                        case self::MATH_MULTI:
                            $result *= $value;
                            break;
                        case self::MATH_DIVIDE:
                            // Handle division by zero
                            if ($value !== 0) {
                                $result /= $value;
                            }


                            break;
                    }
                }
            } elseif (in_array($element, ['+', '-', '*', '/'], true)) {
                $operator = $element;
            }
        }

        return (float) $result;
    }
}
