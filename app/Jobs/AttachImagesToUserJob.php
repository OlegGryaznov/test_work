<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AttachImagesToUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;
    public array $images;

    /**
     * AttachImagesJob constructor.
     * @param User $user
     * @param array $images
     */
    public function __construct(User $user, array $images)
    {
        $this->user = $user;
        $this->images = $images;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->images()->attach($this->images);
    }
}
