<?php

namespace Tests\Feature\Assets\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    use SoftDeletes, Authenticatable;

    public $fillable = [
        'name',
        'surname',
        'is_admin'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}