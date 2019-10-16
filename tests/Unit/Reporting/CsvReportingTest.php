<?php

namespace Tests\Unit\Reporting;

use App\Services\Reporting\Implementations\CsvReportingService;
use Tests\TestCase;

class CsvReportingTest extends TestCase
{
    public function testCsvStatesAverageTaxes() {
        $service = new CsvReportingService();
        $result = $service->getStatesAverageTaxes();

        // assert
        $this->assertIsArray($result);
        $this->assertEquals(sizeof($result),2);

        $this->assertEquals($result[0]->getId(), 1);
        $this->assertEquals($result[0]->getValue(), 2500);

        $this->assertEquals($result[1]->getId(), 2);
        $this->assertEquals($result[1]->getValue(), 5500);
    }

    public function testCsvStatesTotalTaxes() {
        $service = new CsvReportingService();
        $result = $service->getStatesTotalTaxes();

        // assert
        $this->assertIsArray($result);
        $this->assertEquals(sizeof($result),2);

        $this->assertEquals($result[0]->getId(), 1);
        $this->assertEquals($result[0]->getValue(), 10000);

        $this->assertEquals($result[1]->getId(), 2);
        $this->assertEquals($result[1]->getValue(), 11000);
    }

    public function testCsvStatesAverageTaxRate()
    {
        $service = new CsvReportingService();
        $result = $service->getStatesAverageTaxRate();

        // assert
        $this->assertIsArray($result);
        $this->assertEquals(sizeof($result),2);

        $this->assertEquals($result[0]->getId(), 1);
        $this->assertEquals($result[0]->getValue(), 2.5);

        $this->assertEquals($result[1]->getId(), 2);
        $this->assertEquals($result[1]->getValue(), 5.5);
    }

    public function testAverageTaxRates()
    {
        $service = new CsvReportingService();
        $result = $service->getAverageTaxRate();

        $this->assertEquals($result, 3.5);
    }

    public function testTotalTaxes()
    {
        $service = new CsvReportingService();
        $result = $service->getTotalTaxes();

        $this->assertEquals($result, 21000);
    }
}
