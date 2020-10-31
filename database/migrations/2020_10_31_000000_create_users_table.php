<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->enum('role', ['admin', 'client'])->default('client');
            $table->string('password');
            $table->timestamps();
        });
        \App\User::create([
           'name'=> 'admin',
           'role'=> 'admin',
           'email'=> 'admin@myShop.dev',
           'password'=> \Illuminate\Support\Facades\Hash::make('admin'),

        ]);
        \App\User::create([
           'name'=> 'client',
           'role'=> 'client',
           'email'=> 'client@myShop.dev',
           'password'=> \Illuminate\Support\Facades\Hash::make('client'),

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
