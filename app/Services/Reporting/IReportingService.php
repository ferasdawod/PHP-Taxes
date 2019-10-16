<?php

namespace App\Services\Reporting;

use App\ViewModels\Reporting\StateReportUnit;

interface IReportingService
{
    /**
     * @return StateReportUnit[]
     */
    public function getStatesAverageTaxes() : array ;

    /**
     * @return StateReportUnit[]
     */
    public function getStatesTotalTaxes() : array;

    /**
     * @return StateReportUnit[]
     */
    public function getStatesAverageTaxRate() : array;

    public function getAverageTaxRate() : float;

    public function getTotalTaxes() : float;
}
