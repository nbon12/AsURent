<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'mailing_address'
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
      * Get all contracts for the user where user is landlord of.
      * Get all contracts for the user where user is tenant of.
      */
      public function contracts()
      {
          $contractsll = DB::table('contracts')->where('landlord_id', '=', $this->id);
          $contractsll->tenant = DB::table('contracts')->where('tenant_id', '=', $this->id);
          //NOTE: add this and return $contracts for all contracts tenant or landlord
          //$contracts = DB::table('contracts')->where('tenant_id', '=', $this->id)->union($contractsll);
          //dd($contractsll->description);
          return $contractsll;
      }
     
}
