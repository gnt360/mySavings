<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile_number');
            $table->string('email1');
            $table->string('email2')->nullable();
            $table->string('state_code')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->uuid('created_by');
            $table->uuid('modified_by');

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('cascade');
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
        Schema::dropIfExists('subscriber_details');
    }
}