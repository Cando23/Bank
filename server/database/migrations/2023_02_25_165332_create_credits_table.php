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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->date("start_date");
            $table->unsignedInteger("period");
            $table->date("end_date");
            $table->decimal("amount", 12, 4);
            $table->unsignedBigInteger("card_id");
            $table->unsignedBigInteger("plan_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("percent_account_id");
            $table->unsignedBigInteger("main_account_id");

            $table->index("card_id", "credit_card_idx");
            $table->index("plan_id", "credit_plan_idx");
            $table->index("user_id", "credit_user_idx");
            $table->index("percent_account_id", "deposit_percent_account_idx");
            $table->index("main_account_id", "deposit_main_account_idx");

            $table->foreign("card_id", "credit_card_fk")->on("cards")->references("id");
            $table->foreign("plan_id", "credit_plan_fk")->on("credit_plans")->references("id");
            $table->foreign("user_id", "credit_user_fk")->on("users")->references("id");
            $table->foreign("percent_account_id", "credit_percent_account_fk")->on("accounts")->references("id");
            $table->foreign("main_account_id", "credit_main_account_fk")->on("accounts")->references("id");

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
        Schema::dropIfExists('credits');
    }
};
