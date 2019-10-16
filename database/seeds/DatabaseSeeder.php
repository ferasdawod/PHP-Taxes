<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\State::class, 5)->create()->each(function (\App\Models\State $state) {
            $state->counties()->saveMany(factory(\App\Models\County::class, rand(1, 5))->make());
            $state->counties->each(function (\App\Models\County $county) {
                $county->entries()->saveMany(factory(\App\Models\TaxEntry::class, rand(2, 10))->make());
            });
        });
    }
}
