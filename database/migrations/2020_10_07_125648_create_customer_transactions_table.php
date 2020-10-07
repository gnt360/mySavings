<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->uuid('customer_id');
            $table->string('transaction_ref', 25);
            $table->decimal('deposit', 18, 2)->default(0.00);
            $table->decimal('withdrawal', 18, 2)->default(0.00);
            $table->decimal('account_balance', 18, 2)->default(0.00);
            $table->text('description');
            $table->boolean('is_deleted')->default(0);
            $table->uuid('deleted_by')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('modified_by')->nullable();

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('customer_accounts')->onDelete('restrict');
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
        Schema::dropIfExists('customer_transactions');
    }
}
