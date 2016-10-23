<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
class SubscriptionController extends Controller
{
    public function payOnce(Request $request, User $user)
     {
        \Stripe\Stripe::setApiKey(env('ASURENT_STRIPE_SECRET'));
        //Get the single token from the form...
        $token = $_POST['stripeToken'];
        //Turn the token into a customer...
        $customer = \Stripe\Customer::create(array(
            "description" => "Customer for AsURent",
            "source" => $token // obtained with Stripe.js
        ));
        //dd($user);
        $user = User::where('email', $request->email)->first();
        
        //dd($user);
        //need to attach this customer id to SOMEONE in the database.
        //SubscriptionController::makeSubscription("1233");
        //dd($customer);
        //dd($customer);
        //$user->newSubscription('gold', '1233')->create($customer->source);
     }
     public function makeSubscription($subsName, $amountcents)
     {
        \Stripe\Stripe::setApiKey(env('ASURENT_STRIPE_SECRET'));
        
        $subscription = \Stripe\Plan::create(array(
        "amount" => $amountcents, //in cents, which is 1000USD
        "interval" => "month",
        "name" => $subsName,
        "currency" => "usd",
        "id" => $subsName)
        );
     }
     public function signUp(User $user)
     { 
         $user->newSubscription('main', 'monthly')->create($creditCardToken);
     }
}
