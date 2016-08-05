<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 04.08.16
 * Time: 21:52
 */

namespace FinanceApp\Model;


class Transaction
{
    public $id;

    public $id_account;

    public $id_category;

    public $amount;

    public $date;

    public function __construct($id, $id_account, $id_category, $amount, $date)
    {
        $this->id = $id;
        $this->id_account = $id_account;
        $this->id_category = $id_category;
        $this->amount = $amount;
        $this->date = $date;
    }
}