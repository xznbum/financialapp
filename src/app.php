<?php

use FinanceApp\Controller\UserController;
use FinanceApp\Repository\UserRepository;
use FinanceApp\Service\UserService;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\Request;

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_mysql',
        'host' => '127.0.0.1',
        'dbname' => 'finance',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8'
    ]
]);
$app->register(new ServiceControllerServiceProvider());

$app->before(function(Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

// services

$app['users.controller'] = function ($app) {
    return new UserController($app['users.service']);
};

$app['users.service'] = function ($app) {
    return new UserService($app['users.repository']);
};

$app['users.repository'] = function ($app) {
    return new UserRepository($app['db']);
};

// routes

$users = $app['controllers_factory'];

$users->post('/users', 'users.controller:register');
$users->get('/users/me', 'users.controller:getUser');
$users->put('/users/me', 'users.controller:updateUser');

$app->mount('/api', $users);