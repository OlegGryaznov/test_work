<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function booted()
    {
        self::creating(function (User $model) {
            $model->created_at = now();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city'
    ];

    public function images()
    {
        return $this->belongsToMany(UserImage::class,'user_user_image');
    }
}
