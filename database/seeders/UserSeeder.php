<?php

namespace Database\Seeders;

use App\Jobs\CreateUsersJob;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    const COUNT_USERS = 10000;
    /**
     * Run the database seeds.
     */
    public function run()
    {
        CreateUsersJob::dispatch(self::COUNT_USERS);
    }
}
