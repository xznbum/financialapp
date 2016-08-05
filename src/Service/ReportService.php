<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 05.08.16
 * Time: 15:03
 */

namespace FinanceApp\Service;


use FinanceApp\Model\Report;
use FinanceApp\Repository\AccountRepository;
use FinanceApp\Repository\ReportRepository;
use FinanceApp\Repository\TransactionRepository;

class ReportService
{
    protected $reportRepository;
    protected $accountRepository;
    protected $transactionRepository;

    public function __construct(ReportRepository $reportRepository, AccountRepository $accountRepository, TransactionRepository $transactionRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->accountRepository = $accountRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function getReport($month, $id_user)
    {
        $date = $month . ' 2016';
        $date = date('Y-m', strtotime($date));
        $accounts = $this->accountRepository->getAccountsId($id_user);
        //$reports = array();
        $account_categories = array();
        $reports['month'] = $date;
        $reports['id_user'] = $id_user;
        $reports['accounts'] = array();
        for($i = 0; $i < count($accounts); $i++)
        {
            $categories = $this->transactionRepository->getTransactionCategoryByDate($accounts[$i], $date);
            $reports['accounts']['id_account'] = $accounts[$i];
            $reports['accounts']['categories'] = array();
            for($j = 0; $j < count($categories); $j++)
            {
                $report = new Report($date, $id_user, $accounts[$i], $categories[$j], null, null, null, null);
                $report = $this->reportRepository->getReport($report);
                $reports['accounts']['categories']['id_category'] = $report->id_category;
                $reports['accounts']['categories']['sum'] = $report->sum;
                $reports['accounts']['categories']['avg_amount'] = $report->avg_amount;
                $reports['accounts']['categories']['start_amount'] = $report->start_amount;
                $reports['accounts']['categories']['end_amount'] = $report->end_amount;
            }
            unset($account_categories);
            $account_categories = array();
        }

        return $reports;
    }
}