<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('payment_reference')->nullable();
            $table->decimal('amount',8,2)->required();
            $table->enum('payment_schema',['monthly','biweekly'])->default('monthly');
            $table->timestamp('application_date')->required();
            $table->string('payment_proof')->nullable();
            $table->timestamp('expired_date')->nullable();
            $table->timestamp('accepted_date')->nullable();
            $table->timestamp('frozen_date')->nullable();
            $table->unsignedBigInteger('loan_state_id');
            $table->foreign('loan_state_id')->references('id')->on('loan_states');
            $table->unsignedBigInteger('card_id');
            $table->foreign('card_id')->references('id')->on('cards');
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
        Schema::dropIfExists('loans');
    }
}
