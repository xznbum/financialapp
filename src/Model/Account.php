<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 03.08.16
 * Time: 15:59
 */

namespace FinanceApp\Model;


class Account
{
    public $id;

    public $id_user;

    public $currency;

    public $balance;

    public $name;

    public function __construct($id, $id_user, $currency, $balance, $name)
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->currency = $currency;
        $this->balance = $balance;
        $this->name = $name;
    }
}