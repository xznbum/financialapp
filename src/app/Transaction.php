<?php

use FinanceApp\Controller\TransactionController;
use FinanceApp\Repository\TransactionRepository;
use FinanceApp\Service\TransactionService;

$app['transaction.controller'] = function ($app) {
    return new TransactionController($app['transaction.service'],$app['users.service']);
};

$app['transaction.service'] = function ($app) {
    return new TransactionService($app['transaction.repository'], $app['categories.repository']);
};

$app['transaction.repository'] = function ($app) {
    return new TransactionRepository($app['db']);
};