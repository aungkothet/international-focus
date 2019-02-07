<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandLetterNameListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_letter_name_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_letter_id');
            $table->integer('name_list_id');
            $table->string('labour_card_no')->nullable();
            $table->string('issue_labour_date')->nullable();
            
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
        Schema::dropIfExists('demand_letter_name_lists');
    }
}
