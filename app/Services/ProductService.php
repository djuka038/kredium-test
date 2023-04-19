<?php

namespace App\Services;

use App\Models\CashLoan;
use App\Models\HomeLoan;

class ProductService
{
    private CashLoan $cashLoan;
    private HomeLoan $homeLoan;

    public function __construct(CashLoan $cashLoan, HomeLoan $homeLoan)
    {
        $this->cashLoan = $cashLoan;
        $this->homeLoan = $homeLoan;
    }

    /**
     * Creates cash loan
     *
     * @param integer $clientId
     * @param integer $adviserId
     * @param integer $loanAmount
     * @return CashLoan
     */
    public function createCashLoan(
        int $clientId,
        int $adviserId,
        int $loanAmount
    ): CashLoan
    {
        return $this->cashLoan->create([
            'client_id' => $clientId,
            'adviser_id' => $adviserId,
            'loan_amount' => $loanAmount
        ]);
    }

    /**
     * Create home loan
     *
     * @param integer $clientId
     * @param integer $adviserId
     * @param integer $propertyValue
     * @param integer $downPaymentAmount
     * @return HomeLoan
     */
    public function createHomeLoan(
        int $clientId,
        int $adviserId,
        int $propertyValue,
        int $downPaymentAmount
    ): HomeLoan
    {
        return $this->homeLoan->create([
            'client_id' => $clientId,
            'adviser_id' => $adviserId,
            'property_value' => $propertyValue,
            'down_payment_amount' => $downPaymentAmount
        ]);
    }

    /**
     * Gets cash loan by id
     *
     * @param integer $id
     * @return CashLoan|null
     */
    public function getCashLoanById(int $id): CashLoan|null
    {
        return $this->cashLoan->find($id);
    }

    /**
     * Gets home loan by id
     *
     * @param integer $id
     * @return CashLoan|null
     */
    public function getHomeLoanById(int $id): HomeLoan|null
    {
        return $this->homeLoan->find($id);
    }

    /**
     * Updates cash loan
     *
     * @param integer $id
     * @param integer $loanAmount
     * @return CashLoan
     */
    public function updateCashLoan(int $id, int $loanAmount): CashLoan
    {
        $cashLoan = $this->getCashLoanById($id);
        $cashLoan->update([
            'loan_amount' => $loanAmount
        ]);
        return $cashLoan->refresh();
    }

    /**
     * Updates home loan
     *
     * @param integer $id
     * @param integer $propertyValue
     * @param integer $downPaymentAmount
     * @return HomeLoan
     */
    public function updateHomeLoan(int $id, int $propertyValue, int $downPaymentAmount): HomeLoan
    {
        $homeLoan = $this->getHomeLoanById($id);
        $homeLoan->update([
            'property_value' => $propertyValue,
            'down_payment_amount' => $downPaymentAmount
        ]);
        return $homeLoan->refresh();
    }
}