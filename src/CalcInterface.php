<?php

namespace Monolog;


interface CalcInterface
{
    public function getResult(string $formula): float;
}