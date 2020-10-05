<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->boolean('status')->default(1);
            $table->string('account_type');
            $table->string('account_name');
            $table->decimal('current_balance', 18, 2)->default(0.00);
            $table->decimal('credit_balance', 18, 2)->default(0.00);
            $table->decimal('debit_balance', 18, 2)->default(0.00);
            $table->boolean('is_deleted')->default(0);
            $table->boolean('deleted_by')->nullable();
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
        Schema::dropIfExists('subscriber_accounts');
    }
}