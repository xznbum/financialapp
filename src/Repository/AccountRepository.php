<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 2:26
 */

namespace FinanceApp\Repository;


use FinanceApp\Model\Account;

class AccountRepository extends AbstractRepository
{
    public function saveAccount(Account $account)
    {
        $this->dbConnection->executeQuery(
            'INSERT INTO account (id_user, currency_iso, name) VALUES (?, ?, ?)',
            [$account->id_user, $account->currency, $account->name]
        );

        $account->id = $this->dbConnection->lastInsertId();

        return $account;
    }

    public function getAccounts($id_user)
    {
        $accounts = $this->dbConnection->fetchAll(
            'SELECT name, currency_iso, balance FROM account WHERE id_user = ?', [$id_user]
        );

        return $accounts;
    }

    public function getAccountsId($id_user)
    {
        $accounts = $this->dbConnection->fetchArray(
            'SELECT id FROM account WHERE id_user = ?', [$id_user]
        );

        return $accounts;
    }

    public function getAccount($id)
    {
        $account = $this->dbConnection->fetchAssoc(
            'SELECT name, currency_iso, balance FROM account WHERE id = ?', [$id]
        );

        return $account;
    }

    public function deleteAccount($id)
    {
        $query = $this->dbConnection->executeQuery(
            'DELETE FROM account WHERE id = ?', [$id]
        );

        return $query->closeCursor();
    }

}