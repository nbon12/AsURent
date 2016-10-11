<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTableCid extends Migration
{
    /**
     * For Stripe purposes: Extend user table to have account_id, private_key, public_key,
     * and (just in case) customer_id.
     * 
     * These keys are private information and must not be leaked.
     * 
     * This is where the stripe customer id will go.
     * 
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
           $table -> date('date_of_birth')->nullable(); //optional
           $table -> string('stripe_account_id');
           $table -> string('stripe_private_key');
           $table -> string('stripe_public_key');
           $table -> string('stripe_customer_id'); //in case we would want to store this.
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn(['date_of_birth', 'stripe_account_id', 'stripe_public_key', 'stripe_customer_id']);
        });
    }
}
