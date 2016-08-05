<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 2:40
 */

namespace FinanceApp\Service;


use FinanceApp\Model\Account;
use FinanceApp\Repository\AccountRepository;

class AccountService
{
    protected $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function createAccount($id_user, $currency, $balance, $name)
    {
        $account = new Account(null, $id_user, $currency, null, $name);

        $account = $this->accountRepository->saveAccount($account);

        return $account;
    }

    public function getAccounts($id_user)
    {
        return $this->accountRepository->getAccounts($id_user);
    }

    public function getAccount($id)
    {
        return $this->accountRepository->getAccount($id);
    }

    public function deleteAccount($id)
    {
        return $this->accountRepository->deleteAccount($id);
    }
}