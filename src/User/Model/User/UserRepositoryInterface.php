<?php
namespace Monolog\User\Model\User;

interface UserRepositoryInterface
{
    public function insert(string $table, array $data): bool;

    public function delete(): bool;

    public function update(): bool;

    public function select(): string | bool;
}