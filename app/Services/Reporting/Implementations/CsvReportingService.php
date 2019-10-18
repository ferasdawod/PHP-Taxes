<?php

namespace App\Services\Reporting\Implementations;

use App\Services\Reporting\IReportingService;
use App\ViewModels\Reporting\StateReportUnit;
use Illuminate\Support\Collection;

class CsvReportingService implements IReportingService
{
    /**
     * @return StateReportUnit[]
     */
    public function getStatesAverageTaxes(): array
    {
        $data = $this->loadDataFromFile();
        $result = $this->aggregateStates($data, function (Collection $rows) {
            return $rows->average(function ($row) {
                return $row[4];
            });
        });

        return $result;
    }

    /**
     * @return StateReportUnit[]
     */
    public function getStatesTotalTaxes(): array
    {
        $data = $this->loadDataFromFile();
        $result = $this->aggregateStates($data, function (Collection $rows) {
            return $rows->sum(function ($row) {
                return $row[4];
            });
        });

        return $result;
    }

    /**
     * @return StateReportUnit[]
     */
    public function getStatesAverageTaxRate(): array
    {
        $data = $this->loadDataFromFile();
        $result = $this->aggregateStates($data, function (Collection $rows) {
            return $rows->average(function ($row) {
                return $row[5];
            });
        });

        return $result;
    }

    /**
     * @return float
     */
    public function getAverageTaxRate(): float
    {
        $data = collect($this->loadDataFromFile());
        $result = $data->average(function ($row) {
            return $row[5];
        });

        return $result;
    }

    /**
     * @return float
     */
    public function getTotalTaxes(): float
    {
        $data = collect($this->loadDataFromFile());
        $result = $data->sum(function ($row) {
            return $row[4];
        });

        return $result;
    }

    /**
     * Load the data csv file from storage into an array of rows
     * @return array
     */
    protected function loadDataFromFile(): array
    {
        // load the data file contents and parse the csv format then
        // return the data without the header row as we are only concerned with the data
        $fileContents = file(storage_path(config('reporting.csv.path')));
        $data = array_map('str_getcsv', $fileContents);
        return array_splice($data, 1);
    }

    /**
     * @param array $rows the complete data rows
     * @param callable $aggregateFunc The aggregation function which receives the state rows array and returns the aggregated value
     * @return array
     */
    protected function aggregateStates(array $rows, $aggregateFunc)
    {
        $data = collect($rows);
        return $data
            ->groupBy(function ($row) {
                return $row[0];
            })
            ->map(function ($rows, $state) use ($aggregateFunc) {
                $aggregate = $aggregateFunc(collect($rows));
                return new StateReportUnit($state, $rows[0][1], $aggregate);
            })
            // we want a plain array structure and we have our own model
            // so we only fetch the group by operation's values here
            ->values()
            ->all();
    }
}
