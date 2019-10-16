<?php

namespace Tests\Unit\Reporting;

use App\Models\County;
use App\Models\State;
use App\Models\TaxEntry;
use App\Services\Reporting\Implementations\DbReportingService;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DbReportingTest extends TestCase
{
    protected function createTestData() : Collection
    {
        return factory(State::class, 2)->create()->each(function (State $state) {
            $state->counties()->saveMany(factory(County::class, 2)->make());
            $state->counties->each(function (County $county) {
                $county->entries()->saveMany(factory(TaxEntry::class, 2)->make());
            });
        });
    }

    public function testStatesAverageTaxes()
    {
        // arrange
        $states = $this->createTestData();

        // action
        $service = new DbReportingService();
        $result = $service->getStatesAverageTaxes();

        // assert
        $this->assertIsArray($result);
        $this->assertEquals(sizeof($result),2);

        $this->assertEquals($result[0]->getId(), $states[0]->id);
        $this->assertEquals($result[0]->getValue(), $states[0]->entries->avg('amount'));

        $this->assertEquals($result[1]->getId(), $states[1]->id);
        $this->assertEquals($result[1]->getValue(), $states[1]->entries->avg('amount'));
    }

    public function testStatesTotalTaxes()
    {
        // arrange
        $states = $this->createTestData();

        // action
        $service = new DbReportingService();
        $result = $service->getStatesTotalTaxes();

        // assert
        $this->assertIsArray($result);
        $this->assertEquals(sizeof($result),2);

        $this->assertEquals($result[0]->getId(), $states[0]->id);
        $this->assertEquals($result[0]->getValue(), $states[0]->entries->sum('amount'));

        $this->assertEquals($result[1]->getId(), $states[1]->id);
        $this->assertEquals($result[1]->getValue(), $states[1]->entries->sum('amount'));
    }

    public function testStatesAverageTaxRate()
    {
        // arrange
        $states = $this->createTestData();

        // action
        $service = new DbReportingService();
        $result = $service->getStatesAverageTaxRate();

        // assert
        $this->assertIsArray($result);
        $this->assertEquals(sizeof($result),2);

        $this->assertEquals($result[0]->getId(), $states[0]->id);
        $this->assertEquals($result[0]->getValue(), $states[0]->counties->avg('tax_rate'));

        $this->assertEquals($result[1]->getId(), $states[1]->id);
        $this->assertEquals($result[1]->getValue(), $states[1]->counties->avg('tax_rate'));
    }

    public function testAverageTaxRates()
    {
        // arrange
        $states = $this->createTestData();
        $counties = $states[0]->counties->merge($states[1]->counties);

        // action
        $service = new DbReportingService();
        $result = $service->getAverageTaxRate();

        // assert
        $this->assertEquals($result, $counties->avg('tax_rate'));
    }

    public function testTotalTaxes()
    {
        // arrange
        $entries = factory(TaxEntry::class, 10)->make();
        factory(State::class, 1)->create()->each(function (State $state) use ($entries) {
            $county = factory(County::class)->make();
            $state->counties()->save($county);
            $county->entries()->saveMany($entries);
        });

        // action
        $service = new DbReportingService();
        $result = $service->getTotalTaxes();

        // assert
        $this->assertEquals($result, $entries->sum('amount'));
    }
}
