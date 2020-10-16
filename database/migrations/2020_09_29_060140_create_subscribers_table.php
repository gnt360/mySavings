<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id');
            $table->string('name', 300);
            $table->string('status', 25);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('active_status')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->string('deleted_by')->nullable();

            $table->foreign('category_id')->references('id')->on('subscriber_categories')->onDelete('restrict');
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
        Schema::dropIfExists('subscribers');
    }
}