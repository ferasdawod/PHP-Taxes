<?php

return [

    /**
     * Configuration values for the csv reporting data source
     */
    'csv' => [
        /**
         * The csv file path containing the reporting data
         */
        'path' => env('REPORTING_FILE_PATH', 'app/data/data.csv'),
    ]
];
