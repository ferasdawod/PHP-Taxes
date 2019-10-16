<?php

namespace App\Services\Reporting\Implementations;

use App\Services\Reporting\IReportingService;

class CsvReportingService implements IReportingService
{
    public function getStatesAverageTaxes(): array
    {
        // TODO: Implement getStatesTotalTaxes() method.
    }

    public function getStatesTotalTaxes(): array
    {
        // TODO: Implement getStatesTotalTaxes() method.
    }

    public function getStatesAverageTaxRate(): array
    {
        // TODO: Implement getStatesAverageTaxRate() method.
    }

    public function getAverageTaxRate(): float
    {
        // TODO: Implement getAverageTaxRate() method.
    }

    public function getTotalTaxes(): float
    {
        // TODO: Implement getTotalTaxes() method.
    }

    public function loadDataFromFile() : array {
        // load the data file contents and parse the csv format then
        // return the data without the header row as we are only concerned with the data
        $fileContents = Storage::get(config('reporting.csv.path'));
        $data = array_map('str_getcsv', $fileContents);
        return array_splice($data, 1);
    }
}
