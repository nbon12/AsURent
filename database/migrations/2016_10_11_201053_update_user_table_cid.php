<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTableCid extends Migration
{
    /**
     * Prepares the database for Stripe managed accounts.
     * Extend user table to have account_id, private_key, public_key,
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
           $table -> string('stripe_account_id')->nullable();
           $table -> string('stripe_private_key')->nullable();
           $table -> string('stripe_public_key')->nullable();
           $table -> string('stripe_customer_id')->nullable(); //in case we would want to store this.
           
        });
    }

    /**
     * Reverse the Stripe preparations.
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
