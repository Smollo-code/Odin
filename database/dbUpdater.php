<?php

class dbUpdater implements dbUpdaterInterface
{

    private const PDO = new PdoConnection();
    public function __construct()
    {
        $pdo = new PdoConnection();
    }

    public function insert(array $data): bool {
        $sql = 'INSERT
                INTO 
                `:table`
                    (:fields)
                VALUES 
                    (:values)';
        $fields = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

    }

    public function delete(): bool
    {
        // TODO: Implement delete() method.
    }

    public function update(): bool
    {
        // TODO: Implement update() method.
    }

    public function select(): string|bool
    {
        // TODO: Implement select() method.
    }
}