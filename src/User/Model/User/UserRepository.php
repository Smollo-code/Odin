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
        $sql = "INSERT 
                INTO 
                `$table` 
                (" . implode(', ', array_keys($data)) . ") 
                VALUES 
                (:" . implode(', :', array_keys($data)) . ")";
        $stmt = $this->Pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindParam(':'.$key, $data[$key]);
        }
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

    public function update(string $table, array $dataupdate, array $datacondition): bool
    {
        $data = [];
        foreach ($dataupdate as $field => $value) {
            if ($value === '') {
                $data[] = $field . "=''";
            } else {
                $data[] = $field . '=' . $value;
            }
        }
        $values = implode(', ', $data);
        var_dump($values);
        exit();

        $sql = "UPDATE 
                $table 
                SET 
                    (" . implode(', ', array_keys($dataupdate)). '=' . implode(', ', array_values($dataupdate)) . ")  
                WHERE 
                    (" . implode(', ', array_keys($datacondition)) . '=' . implode(', ', array_values($datacondition)) . ")";
        $stmt = $this->Pdo->prepare($sql);
        /*foreach ($datacondition as $key => $value) {
            $stmt->bindParam(':'.$key, $data[$key]);
        }*/
        if ($stmt->execute()) {
            return True;
        } else {
            return False;
        }

    }

    public function select(string $table, array $data): string|bool
    {
        $sql = "SELECT 
                `username`
                FROM
                $table
                WHERE 
                `username` = :username";
    }
}