<?php

namespace Database\Seeders;

use App\Jobs\AttachUserToUserImagesJob;
use App\Jobs\CreateUserImagesJob;
use Illuminate\Database\Seeder;

class UserImageSeeder extends Seeder
{
    const COUNT_IMAGES = 100000;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CreateUserImagesJob::dispatch(self::COUNT_IMAGES);

        AttachUserToUserImagesJob::dispatch(self::COUNT_IMAGES);
    }
}
