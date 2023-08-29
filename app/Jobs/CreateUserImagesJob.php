<?php

namespace App\Jobs;

use App\Models\UserImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateUserImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $countImages;

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
        UserImage::factory($this->countImages)->create();
    }
}
