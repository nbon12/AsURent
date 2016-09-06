<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Task extends Model
{
    protected $fillable = ['name'];
    
    /**
     * The policy mappings for the application
     * @var array
     */ 
   
    /**
     * Get the user that owns this task.
     */
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
