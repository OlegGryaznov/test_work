<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getUsers($offset = 0, $limit = 15)
    {
        return $this->instance()
            ->selectRaw('users.*, (SELECT COUNT(*) FROM user_user_image WHERE user_user_image.user_id = users.id) as images_count')
            ->orderByDesc('images_count')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    public function getModel()
    {
        return User::class;
    }
}
