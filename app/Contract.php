<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     
}
