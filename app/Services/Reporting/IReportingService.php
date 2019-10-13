<?php

namespace App\Services\Reporting;

interface IReportingService
{
    function getStatesAverageTaxes() : array ;
    function getStatesTotalTaxes() : array;
    function getStatesAverageTaxRate() : array;
    function getAverageTaxRate() : float;
    function getTotalTaxes() : float;
}
