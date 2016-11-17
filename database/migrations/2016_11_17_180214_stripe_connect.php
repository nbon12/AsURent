<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StripeConnect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('stripe_access_token')->nullable();
            $table->string('stripe_refresh_token')->nullable();
            $table->string('stripe_publishable_key')->nullable();
            $table->string('stripe_user_id')->nullable();
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
            $table->dropColumn(['stripe_access_token', 'stripe_refresh_token', 'stripe_publishable_key', 'stripe_user_id']);
        });
    }
}
