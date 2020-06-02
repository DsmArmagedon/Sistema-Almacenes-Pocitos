<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return $user->isAuthorized(['products.index','products.store','products.update','products.show','products.destroy']);
    }

    public function store(User $user)
    {
        return $user->isAuthorized('products.store');
    }
    public function show(User $user)
    {
        return $user->isAuthorized('products.show');
    }
    public function update(User $user)
    {
        return $user->isAuthorized('products.update');
    }

    public function destroy(User $user)
    {
        return $user->isAuthorized('products.destroy');
    }
}
