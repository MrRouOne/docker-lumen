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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email',256)->nullable(false)->unique();
            $table->string('password',256)->nullable(false);
            $table->string('phone',16)->nullable(false)->unique();;
            $table->string('last_name',64)->nullable(false);
            $table->string('first_name',64)->nullable(false);
            $table->boolean('is_admin')->nullable(false)->default(0);
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
