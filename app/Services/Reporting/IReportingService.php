<?php

namespace App\Services\Reporting;

use App\ViewModels\Reporting\StateReportUnit;

interface IReportingService
{
    /**
     * Returns the average collected taxes for each state
     * @return StateReportUnit[]
     */
    public function getStatesAverageTaxes() : array ;

    /**
     * Returns the total collected taxes for each state
     * @return StateReportUnit[]
     */
    public function getStatesTotalTaxes() : array;

    /**
     * Returns the average tax rate for each state
     * @return StateReportUnit[]
     */
    public function getStatesAverageTaxRate() : array;

    /**
     * Returns the average tax rate of the whole country
     * @return float
     */
    public function getAverageTaxRate() : float;

    /**
     * Returns the total collected taxes for the whole country
     * @return float
     */
    public function getTotalTaxes() : float;
}
