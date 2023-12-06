<?php declare(strict_types=1);
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
        $condition = [];
        foreach ($dataupdate as $field => $value) {
            if ($value === '') {
                $data[] = $field . "=''";
            } else {
                $data[] = $field . '=' . "'$value'";
            }
        }
        $fields = implode(', ', $data);


        foreach ($datacondition as $field => $value) {
            if ($value === '') {
                $condition[] = $field . "=''";
            } else {
                $condition[] = $field . '=' . "'$value'";
            }
        }
        $condition = implode(', ', $condition);

        $sql = "UPDATE 
                $table 
                SET 
                    $fields  
                WHERE 
                    $condition";
        $stmt = $this->Pdo->prepare($sql);
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
