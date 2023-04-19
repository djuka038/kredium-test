<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController
{
    private ClientService $clientService;
    private ProductService $productService;

    public function __construct(
        ClientService $clientService,
        ProductService $productService
    )
    {
        $this->clientService = $clientService;
        $this->productService = $productService;
    }

    public function createCashLoan(Request $request, int $clientId): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'loan_amount' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editClient', ['clientId' => $clientId])
                        ->withErrors($validator)
                        ->withInput();
        }

        $client = $this->clientService->getClientById($clientId);

        if ($client->cashLoan !== null) {
            return redirect()->route('editClient', ['clientId' => $clientId])
                        ->withErrors([
                            'cash_loan' => 'Cash loan all ready exists'
                        ])
                        ->withInput();
        }

        $this->productService->createCashLoan($clientId, Auth::id(), $request->loan_amount);

        return redirect()->route('editClient', ['clientId' => $clientId]);
    }

    public function updateCashLoan(Request $request, int $cashLoanId): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'loan_amount' => 'required|integer',
        ]);

        $cashLoan = $this->productService->getCashLoanById($cashLoanId);

        if ($validator->fails()) {
            return redirect()->route('editClient', ['clientId' => $cashLoan->client_id])
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($cashLoan->adviser_id !== Auth::id()) {
            return redirect()->route('editClient', ['clientId' => $cashLoan->client_id])
                        ->withErrors([
                            'cash_loan' => 'Can not edit product for client which is not yours.'
                        ])
                        ->withInput();
        }

        $this->productService->updateCashLoan($cashLoanId, $request->loan_amount);

        return redirect()->route('editClient', ['clientId' => $cashLoan->client_id]);
    }

    public function createHomeLoan(Request $request, int $clientId): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'property_value' => 'required|integer',
            'down_payment_amount' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('editClient', ['clientId' => $clientId])
                        ->withErrors($validator)
                        ->withInput();
        }

        $client = $this->clientService->getClientById($clientId);

        if ($client->homeLoan !== null) {
            return redirect()->route('editClient', ['clientId' => $clientId])
                        ->withErrors([
                            'home_loan' => 'Home loan all ready exists'
                        ])
                        ->withInput();
        }

        $this->productService->createHomeLoan(
            $clientId, Auth::id(), $request->property_value, $request->down_payment_amount
        );

        return redirect()->route('editClient', ['clientId' => $clientId]);
    }

    public function updateHomeLoan(Request $request, int $homeLoanId): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'property_value' => 'required|integer',
            'down_payment_amount' => 'required|integer',
        ]);

        $homeLoan = $this->productService->getHomeLoanById($homeLoanId);

        if ($validator->fails()) {
            return redirect()->route('editClient', ['clientId' => $homeLoan->client_id])
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($homeLoan->adviser_id !== Auth::id()) {
            return redirect()->route('editClient', ['clientId' => $homeLoan->client_id])
                        ->withErrors([
                            'home_loan' => 'Can not edit product for client which is not yours.'
                        ])
                        ->withInput();
        }

        $this->productService->updateHomeLoan($homeLoanId, $request->property_value, $request->down_payment_amount);

        return redirect()->route('editClient', ['clientId' => $homeLoan->client_id]);
    }
}