<?php
declare(strict_types=1);

namespace Monolog;


interface CalcInterface
{
    public function getResult(string $formula): float;
}