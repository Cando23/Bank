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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->date('date_of_birth');
            $table->string('gender', 1);
            $table->string('passport_series', 2);
            $table->string('passport_number',7);
            $table->string('passport_id_number',14)->unique();
            $table->string('passport_issued_by');
            $table->date('passport_issue_date');
            $table->string('place_of_birth');
            $table->unsignedBigInteger('residence_city_id');
            $table->string('home_phone', 15)->nullable();
            $table->string('personal_phone', 15)->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('marital_status_id');
            $table->unsignedBigInteger('citizenship_id');
            $table->unsignedBigInteger('disability_id');
            $table->decimal('income')->nullable();
            $table->timestamps();

            $table->index('residence_city_id', 'user_residence_city_idx');
            $table->index('city_id', 'user_city_idx');
            $table->index('marital_status_id', 'user_marital_status_idx');
            $table->index('citizenship_id', 'user_citizenship_idx');
            $table->index('disability_id', 'user_disability_idx');

            $table->foreign('residence_city_id', 'user_residence_city_fk')->on('cities')->references('id');
            $table->foreign('city_id', 'user_city_fk')->on('cities')->references('id');
            $table->foreign('marital_status_id', 'user_marital_status_fk')->on('marital_statuses')->references('id');
            $table->foreign('citizenship_id', 'user_citizenship_fk')->on('citizenships')->references('id');
            $table->foreign('disability_id', 'user_disability_fk')->on('disabilities')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
