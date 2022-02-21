<?php

namespace App\Policies;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
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

    public function view(User $user, Channel $channel): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Channel $channel): bool
    {
        //
    }

    public function delete(User $user, Channel $channel): bool
    {
        //
    }

    public function restore(User $user, Channel $channel): bool
    {
        //
    }

    public function forceDelete(User $user, Channel $channel): bool
    {
        //
    }
}
