<?php declare(strict_types=1);
namespace Monolog\User\Model\User;

use Monolog\App\ApplicationFactory;
use Monolog\User\UserFactory;
use PDO;

class UserRepository implements UserRepositoryInterface
{

    private PDO $Pdo;
    public function __construct()
    {
        $applicationFactory = new ApplicationFactory();
        $this->Pdo = $applicationFactory->createPdo();
    }

    public function getFields(array $data): string {
        $fields = [];
        foreach ($data as $field => $value) {
            if ($value === '') {
                $fields[] = $field . "=''";
            } else {
                $fields[] = $field . '=' . "'$value'";
            }
        }
        return implode(', ', $fields);
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

    public function delete(string $table, array $data): bool
    {
        $conditionvar = $this->getFields($data);

        $sql = "DELETE 
                FROM
                $table
                WHERE
                $conditionvar";
        $stmt = $this->Pdo->prepare($sql);
        if ($stmt->execute()) {
            return True;
        } else {
            return False;
        }
    }

    public function update(string $table, array $dataupdate, array $datacondition): bool
    {
        $fields = $this->getFields($dataupdate);
        $condition = $this->getFields($datacondition);

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

    public function select(string $table, array $datafields, array $conditionarray): string|bool
    {
        $condition = $this->getFields($conditionarray);
        $fields = implode(', ', $datafields);
        $sql = "SELECT 
                $fields
                FROM
                `$table`
                WHERE 
                $condition";
        $stmt = $this->Pdo->prepare($sql);

        if ($stmt->execute()) {
            return implode('', $stmt->fetch($this->Pdo::FETCH_ASSOC));
        } else {
            return False;
        }
    }
}
