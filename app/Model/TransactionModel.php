<?php

namespace app\Model;

class TransactionModel {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTransaction($referenceID, $merchantID)
    {
        $query = "
            SELECT
                id, status
            FROM
                transactions
            WHERE id = ? and merchant_id = ?;
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array($referenceID, $merchantID));
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getTransactionByID($referenceID)
    {
        $query = "
            SELECT
                id, status
            FROM
                transactions
            WHERE id = ?;
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array($referenceID));
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getMerchant($merchantID)
    {
        $query = "
            SELECT
                id, name
            FROM
                merchants
            WHERE id = ?;
        ";

        try {
            $statement = $this->db->prepare($query);
            $statement->execute(array($merchantID));
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function createTransaction($param) {
        $query = "
        INSERT INTO transactions (invoice_id, item_name, amount, payment_type, customer_name, number_va, merchant_id, status) 
        VALUES (?,?,?,?,?,?,?,?)
        ";

        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $param['invoice_id']);
        $statement->bindParam(2, $param['item_name']);
        $statement->bindParam(3, $param['amount']);
        $statement->bindParam(4, $param['payment_type']);
        $statement->bindParam(5, $param['customer_name']);
        $statement->bindParam(6, $param['number_va']);
        $statement->bindParam(7, $param['merchant_id']);
        $statement->bindParam(8, $param['status']);

        try {
            $statement->execute();
            $result = $this->db->lastInsertId();
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function updateTransaction($referencesID, $status)
    {
        $query = "
        UPDATE transactions
        SET
            status = ?
        WHERE
            id = ?
        ";

        $statement = $this->db->prepare($query);
        $statement->bindParam(1, $status);
        $statement->bindParam(2, $referencesID);

        try {
            $statement->execute();
            return true;
        } catch (\PDOException $e) {
            exit($e->getMessage());
            return false;
        }
    }
}