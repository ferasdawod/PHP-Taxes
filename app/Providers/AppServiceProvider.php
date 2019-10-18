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
        // Log database queries to the app log if we're not running in production
        if (config('app.env') !== 'production') {
            \DB::listen(function($sql) {
                \Log::info($sql->sql);
                \Log::info($sql->bindings);
                \Log::info($sql->time);
            });
        }

        // Bind the correct data source for the reporting service
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
