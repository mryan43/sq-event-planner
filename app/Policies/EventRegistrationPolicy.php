<?php

namespace App\Policies;

use App\EventRegistration;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventRegistrationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the event registration.
     *
     * @param  \App\User $user
     * @param  \App\EventRegistration $eventRegistration
     * @return mixed
     */
    public function view(User $user, EventRegistration $eventRegistration)
    {
        return $user->id === $eventRegistration->user_id;
    }

    /**
     * Determine whether the user can create event registrations.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the event registration.
     *
     * @param  \App\User $user
     * @param  \App\EventRegistration $eventRegistration
     * @return mixed
     */
    public function update(User $user, EventRegistration $eventRegistration)
    {
        return $user->id === $eventRegistration->user_id;
    }

    /**
     * Determine whether the user can delete the event registration.
     *
     * @param  \App\User $user
     * @param  \App\EventRegistration $eventRegistration
     * @return mixed
     */
    public function delete(User $user, EventRegistration $eventRegistration)
    {
        return $user->id === $eventRegistration->user_id;
    }

    /**
     * Determine whether the user can restore the event registration.
     *
     * @param  \App\User $user
     * @param  \App\EventRegistration $eventRegistration
     * @return mixed
     */
    public function restore(User $user, EventRegistration $eventRegistration)
    {
        return $user->id === $eventRegistration->user_id;
    }

    /**
     * Determine whether the user can permanently delete the event registration.
     *
     * @param  \App\User $user
     * @param  \App\EventRegistration $eventRegistration
     * @return mixed
     */
    public function forceDelete(User $user, EventRegistration $eventRegistration)
    {
        return $user->id === $eventRegistration->user_id;
    }
}
