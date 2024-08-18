<?php

namespace Tests\Feature\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}