<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
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
        return $user->isAuthorized(['purchases.index','purchases.store','purchases.update','purchases.show','purchases.destroy']);
    }

    public function store(User $user)
    {
        return $user->isAuthorized('purchases.store');
    }
    public function show(User $user)
    {
        return $user->isAuthorized('purchases.show');
    }
    public function update(User $user)
    {
        return $user->isAuthorized('purchases.update');
    }

    public function destroy(User $user)
    {
        return $user->isAuthorized('purchases.destroy');
    }
}
