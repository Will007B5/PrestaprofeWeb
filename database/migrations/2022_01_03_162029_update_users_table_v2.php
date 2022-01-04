<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
                 $table->string('rfc')->nullable();
                 $table->string('ine')->nullable();
                 $table->string('pay_stub')->nullable();
                 $table->string('selfie')->nullable();
                 $table->string('proof_address')->nullable();
                 $table->string('first_reference_person_name')->nullable();
                 $table->string('first_reference_person_phone')->nullable();
                 $table->string('second_reference_person_name')->nullable();
                 $table->string('second_reference_person_phone')->nullable();
                 $table->unsignedBigInteger('city_id');
                 $table->foreign('city_id')->references('id')->on('cities');
                 $table->unsignedBigInteger('saving_bank_id');
                 $table->foreign('saving_bank_id')->references('id')->on('saving_banks');
                 $table->unsignedBigInteger('job_id');
                 $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
