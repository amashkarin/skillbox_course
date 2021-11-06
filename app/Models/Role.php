<?php

namespace App\Models;


class Role extends Model
{
    const ADMIN_ROLE_ID = 1;
    const AUTHOR_ROLE_ID = 2;

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
