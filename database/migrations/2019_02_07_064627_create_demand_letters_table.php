<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_letters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->date('date')->nullable();
            $table->string('demand_no');
            $table->json('count')->nullable();
            $table->json('attached_files')->nullable();
            $table->json('comments')->nullable();
            $table->integer('lock_status')->default(0);//0 unlock, 1 lock
            $table->integer('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('demand_letters');
    }
}
