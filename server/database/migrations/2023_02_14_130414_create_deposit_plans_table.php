<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_plans', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->decimal("percent", 5);
            $table->unsignedInteger("period_in_days");
            $table->boolean("revocable");
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
        Schema::dropIfExists('deposit_plans');
    }
};
