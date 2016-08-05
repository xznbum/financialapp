<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 05.08.16
 * Time: 15:02
 */

namespace FinanceApp\Controller;


use FinanceApp\Service\ReportService;
use FinanceApp\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends AbstractController
{
    protected $reportService;

    public function __construct(ReportService $reportService, UserService $userService)
    {
        parent::__construct($userService);
        $this->reportService = $reportService;
    }

    public function getReport(Request $request)
    {
        $user = $this->getUserByAuthorization($request);
        if ($user === false) {
            return $this->createUnathorizedResponse();
        }

        $report = $this->reportService->getReport($_GET["month"],$user->id);

        return new JsonResponse($report, Response::HTTP_CREATED);
    }
}