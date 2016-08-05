<?php

use FinanceApp\Controller\AccountController;
use FinanceApp\Repository\AccountRepository;
use FinanceApp\Service\AccountService;

$app['account.controller'] = function ($app) {
return new AccountController($app['account.service'],$app['users.service']);
};

$app['account.service'] = function ($app) {
return new AccountService($app['account.repository']);
};

$app['account.repository'] = function ($app) {
return new AccountRepository($app['db']);
};