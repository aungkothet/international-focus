<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNameListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('name_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('worker_id');
            $table->string('name_mm')->nullable();
            $table->string('name_eng')->nullable();
            $table->string('father_name_mm')->nullable();
            $table->string('father_name_eng')->nullable();
            $table->string('gender_mm')->nullable();
            $table->string('gender_eng')->nullable();
            $table->string('nrc_mm')->nullable();
            $table->string('nrc_eng')->nullable();
            $table->string('qualification')->nullable();
            $table->string('dob_mm')->nullable();
            $table->string('dob_eng')->nullable();
            $table->string('address_mm')->nullable();
            $table->string('address_eng')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('issue_date_of_passport')->nullable();
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
        Schema::dropIfExists('name_lists');
    }
}
