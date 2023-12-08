<?php

namespace Monolog\User\Model\User;

interface UserRepositoryInterface
{
    public function insert(string $table, array $data): bool;

    public function delete(string $table, array $condition): bool;

    public function update(string $table, array $datafields, array $datavalue): bool;

    public function select(string $table, array $datafields, array $condition): string|bool;
}