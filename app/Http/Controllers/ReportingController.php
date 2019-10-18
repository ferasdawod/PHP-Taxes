<?php

namespace App\Http\Controllers;

use App\Services\Reporting\Implementations\CsvReportingService;
use App\Services\Reporting\Implementations\DbReportingService;
use App\Services\Reporting\IReportingService;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    /**
     * @var IReportingService
     */
    public $reportingService;

    /**
     * ReportingController constructor.
     * @param IReportingService $reportingService
     */
    public function __construct(IReportingService $reportingService) {
        $this->reportingService = $reportingService;
    }

    /**
     * Returns statistics about the country and states' tax rates and collected taxes
     * @return array
     */
    public function taxes() {
        $data = [
            'total_taxes' => $this->reportingService->getTotalTaxes(),
            'avg_tax_rate' => $this->reportingService->getAverageTaxRate(),
            'states_avg_tax_rate' => collect($this->reportingService->getStatesAverageTaxRate())->map->toArray(),
            'states_total_taxes' => collect($this->reportingService->getStatesTotalTaxes())->map->toArray(),
            'states_avg_taxes' => collect($this->reportingService->getStatesAverageTaxes())->map->toArray(),
        ];

        return $data;
    }
}
