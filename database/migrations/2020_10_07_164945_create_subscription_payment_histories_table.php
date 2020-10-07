<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_payment_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->decimal('amount_paid', 18, 2);
            $table->date('date_paid');
            $table->string('status', 75);
            $table->text('description')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->uuid('deleted_by')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('modified_by')->nullable();

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('restrict');
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
        Schema::dropIfExists('subscription_payment_histories');
    }
}
