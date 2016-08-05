<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 23:39
 */

namespace FinanceApp\Service;


use FinanceApp\Model\Transaction;
use FinanceApp\Repository\CategoriesRepository;
use FinanceApp\Repository\TransactionRepository;

class TransactionService
{
    protected $transactionRepository;
    protected $categoriesRepository;

    public function __construct(TransactionRepository $transactionRepository, CategoriesRepository $categoriesRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->categoriesRepository = $categoriesRepository;
    }

    public function addTransaction($id_account, $id_category, $amount)
    {
        $transaction = new Transaction(null, $id_account, $id_category, $amount, null);
        $transaction = $this->transactionRepository->saveTransaction($transaction);

        return $transaction;
    }

    public function getTransactions($id_account)
    {
        return $this->transactionRepository->getTransactions($id_account);
    }

    public function updateTransaction($id_account, $id_transaction, $category,  $amount, $date)
    {
        $id_category = $this->categoriesRepository->getCategoryByName($category);
        $transaction = new Transaction($id_transaction, $id_account, $id_category, $amount, $date);

        $transaction = $this->transactionRepository->updateTransaction($transaction);

        return $transaction;
    }

    public function deleteTransaction($id_account, $id_transaction)
    {
        return $this->transactionRepository->deleteTransaction($id_account, $id_transaction);
    }
}