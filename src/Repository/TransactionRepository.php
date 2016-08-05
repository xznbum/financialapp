<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 22:06
 */

namespace FinanceApp\Repository;


use FinanceApp\Model\Transaction;

class TransactionRepository extends AbstractRepository
{
    public function saveTransaction(Transaction $transaction)
    {
        $this->dbConnection->executeQuery(
            'INSERT INTO transaction (id_account, id_category, amount) VALUES (?, ?, ?)',
            [$transaction->id_account, $transaction->id_category, $transaction->amount]
        );

        $transaction->id = $this->dbConnection->lastInsertId();

        $balance = $this->dbConnection->fetchArray(
            'SELECT balance FROM account WHERE id = ?', [$transaction->id_account]
        );

        $this->dbConnection->executeQuery(
            'UPDATE account SET balance = balance + ? WHERE id = ?',
            [$transaction->amount, $transaction->id_account]
        );

        $this->dbConnection->executeQuery(
            'INSERT INTO log (id_account, id_category, sum, start_amount, end_amount) VALUES (?, ?, ?, ?, ?)',
            [$transaction->id_account, $transaction->id_category, $transaction->amount,
            $balance[0], $balance[0] + $transaction->amount]
        );

        return $transaction;

    }

    public function getTransactions($id_account)
    {
        $transactions = $this->dbConnection->fetchAll(
            'SELECT * FROM transaction WHERE id_account = ?',[$id_account]
        );

        return $transactions;
    }

    public function updateTransaction(Transaction $transaction)
    {
        $query = $this->dbConnection->executeQuery(
            'UPDATE transaction SET id_category = ?, amount = ?, date = ? WHERE id = ? AND id_account = ?',
            [$transaction->id_category, $transaction->amount, $transaction->date, $transaction->id, $transaction->id_account]
        );

        return $query->closeCursor();
    }

    public function deleteTransaction($id_account, $id_transaction)
    {
        $query = $this->dbConnection->executeQuery(
            'DELETE FROM transaction WHERE id = ? AND id_account = ?', [$id_transaction, $id_account]
        );

        return $query->closeCursor();
    }

    public function getTransactionCategoryByDate($id_account, $date)
    {
        $categories = $this->dbConnection->fetchArray(
            'SELECT id_category FROM transaction WHERE id_account = ? AND DATE_FORMAT(date, "%Y-%m") = ?', [$id_account, $date]
        );

        return $categories;
    }

}