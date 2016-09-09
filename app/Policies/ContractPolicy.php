<?php

namespace App\Policies;

use App\User;
use App\Contract;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
{
    use HandlesAuthorization;

   /**
    * Determine if the given user can delete the given Contract.
    * 
    * @param user $user
    * @param Task $task
    * @return bool
    */
    public function destroy(User $user, Contract $contract)
    {
        //return true;
        return $user->id == $contract->user_id;
    }
}
