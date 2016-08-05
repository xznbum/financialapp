<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 23:07
 */

namespace FinanceApp\Controller;


use FinanceApp\Service\CategoriesService;
use FinanceApp\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends AbstractController
{
    protected $categoriesService;

    public function __construct(CategoriesService $categoriesService,UserService $userService)
    {
        parent::__construct($userService);
        $this->categoriesService = $categoriesService;
    }

    public function getCategories(Request $request)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $categories = $this->categoriesService->getCategories();

        return new JsonResponse($categories, Response::HTTP_OK);
    }
}