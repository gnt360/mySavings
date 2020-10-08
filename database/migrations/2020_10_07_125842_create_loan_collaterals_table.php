<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanCollateralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_collaterals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriber_id');
            $table->uuid('loan_id');           
            $table->string('name', 250);
            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('manufacturer')->nullable();
            $table->decimal('current_value', 18,2)->default(0.00);
            $table->string('proof_of_ownership_url')->nullable();
            $table->string('image_url')->nullable();
            $table->text('remark');

            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('restrict');
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('restrict');
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
        Schema::dropIfExists('loan_collaterals');
    }
}
