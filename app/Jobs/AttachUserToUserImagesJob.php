<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AttachUserToUserImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $countImages;

    /**
     * Create a new job instance.
     */
    public function __construct(int $countImages)
    {
        $this->countImages = $countImages;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::query()
            ->select('id')
            ->chunk(100, function (Collection $users) {
                AttachCollectionUsersToImagesJob::dispatch($users, $this->countImages);
            });
    }
}
