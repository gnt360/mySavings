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
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->uuid('category_id');
            $table->uuid('customer_id');
            $table->decimal('loan_amount', 18, 2)->default(0.00);
            $table->decimal('paid_amount', 18, 2)->default(0.00);
            $table->decimal('balance', 18, 2)->default(0.00);
            $table->decimal('repayment_amount', 18, 2)->default(0.00);
            $table->date('date_release');
            $table->date('date_due');
            $table->uuid('agent')->nullable();
            $table->text('description')->nullable();
            $table->text('remark')->nullable();
            $table->string('status', 25)->default('Unpaid');
            $table->boolean('is_deleted')->default(0);
            $table->uuid('deleted_by')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('modified_by')->nullable();

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('loan_categories')->onDelete('restrict');
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
        Schema::dropIfExists('loans');
    }
}
