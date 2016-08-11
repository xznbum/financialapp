<?php
/**
 * Created by PhpStorm.
 * User: xznrs
 * Date: 05.08.16
 * Time: 15:03
 */

namespace FinanceApp\Repository;


use FinanceApp\Model\Report;

class ReportRepository extends AbstractRepository
{
    public function getReport(Report $report)
    {
        $date = $report->date . ' 2016';
        $date = date('Y-m', strtotime($date));
        $query = $this->dbConnection->fetchArray(
            'SELECT sum, avg_amount, start_amount, end_amount FROM report WHERE id_account = ? AND id_category = ? AND date = ? AND id_user = ? LIMIT 1',
            [$report->id_account, $report->id_category, $date, $report->id_user]
        );
        if($query[0] !== null)
        {
            $report->sum = $query[0];
            $report->avg_amount = $query[1];
            $report->start_amount = $query[2];
            $report->end_amount = $query[3];
        } else
        {
            $query = $this->dbConnection->fetchArray(
                'SELECT SUM(sum), COUNT(*) FROM log WHERE id_account = ? AND id_category = ? AND DATE_FORMAT(date, "%Y-%m") = ?',
                [$report->id_account, $report->id_category, $date]
            );

            if ($query[1] != 0)
            {
                $report->sum = $query[0];
                $report->avg_amount = $query[0]/$query[1];
            }

            $query = $this->dbConnection->fetchArray(
                'SELECT start_amount FROM log WHERE id_account = ? AND id_category = ? AND DATE_FORMAT(date, "%Y-%m") = ? ORDER BY date LIMIT 1',
                [$report->id_account, $report->id_category, $date]
            );

            $report->start_amount = $query[0];

            $query = $this->dbConnection->fetchArray(
                'SELECT end_amount FROM log WHERE id_account = ? AND id_category = ? AND DATE_FORMAT(date, "%Y-%m") = ? ORDER BY date DESC LIMIT 1',
                [$report->id_account, $report->id_category, $date]
            );
            $report->end_amount = $query[0];

            $this->dbConnection->executeQuery(
                'INSERT INTO report (date, id_user, id_account, id_category, sum, avg_amount, start_amount, end_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
                [$date, $report->id_user, $report->id_account, $report->id_category, $report->sum, $report->avg_amount, $report->start_amount, $report->end_amount]
            );


        }

        return $report;
    }
}