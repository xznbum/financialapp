<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 05.08.16
 * Time: 15:23
 */

namespace FinanceApp\Model;


class Report
{
    public $date;

    public $id_user;

    public $id_account;

    public $id_category;

    public $sum;

    public $avg_amount;

    public $start_amount;

    public $end_amount;

    public function __construct($date, $id_user, $id_account, $id_category, $sum, $avg_amount, $start_amount, $end_amount)
    {
        $this->date = $date;
        $this->id_user = $id_user;
        $this->id_account = $id_account;
        $this->id_category = $id_category;
        $this->sum = $sum;
        $this->avg_amount = $avg_amount;
        $this->start_amount = $start_amount;
        $this->end_amount = $end_amount;
    }

}