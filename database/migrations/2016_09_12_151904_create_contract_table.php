<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description', 200);
            $table->string('address');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            
            $table->integer('landlord_id')->unsigned()->nullable();
            $table->foreign('landlord_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->integer('tenant_id')->unsigned()->nullable();
            $table->foreign('tenant_id')->references('id')
            ->on('users')->onDelete('cascade');
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contracts');
    }
}
