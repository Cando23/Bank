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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string("number", 13);
            $table->decimal("debit", 12);
            $table->decimal("credit", 12);
            $table->decimal("balance", 12);
            $table->unsignedBigInteger("plan_id");

            $table->index("plan_id", "account_plan_idx");
            $table->foreign("plan_id", "account_plan_fk")->on("account_plans")->references("id");
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
        Schema::dropIfExists('accounts');
    }
};
