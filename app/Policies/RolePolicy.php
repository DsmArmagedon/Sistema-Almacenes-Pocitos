<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->isAuthorized(['roles.index','roles.update','roles.store','roles.destroy','roles.show']);
    }

    public function store(User $user)
    {
        return $user->isAuthorized('roles.store');
    }
    public function show(User $user)
    {
        return $user->isAuthorized('roles.show');
    }
    public function update(User $user)
    {
        return $user->isAuthorized('roles.update');
    }

    public function destroy(User $user)
    {
        return $user->isAuthorized('roles.destroy');
    }
}
