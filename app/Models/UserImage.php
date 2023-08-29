<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function booted()
    {
        self::creating(function (UserImage $model) {
            $model->created_at = now();
        });
    }

    protected $fillable = [
        'image'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_user_image');
    }
}
