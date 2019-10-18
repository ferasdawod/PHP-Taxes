<?php

namespace App\Providers;

use App\Services\Reporting\Implementations\CsvReportingService;
use App\Services\Reporting\Implementations\DbReportingService;
use App\Services\Reporting\IReportingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \DB::listen(function($sql) {
            \Log::info($sql->sql);
            \Log::info($sql->bindings);
            \Log::info($sql->time);
        });

        $reportingImplementation = config('reporting.source') === 'db' ? DbReportingService::class : CsvReportingService::class;
        $this->app->bind(IReportingService::class, $reportingImplementation);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
