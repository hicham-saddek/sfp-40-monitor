<?php

namespace App\Policies;

use App\Models\Data;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataPolicy
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

    public function view(User $user, Data $data): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Data $data): bool
    {
        //
    }

    public function delete(User $user, Data $data): bool
    {
        //
    }

    public function restore(User $user, Data $data): bool
    {
        //
    }

    public function forceDelete(User $user, Data $data): bool
    {
        //
    }
}
