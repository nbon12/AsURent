<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SubscriptionController extends Controller
{
    public function payOnce(Request $request)
     {
         //dd($request->stripeToken);
         $token = $_POST['stripeToken'];
         dd($token);
         //$item = new Item;
         //$item -> description = $request -> desc;
         //$item -> invoice_id =  $invoice -> id;
         //$item -> value = $request -> value;
         //$item -> save();
         
         //return redirect('/invoice/'.$contract -> id.'/'.$invoice -> id);
     }
}
