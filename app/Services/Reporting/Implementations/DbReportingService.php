<?php

namespace App\Services\Reporting\Implementations;

use App\Models\County;
use App\Models\State;
use App\Models\TaxEntry;
use App\Services\Reporting\IReportingService;
use App\ViewModels\Reporting\StateReportUnit;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class DbReportingService implements IReportingService
{
    public function getStatesAverageTaxes(): array
    {
        // Implementation #1 (database query)
//        $result = DB::table('states')
//            ->join('counties', 'states.id', '=', 'counties.state_id')
//            ->join('tax_entries', 'tax_entries.county_id', '=', 'counties.id')
//            ->selectRaw('states.id, states.name, AVG(tax_entries.amount) as avg_taxes')
//            ->groupBy('states.id')
//            ->get()
//            ->toArray();

        // Implementation #2 (client side)
        $result = State::query()->with('entries')
            ->get()
            ->map(function (State $state) {
                return new StateReportUnit($state, $state->entries->avg('amount'));
            })
            ->all();

        return $result;
    }

    public function getStatesTotalTaxes(): array
    {
        $result = State::query()->with('entries')
            ->get()
            ->map(function (State $state) {
                return new StateReportUnit($state, $state->entries->sum('amount'));
            })
            ->all();

        return $result;
    }

    public function getStatesAverageTaxRate(): array
    {
        $result = State::query()->with('counties')
            ->get()
            ->map(function (State $state) {
                return new StateReportUnit($state, $state->counties->avg('tax_rate'));
            })
            ->all();

        return $result;
    }

    public function getAverageTaxRate(): float
    {
        return County::query()->average('tax_rate');
    }

    public function getTotalTaxes(): float
    {
        return TaxEntry::query()->sum('amount');
    }
}
