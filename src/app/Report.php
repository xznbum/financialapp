<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 05.08.16
 * Time: 15:59
 */

use FinanceApp\Controller\ReportController;
use FinanceApp\Repository\ReportRepository;
use FinanceApp\Service\ReportService;

$app['report.controller'] = function ($app) {
    return new ReportController($app['report.service'],$app['users.service']);
};

$app['report.service'] = function ($app) {
    return new ReportService($app['report.repository'], $app['account.repository'], $app['transaction.repository']);
};

$app['report.repository'] = function ($app) {
    return new ReportRepository($app['db']);
};