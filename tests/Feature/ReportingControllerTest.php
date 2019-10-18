<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportingControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testReportingEndpoint()
    {
        $response = $this->get('/api/reporting/taxes');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'total_taxes',
            'avg_tax_rate',
            'states_avg_tax_rate' => [
                '*' => [
                    'id',
                    'name',
                    'value',
                ],
            ],
            'states_total_taxes' => [
                '*' => [
                    'id',
                    'name',
                    'value',
                ],
            ],
            'states_avg_taxes' => [
                '*' => [
                    'id',
                    'name',
                    'value',
                ],
            ],
        ]);
    }
}
