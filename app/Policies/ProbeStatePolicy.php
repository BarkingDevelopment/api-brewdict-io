<?php

namespace App\Policies;

use App\Models\ProbeState;
use App\Models\User;
use App\Policies\Filters\AdminFilter;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

//TODO Include ProbeStatePolicy for Probes and Admins; allowing them to create probe states and delete and restore readings respectively.
class ProbeStatePolicy extends AdminFilter
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
     * @param ProbeState $probeState
     * @return Response
     */
    public function view(User $user, ProbeState $probeState): Response
    {
        return $user->id === $probeState->probe()->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this post.");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param ProbeState $probeState
     * @return Response
     */
    public function update(User $user, ProbeState $probeState): Response
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param ProbeState $probeState
     * @return Response
     */
    public function delete(User $user, ProbeState $probeState): Response
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param ProbeState $probeState
     * @return Response
     */
    public function restore(User $user, ProbeState $probeState): Response
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param ProbeState $probeState
     * @return Response
     */
    public function forceDelete(User $user, ProbeState $probeState): Response
    {
        return Response::deny("Action denied.");
    }
}
