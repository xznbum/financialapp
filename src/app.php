<?php

require __DIR__ . '/../src/app/Account.php';
require __DIR__ . '/../src/app/Users.php';
require __DIR__ . '/../src/app/Categories.php';
require __DIR__ . '/../src/app/Transaction.php';
require __DIR__ . '/../src/app/Report.php';

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\Request;

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_mysql',
        'host' => '127.0.0.1',
        'dbname' => 'finance',
        'user' => 'root',
        'password' => 'root',
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

// routes

$users = $app['controllers_factory'];

$users->post('/users', 'users.controller:register');
$users->get('/users/me', 'users.controller:getUser');
$users->put('/users/me', 'users.controller:updateUser');

$users->get('/users/me/accounts', 'account.controller:getAccounts');
$users->post('/users/me/accounts', 'account.controller:addAccount');
$users->get('/users/me/accounts/{id}', 'account.controller:getAccount');
$users->delete('/users/me/accounts/{id}', 'account.controller:deleteAccount');

$users->post('/users/me/accounts/{id}/transactions', 'transaction.controller:addTransaction');
$users->get('/users/me/accounts/{id}/transactions', 'transaction.controller:getTransactions');
$users->put('/users/me/accounts/{id_account}/transactions/{id_transaction}', 'transaction.controller:updateTransaction');
$users->delete('/users/me/accounts/{id_account}/transactions/{id_transaction}', 'transaction.controller:deleteTransaction');

$users->get('/categories', 'categories.controller:getCategories');

$users->get('/users/me/reports', 'report.controller:getReport');

$app->mount('/api', $users);