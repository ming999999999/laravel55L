<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Status;
use App\Models\User;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return 
     */

    public function destroy(User $user,Status $status)
    {

        return $user->id === $status->user_id;
    }
    
}
