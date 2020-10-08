<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->uuid('account_type_id');
            $table->string('pin', 6)->default(1);
            $table->string('status', 25)->default('Active');
            $table->string('account_number', 20);
            $table->decimal('current_balance', 18, 2)->default(0.00);
            $table->decimal('credit_balance', 18, 2)->default(0.00);
            $table->decimal('debit_balance', 18, 2)->default(0.00);
            $table->boolean('is_deleted')->default(0);
            $table->uuid('deleted_by')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('modified_by')->nullable();

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('restrict');
            $table->foreign('id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');         
            $table->foreign('modified_by')->references('id')->on('users')->onDelete('restrict');
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
        Schema::dropIfExists('customer_accounts');
    }
}
