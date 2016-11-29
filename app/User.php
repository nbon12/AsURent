<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
    //TODO: possible constructor to make all users automatically get a stripe customer id?
    /*
    public function __construct()
    {
        /*
        \Stripe\Stripe::setApiKey(env("ASURENT_STRIPE_SECRET"));
        $customer = \Stripe\Customer::create(array(
          "description" => "Constructed Customer for AsURent",
          "source" => null // will be replaced with btok...
        ));
        $user->'stripe_customer_id' = $customer->id;
        $user->save();
        
    }
    */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'mailing_address', 'stripe_customer_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Get all tasks for the user.
     */
     public function tasks()
     {
         return $this->hasMany(Task::class); 
     }
     
     /**
      * Get all contracts for the user.
      */
      public function contracts()
      {
          $contractsll = DB::table('contracts')->where('landlord_id', '=', $this->id);
          
          //NOTE: add this and return $contracts for all contracts tenant or landlord
          //$contracts = DB::table('contracts')->where('tenant_id', '=', $this->id)->union($contractsll);
          
          return $contractsll;
      }
      public function contractstenant()
      {
          $contracts = DB::table('contracts')->where('tenant_id', '=', $this->id);
          return $contracts;
      }
      public function subscribe($name, $amount)
      {
        dd($user = User::find(1));

        $user->newSubscription('main', 'monthly')->create($creditCardToken);
      }
      
      public function invoices(){
          $contracts = $this -> contracts() -> get();
             $contract_ids = array();
             foreach($contracts as $cont){
                 array_push($contract_ids, $cont -> id);
             }
             return Invoice::whereIn('contract_id', $contract_ids)->get();
      }
      
      public function isStripe(){
          if($this->stripe_access_token){
              return true;
          }
          return false;
      }
    
}
