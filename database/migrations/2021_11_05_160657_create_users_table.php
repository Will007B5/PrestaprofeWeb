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
            $table->string('name')->required();
            $table->string('last_name')->required();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['Hombre', 'Mujer'])->default('Hombre');
            $table->enum('civil_status', ['Soltero/a', 'Casado/a', 'Divorciado/a', 'Separacion en proceso judicial', 'Viudo/a', 'Concubinato'])->default('Soltero/a');
            $table->string('curp')->nullable();
            $table->string('address')->nullable();
            $table->string('type')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->required();
            $table->string('password')->required();
            $table->unsignedBigInteger('institution_id');
            $table->unsignedBigInteger('salary_id');
            $table->foreign('institution_id')->references('id')->on('institutions');
            $table->foreign('salary_id')->references('id')->on('salaries');
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
}
