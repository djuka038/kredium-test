<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ReportService
{

    /**
     * Gets report by adviser id
     *
     * @param integer $adviserId
     * @return void
     */
    public function getReportByAdviserId(int $adviserId): array
    {
        return DB::select("WITH cash_loans AS (
                SELECT
                    true AS type,
                    clp.loan_amount AS amount,
                    clp.created_at
                FROM cash_loan_products clp
                WHERE clp.adviser_id = :adviserId1
            ), home_loans AS (
                SELECT
                    false AS type,
                    CONCAT(hlp.property_value, '-', hlp.down_payment_amount) AS amount,
                    hlp.created_at
                FROM home_loan_products hlp
                WHERE hlp.adviser_id = :adviserId2
            ), union_all AS (
                SELECT * FROM cash_loans
                UNION ALL
                SELECT * FROM home_loans
            )
            SELECT
                (CASE WHEN a.type = 1 THEN 'Cash loan' ELSE 'Home loan' END) AS product_type,
                a.amount AS product_value,
                a.created_at AS creation_date
            FROM union_all a
            ORDER BY a.created_at DESC", [
                'adviserId1' => $adviserId,
                'adviserId2' => $adviserId
        ]);
    }
}