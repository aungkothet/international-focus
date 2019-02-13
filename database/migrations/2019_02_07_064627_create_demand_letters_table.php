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
            $table->integer('male_count')->default(0);
            $table->integer('female_count')->default(0);
            $table->integer('total')->default(0);
            $table->json('demand_attached_files')->nullable();//for multi image location save
            $table->text('comments')->nullable();
            $table->json('passport_attached_files')->nullable();//for multi image location save
            $table->text('passport_comments')->nullable();
            $table->json('contract_attached_files')->nullable();//for multi image location save
            $table->text('contract_comments')->nullable();
            $table->integer('lock_status')->default(0);//0 unlock, 1 lock
            $table->json('summary_attached_files')->nullable();
            $table->text('summary_comments')->nullable();
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
