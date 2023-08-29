<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $countUsers;
    /**
     * Create a new job instance.
     */
    public function __construct(int $countUsers)
    {
        $this->countUsers = $countUsers;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::factory($this->countUsers)->create();
    }
}
