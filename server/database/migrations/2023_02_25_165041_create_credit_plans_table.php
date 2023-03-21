<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_plans', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->decimal("percent", 5);
            $table->unsignedInteger("min_period");
            $table->unsignedInteger("max_period");
            $table->unsignedInteger("min_amount");
            $table->unsignedInteger("max_amount");
            $table->boolean("annuity");
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
        Schema::dropIfExists('credit_plans');
    }
};
