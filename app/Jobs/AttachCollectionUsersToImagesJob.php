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

class AttachCollectionUsersToImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Collection $users;
    public int $countImages;

    /**
     * AttachCollectionUsersToImagesJob constructor.
     * @param Collection $users
     * @param int $countImages
     */
    public function __construct(Collection $users, int $countImages)
    {
        $this->users = $users;
        $this->countImages = $countImages;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->users->each(function (User $user) {
            $imagesIdsCollection = UserImage::query()
                ->inRandomOrder()
                ->take(mt_rand(1, $this->countImages))
                ->pluck('id');

            foreach ($imagesIdsCollection->chunk(10000) as $imageCollection) {
                AttachImagesToUserJob::dispatch($user, $imageCollection->toArray());
            }
        });
    }
}
