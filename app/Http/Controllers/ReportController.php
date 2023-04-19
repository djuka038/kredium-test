<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    private ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function getReport()
    {
        return view('report', ['report' => $this->reportService->getReportByAdviserId(Auth::id())]);
    }

    public function getReportCsv()
    {
        $headers = [
            "Product type",
            "Product value",
            "Creation date",
        ];
        $data = $this->reportService->getReportByAdviserId(Auth::id());

        return new StreamedResponse(function () use ($data, $headers) {
            $output = fopen('php://output', 'w');
            fputcsv($output, $headers);

            foreach ($data as $row) {
                fputcsv($output, [
                    $row->product_type,
                    $row->product_value,
                    $row->creation_date
                ]);
            }
        }, 200, [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=exampleDownload.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ]);
    }
}