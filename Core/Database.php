<?php

namespace Core;

use Exception;
use PDO;
use PDOStatement;

class Database
{
    protected string $table;
    public PDO $conn;
    public PDOStatement|bool $statement;
    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query(
            $config,
            '',
            ';'
        );

        $this->conn = new PDO(
            $dsn,
            $username,
            $password
        );
    }

    public function query(string $query, array $param = [])
    {
        $this->statement = $this->conn->prepare($query);
        $this->statement->execute($param);

        return $this;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function find(array $clause = [])
    {
        $setClause = '*';

        if (count($clause) > 0) {
            $setClause = implode(', ', $clause);
        }

        $sql = "SELECT {$setClause} from {$this->table}";
        $result = $this->query($sql)->statement->fetchAll();
        if (!$result) {
            throw new Exception("Não foi possível realizar a operação");
        }

        return $result;
    }

    public function findOrFail(int $id, array $clause = [])
    {
        $setClause = '*';

        if (count($clause) > 0) {
            $setClause = implode(', ', $clause);
        }

        $result = $this->query("select {$setClause} from {$this->table} where id = :id", [
            'id' => $id
        ])->statement->fetch();

        if (!$result) {
            return false;
        }

        return $result;
    }
    public function findByEmail(string $email, array $clause = []): bool | array
    {
        $setClause = '*';

        if (count($clause) > 0) {
            $setClause = implode(', ', $clause);
        }

        $result = $this->query("select {$setClause} from {$this->table} where email = :email", [
            'email' => trim($email)
        ])->statement->fetch();

        if (!$result) {
            return false;
        }

        return $result;
    }
}
