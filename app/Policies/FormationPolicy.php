<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Formation;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Formation $formation){
        return $user->id === $formation->user_id;
    }
    public function delete(User $user, Formation $formation){
        return $user->id === $formation->user_id;
    }
    
}
