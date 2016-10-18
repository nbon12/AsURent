<?php

namespace App\Repositories;

use App\User;

class ContractRepository
{
    /**
     * Get all of the contracts for a given user.
     * 
     * @param User $user
     * @return Collection
     */ 
    public function forUser(User $user)
    {
        return $user->contracts()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
    
}