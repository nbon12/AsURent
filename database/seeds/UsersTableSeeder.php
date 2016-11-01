<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = \Stripe\Customer::create(array(
          "description" => "Seeded Customer 1 for AsURent",
          "source" => null // will be replaced with btok...
        ));
        DB::table('users')->insert([
                'name' => 'happy',
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('squalid'),
                'stripe_customer_id' => $customer->id;
        ]);
        $customer = \Stripe\Customer::create(array(
          "description" => "Seeded Customer 2 for AsURent",
          "source" => null // will be replaced with btok...
        ));
        DB::table('users')->insert([
                'name' => 'nick',
                'email' => 'nick@nick.nick',
                'password' => bcrypt(env('NICK_PASSWORD', 'password')),
                'stripe_customer_id' => $customer->id;
        ]);
        $customer = \Stripe\Customer::create(array(
          "description" => "Seeded Customer 3 for AsURent",
          "source" => null // will be replaced with btok...
        ));
        DB::table('users')->insert([
                'name' => 'tenantA',
                'email' => 'tenantA@tenant.com',
                'password' => bcrypt(env('NICK_PASSWORD', 'password')),
                'stripe_customer_id' => $customer->id;
                
        ]);
        
    }
}
