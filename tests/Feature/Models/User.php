<?php

namespace Tests\Feature\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    use SoftDeletes, Authenticatable;

    public $fillable = [
        'name',
        'surname'
    ];
}