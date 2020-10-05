<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->uuid('account_id');
            $table->decimal('deposit', 18, 2)->default(0.00);
            $table->decimal('withdrawal', 18, 2)->default(0.00);
            $table->decimal('account_balance', 18, 2)->nullable();
            $table->text('description');
            $table->boolean('is_deleted')->default(0);
            $table->boolean('deleted_by')->nullable();
            $table->uuid('created_by');
            $table->uuid('modified_by');

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('subscriber_accounts')->onDelete('cascade');
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
        Schema::dropIfExists('subscriber_transactions');
    }
}