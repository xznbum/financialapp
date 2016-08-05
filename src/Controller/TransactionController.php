<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 21:57
 */

namespace FinanceApp\Controller;


use FinanceApp\Service\UserService;
use FinanceApp\Service\TransactionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends AbstractController
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService, UserService $userService)
    {
        parent::__construct($userService);
        $this->transactionService = $transactionService;
    }

    public function addTransaction(Request $request, $id)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }
        //$transaction = new Transaction(null, $id, $_GET["category_id"], $request->get('amount'), null);

        $transaction = $this->transactionService->addTransaction($id, $_GET["category_id"], $request->get('sum'));

        return new JsonResponse($transaction, Response::HTTP_OK);

    }

    public function getTransactions(Request $request, $id)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $transactions = $this->transactionService->getTransactions($id);
        return new JsonResponse($transactions, Response::HTTP_OK);
    }

    public function updateTransaction(Request $request, $id_account, $id_transaction)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $query = $this->transactionService->updateTransaction($id_account, $id_transaction, $request->get('category'), $request->get('sum'), $request->get('date'));
        return new JsonResponse(
            [
                'queryStatus' => $query
            ], Response::HTTP_OK);
    }

    public function deleteTransaction(Request $request, $id_account, $id_transaction)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $query = $this->transactionService->deleteTransaction($id_account, $id_transaction);
        return new JsonResponse(
            [
                'queryStatus' => $query
            ], Response::HTTP_OK);
    }
}