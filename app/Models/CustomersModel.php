<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $pdo;

    private const TABLE_NAME = 'customers';

    public function __construct()
    {
        $dbConfig = config('Database');

        $dsn = sprintf(DB_DSN,
            $dbConfig->default['hostname'],
            $dbConfig->default['database'],
            $dbConfig->default['port'],
            $dbConfig->default['charset']
        );

        $this->pdo = $this->createConnection($dsn, $dbConfig->default['username'], $dbConfig->default['password']);
    }

    private function createConnection($dsn, $username, $password)
    {
        $pdo = new \PDO($dsn, $username, $password);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public function getAllCustomers(int $page = 1, int $limit = 10): array
    {
        $offset = ($page - 1) * $limit;

        $sql = "
            SELECT
                id,
                name,
                email,
                status,
                admission_date,
                created_at,
                updated_at
            FROM
                " . self::TABLE_NAME . "
            ORDER BY
                name ASC
            LIMIT :limit OFFSET :offset
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_OBJ);

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return [];
        }
    }

    public function countAllCustomers(): int
    {
        $sql = "
            SELECT
                COUNT(*)
            FROM "
                . self::TABLE_NAME;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return (int) $stmt->fetchColumn();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 0;
        }
    }

    public function postNewCustomer($customerInfo)
    {
        $sql = "
            INSERT INTO " . self::TABLE_NAME . "
                (name, email, admission_date, status, created_at, updated_at)
                VALUES (:name, :email, :admission_date, :status, NOW(), NOW())
            ";

        try {
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':name', $customerInfo['name'], \PDO::PARAM_STR);
            $stmt->bindParam(':email', $customerInfo['email'], \PDO::PARAM_STR);
            $stmt->bindParam(':admission_date', $customerInfo['admission_date'], \PDO::PARAM_STR);
            $stmt->bindParam(':status', $customerInfo['status'], \PDO::PARAM_STR);

            $stmt->execute();

            return $this->pdo->lastInsertId();
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }
}
