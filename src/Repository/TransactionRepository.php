<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 22:06
 */

namespace FinanceApp\Repository;


use FinanceApp\Model\Transaction;

class TransactionRepositoty extends AbstractRepository
{
    public function saveTransaction(Transaction $transaction)
    {
        $this->dbConnection->executeQuery(
            'INSERT INTO transaction (id_account, id_category, amount) VALUES (?, ?, ?)',
            [$transaction->id_account, $transaction->id_category, $transaction->amount]
        );

        $transaction->id = $this->dbConnection->lastInsertId();

        return $transaction;

    }

}