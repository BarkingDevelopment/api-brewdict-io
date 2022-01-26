<?php

namespace App\Policies;

use App\Models\Probe;
use App\Models\User;
use App\Policies\Filters\AdminFilter;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProbePolicy extends AdminFilter
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function viewAny(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Probe $probe
     * @return Response|bool
     */
    public function view(User $user, Probe $probe)
    {
        return $user->id === $probe->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this post.");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Probe $probe
     * @return Response|bool
     */
    public function update(User $user, Probe $probe)
    {
        return $user->id === $probe->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this post.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Probe $probe
     * @return Response|bool
     */
    public function delete(User $user, Probe $probe)
    {
        return $user->id === $probe->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this post.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Probe $probe
     * @return Response|bool
     */
    public function restore(User $user, Probe $probe)
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Probe $probe
     * @return Response|bool
     */
    public function forceDelete(User $user, Probe $probe)
    {
        return $user->id === $probe->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this post.");
    }
}
