<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportOwnedRent;
use App\Http\Requests\ReportOwnProperties;
use App\Repositories\ReportRepository;

class ReportController extends Controller
{
    private $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getReportOwnedRent(ReportOwnedRent $request)
    {
        return response($this->reportRepository->getReportOwnedRent($request));
    }

    public function getReportOwnProperties(ReportOwnProperties $request)
    {
        return response($this->reportRepository->getReportOwnProperties($request));
    }

}
