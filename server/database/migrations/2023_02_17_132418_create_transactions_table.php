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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal("amount", 12);
            $table->unsignedBigInteger("credit_account_id");
            $table->unsignedBigInteger("debit_account_id");
            $table->timestamps();

            $table->index("credit_account_id", "transaction_credit_account_idx");
            $table->index("debit_account_id", "transaction_debit_account_idx");

            $table->foreign("credit_account_id", "transaction_credit_account_fk")->on("transactions")->references("id");
            $table->foreign("debit_account_id", "transaction_debit_account_fk")->on("transactions")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
