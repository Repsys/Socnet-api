<?php

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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()
                ->references('id')->on('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('status_text', 128)->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedSmallInteger('gender')->nullable();
            $table->unsignedSmallInteger('relationship')->nullable();
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
        Schema::dropIfExists('user_profiles');
    }
};
