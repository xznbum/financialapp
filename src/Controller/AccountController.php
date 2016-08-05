<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 2:15
 */

namespace FinanceApp\Controller;


use FinanceApp\Service\AccountService;
use FinanceApp\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends AbstractController
{
    protected $accountService;

    public function __construct(AccountService $accountService, UserService $userService)
    {
        parent::__construct($userService);
        $this->accountService = $accountService;
    }

    public function getAccounts(Request $request)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $accounts = $this->accountService->getAccounts($user->id);

        return new JsonResponse($accounts, Response::HTTP_OK);

    }

    public function addAccount(Request $request)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $account = $this->accountService->createAccount($user->id, $request->get('currency'), null, $request->get('name'));

        return new JsonResponse(
            [
                'name' => $account->name,
                'currency' => $account->currency
            ],
            Response::HTTP_CREATED
        );
    }

    public function getAccount(Request $request, $id)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $account = $this->accountService->getAccount($id);

        return new JsonResponse($account, Response::HTTP_OK);

    }

    public function deleteAccount(Request $request, $id)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $query = $this->accountService->deleteAccount($id);

        return new JsonResponse(
            [
                'status' => $query
            ],
            Response::HTTP_OK);
    }


}