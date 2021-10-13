<?php

use Illuminate\Database\Migrations\Migration;
use \App\Models\Role;
use \App\Models\User;

class CreateAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $adminUser = User::updateorCreate([
            'email' => config('app.admin_email'),
        ],
            [
                'name' => 'Admin',
                'role_id' => Role::ADMIN_ROLE_ID,
                'password' => Hash::make(\Illuminate\Support\Str::random(16)),
            ]
        );

        Password::sendResetLink($adminUser->toArray());

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
