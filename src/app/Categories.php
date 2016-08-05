<?php

use FinanceApp\Controller\CategoriesController;
use FinanceApp\Repository\CategoriesRepository;
use FinanceApp\Service\CategoriesService;

$app['categories.controller'] = function ($app) {
    return new CategoriesController($app['categories.service'],$app['users.service']);
};

$app['categories.service'] = function ($app) {
    return new CategoriesService($app['categories.repository']);
};

$app['categories.repository'] = function ($app) {
    return new CategoriesRepository($app['db']);
};