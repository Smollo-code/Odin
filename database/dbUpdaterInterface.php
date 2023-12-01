<?php

interface dbUpdaterInterface
{
    public function insert(array $data) : bool;

    public function delete(): bool;

    public function update(): bool;

    public function select(): string | bool;
}