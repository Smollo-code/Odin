<?php
namespace Monolog\User\Model\User;

use Monolog\App\ApplicationFactory;
use Monolog\User\UserFactory;

class UserRepository implements UserRepositoryInterface
{

    private $Pdo;
    public function __construct()
    {
        $applicationFactory = new \Monolog\App\ApplicationFactory();
        $this->Pdo = $applicationFactory->createPdo();
    }

    public function insert(string $table, array $data): bool {
        $sql = 'INSERT
                INTO 
                `:table`
                    (`:fields`)
                VALUES 
                    (`:values`)';
        $fields = implode(', ', array_keys($data));
        $values = implode(', ', array_values($data));
        $stmt = $this->Pdo->prepare($sql);

        $stmt->bindParam(':table', $table);
        $stmt->bindParam(':fields', $fields);
        $stmt->bindParam(':values', $values);

        if ($stmt->execute()) {
            return True;
        } else {
            return False;
        }


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