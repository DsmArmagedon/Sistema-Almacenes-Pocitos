<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InputOutputPolicy
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
    public function index(User $user)
    {
        return $user->isAuthorized(['inputs-outputs.index','inputs-outputs.store','inputs-outputs.update','inputs-outputs.show','inputs-outputs.destroy']);
    }

    public function store(User $user)
    {
        return $user->isAuthorized('inputs-outputs.store');
    }
    public function show(User $user)
    {
        return $user->isAuthorized('inputs-outputs.show');
    }
    public function update(User $user)
    {
        return $user->isAuthorized('inputs-outputs.update');
    }

    public function destroy(User $user)
    {
        return $user->isAuthorized('inputs-outputs.destroy');
    }
}
