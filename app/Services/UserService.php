<?php


namespace App\Services;


use App\Models\User;
use App\Models\UserImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): Model
    {
        $user = User::query()->create([
            'name' => $payload['name'],
            'city' => $payload['city']
        ]);

        $userImage = UserImage::query()
            ->create([
                'image' => Storage::disk('public')
                    ->putFile('user_images', $payload['image'])
            ]);

        $user->images()->attach($userImage);

        return $user;
    }
}
