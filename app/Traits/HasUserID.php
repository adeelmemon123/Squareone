<?php

namespace App\Traits;

use App\Models\Scopes\UserScope;

trait HasUserID
{


    protected static function booted(): void
    {
        static::addGlobalScope('user_id', function ($builder) {

            if (env('USE_USER_ID')) {
                $user_id = config('user_id');
                $builder->where('user_id', $user_id);
            }
        });

        static::creating(function ($builder) {
            if (env('USE_USER_ID')) {
                $builder->user_id = auth()->user()->id;
            }
        });
    }
}



