<?php

use App\Models\County;
use App\Models\State;
use App\Models\TaxEntry;
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
        $maxCountiesPerState = 5;
        $maxEntriesPerCounty = 10;

        factory(State::class, 5)->create()->each(function (State $state) use ($maxCountiesPerState, $maxEntriesPerCounty) {
            $state->counties()->saveMany(factory(County::class, rand(1, $maxCountiesPerState))->make());
            $state->counties->each(function (County $county) use ($maxEntriesPerCounty) {
                $county->entries()->saveMany(factory(TaxEntry::class, rand(1, $maxEntriesPerCounty))->make());
            });
        });
    }
}
