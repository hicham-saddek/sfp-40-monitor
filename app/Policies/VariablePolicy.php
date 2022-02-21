<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Variable;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariablePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Variable $variable): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Variable $variable): bool
    {
        //
    }

    public function delete(User $user, Variable $variable): bool
    {
        //
    }

    public function restore(User $user, Variable $variable): bool
    {
        //
    }

    public function forceDelete(User $user, Variable $variable): bool
    {
        //
    }
}
