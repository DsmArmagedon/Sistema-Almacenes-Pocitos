<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
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
        return $user->isAuthorized(['sales.index','sales.store','sales.update','sales.show','sales.destroy']);
    }

    public function store(User $user)
    {
        return $user->isAuthorized('sales.store');
    }
    public function show(User $user)
    {
        return $user->isAuthorized('sales.show');
    }
    public function update(User $user)
    {
        return $user->isAuthorized('sales.update');
    }

    public function destroy(User $user)
    {
        return $user->isAuthorized('sales.destroy');
    }
}
