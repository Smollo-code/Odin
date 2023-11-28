<?php

namespace Monolog;

class Calculator implements CalcInterface
{
    private const MATH_PLUS = '+';
    private const MATH_MINUS = '-';
    private const MATH_MULTI = '*';
    private const MATH_DIVIDE = '/';


    public function __construct(
        public string $formula,
    )
    {
    }

    public function getResult(): float
    {
        $sortedArray = $this->mathSorter();
        $placementArray = $this->placementSorter($sortedArray);
        return $this->calculate($placementArray);
    }

    private function mathSorter(): array
    {
        $pattern = '/([+\-\/\*])/';
        $result = preg_split($pattern, $this->formula, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $finishArray = [];
        $positon = 0;
        foreach ($result as $element) {
            if (in_array('*', $result) | in_array('/', $result)) {
                if ($element === '*' | $element === '/') {
                    $finishArray[] = $result[$positon - 1];
                    $finishArray[] = $element;
                    $finishArray[] = $result[$positon + 1];
                    unset($result[$positon - 1], $result[$positon], $result[$positon + 1]);

                }
            } else {
                return array_merge($finishArray, $result);
            }
            $positon++;
        }
        return array($result);
    }

    /**
     * @param array<int|string> $array
     * @return array<int|string>
     */
    private function placementSorter(array $array): array {
        $operands = [];
        $operators = [];

        foreach ($array as $item) {
            if (is_numeric($item)) {
                $operands[] = $item;
            } else {
                $operators[] = $item;
            }
        }

        usort($operators, function ($a, $b) {
            $priority = ['*' => 1, '/' => 1, '+' => 2, '-' => 2];
            return $priority[$a] <=> $priority[$b];
        });

        $sortedArray = [];
        foreach ($operators as $operator) {
            $sortedArray[] = array_shift($operands);
            $sortedArray[] = $operator;
        }
        $sortedArray = array_merge($sortedArray, $operands);

        return $sortedArray;
    }



    private function calculate (array $array) : float {
        $operator = '';
        $result = null;

        foreach ($array as $element) {
            if (is_numeric($element)) {
                $value = (float) $element;
                if ($result === null) {
                    $result = $value;
                } else {
                    if ($operator === self::MATH_PLUS) {
                        $result += $value;
                    } elseif ($operator === self::MATH_MINUS) {
                        $result -= $value;
                    } elseif ($operator === self::MATH_MULTI) {
                        $result *= $value;
                    } elseif ($operator === self::MATH_DIVIDE) {
                        $result /= $value;
                    }
                }
            } elseif (in_array($element, ['+', '-', '*', '/'])) {
                $operator = $element;
            }
        }
        return $result;
    }
}
