<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('avatar_id')->unique()->nullable();
            $table->string('login', 32)->unique();
            $table->string('password', 64);
            $table->string('email', 256)->unique();
            $table->unsignedSmallInteger('account_status')->default(User::ACCOUNT_STATUS_UNCONFIRMED);
            $table->string('name', 32);
            $table->string('surname', 32);
            $table->string('patronymic', 32)->nullable();
            $table->timestamps();
        });
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
};
