<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Contract;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class StripeController extends Controller
{
    
    public function index(Request $request, Contract $contract)
    {
        $pk = User::where('id', $contract->landlord_id)->first()->stripe_publishable_key;
        $rate = $contract->base_rate * 100;
        return view('welcome2', [
             'pk' => $pk,
             'rate' => $rate,
             'contract' => $contract -> id
        ]);
             
    }
    public function connect(Request $request){
            $client = new Client([
                'base_uri' => 'https://connect.stripe.com/oauth/',
                'timeout' => 5.0
            ]);
            
            if(!($request->input("error"))){
                $token_request_body = array(
                    'grant_type' => 'authorization_code',
                    'client_id' => env('STRIPE_CLIENT_ID'),
                    'code' => $request->input("code"),
                    'client_secret' =>  env('STRIPE_SECRET')
                );
                
                $promise = $client->requestAsync('POST','token',['form_params' => $token_request_body]);
                
                $response = $promise->wait();
                
                $response = json_decode($response->getBody());
                
                $user = $request -> user();
                
                $user -> stripe_access_token = $response -> access_token;
                $user -> stripe_refresh_token = $response -> refresh_token;
                $user -> stripe_publishable_key = $response -> stripe_publishable_key;
                $user -> stripe_user_id = $response -> stripe_user_id;
                $user -> save();
                
            }
            else{
                dd('uh oh there was an error');
            }
            return redirect("/home");
    }
    
    public function checkout(Request $request, Contract $contract){
        $pk = User::where('id', $contract->landlord_id)->first()->stripe_access_token;
        \Stripe\Stripe::setApiKey($pk);
        $customer = \Stripe\Customer::create(array(
            'email' => $request -> stripeEmail,
            'source'  => $request -> stripeToken,
            'plan' => $contract -> id
        ));
        dd("check stripe I think we did a success");
    }
    
}