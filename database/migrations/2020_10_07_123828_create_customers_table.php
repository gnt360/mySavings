<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('middle_name', 100);
            $table->string('email', 75)->nullable();
            $table->string('phonenumber', 15);
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state_code', 4)->nullable();
            $table->string('country_code', 4)->nullable();
            $table->string('zip', 10)->nullable();
            $table->uuid('created_by');
            $table->uuid('modify_by')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->string('deleted_by')->nullable();

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('restrict');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('customers');
    }
}
