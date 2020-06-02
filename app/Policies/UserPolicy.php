<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    protected $firstShow = true;
    protected $permissionShow = false;
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->isAuthorized(['users.index','users.store','users.update','users.destroy','users.show']);
    }

    public function store(User $user)
    {
        return $user->isAuthorized('users.store');
    }
    public function show(User $user)
    {
        return $user->isAuthorized('users.show');
    }
    public function update(User $user)
    {
        return $user->isAuthorized('users.update');
    }

    public function destroy(User $user)
    {
        return $user->isAuthorized('users.destroy');
    }
}
