<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserContractInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function($table){
           $table -> double('base_rate', 15, 2);
           $table -> boolean('enabled');
        });
        
        Schema::table('invoices', function($table){
           $table -> dropColumn('base_rate');
           $table -> date('due_date');
           $table -> boolean('enabled');
           $table -> boolean('paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function($table){
           $table -> dropColumn(array('base_rate', 'enabled'));
        });
        
        Schema::table('invoices', function($table){
           $table -> double('base_rate', 15, 2);
           $table -> dropColumn(array('due_date', 'enabled', 'paid'));
        });
    }
}
