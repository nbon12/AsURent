<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contract extends Model
{
    protected $fillable = ['name', 'description','address','start_date','end_date'];
    
    /*public function user()
    {
        return;
    }*/
    
    public function invoices()
    {
        return $this->hasMany(Invoice::class); 
    }
    
    public function setTenant($email)
    {
        $user = DB::table('users') -> where('email', '=', $email) -> first();
        
        if($user)
            return $user-> id;
        else
            return 9000;
    }
    
    public function getPK()
    {
        return DB::table('users') -> where('id', '=', $this->landlord_id) -> first() -> stripe_publishable_key;
    }
     
}
