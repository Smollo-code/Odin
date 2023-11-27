<?php

namespace Monolog;

class Calculator implements CalcInterface
{
    private const MATH_PLUS = '+';
    private const MATH_MINUS = '-';
    private const MATH_MULTI = '*';
    private const MATH_DIVIDE = '/';


    public function __construct(
        private $numberArray,
    ) {
    }

    public function getResult () : float {
        return $this->calculate();
    }

    private function calculate () : float
    {
        $operator = '';
        $result = null;
        foreach ($this->numberArray as $element) {
            if (is_numeric($element)) {
                $value = (float) $element;
                if ($result === null) {
                    $result = $value;
                } else {
                    if ($operator === self::MATH_MULTI) {
                        $result *= $value;
                    } elseif ($operator === self::MATH_DIVIDE) {
                        $result /= $value;
                    } elseif ($operator === self::MATH_PLUS) {
                        $result += $value;
                    } elseif ($operator === self::MATH_MINUS) {
                        $result -= $value;
                    }
                }
            } elseif (in_array($element, ['+', '-', '*', '/'])) {
                $operator = $element;
            }
        }
        return $result;
    }
}
