<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Role;
use \App\Models\User;

class CreateRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::firstOrCreate([
            'id' => Role::ADMIN_ROLE_ID,
        ],
            [
                'name' => 'admin',
            ]);

        Role::firstOrCreate([
            'id' => Role::AUTHOR_ROLE_ID,
        ],
            [
                'name' => 'author',
            ]);
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
