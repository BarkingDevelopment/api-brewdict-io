<?php

namespace App\Policies;

use App\Models\ProbeAssignment;
use App\Models\User;
use App\Policies\Filters\AdminFilter;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProbeAssignmentPolicy extends AdminFilter
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function viewAny(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param ProbeAssignment $probeAssignment
     * @return Response
     */
    public function view(User $user, ProbeAssignment $probeAssignment)
    {
        return $user->id === $probeAssignment->probe()->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this probe.", 403);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param ProbeAssignment $probeAssignment
     * @return Response
     */
    public function update(User $user, ProbeAssignment $probeAssignment)
    {
        return Response::deny("Method not allowed.", 405);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param ProbeAssignment $probeAssignment
     * @return Response
     */
    public function delete(User $user, ProbeAssignment $probeAssignment)
    {
        return $user->id === $probeAssignment->probe()->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this probe.", 403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param ProbeAssignment $probeAssignment
     * @return Response
     */
    public function restore(User $user, ProbeAssignment $probeAssignment)
    {
        return Response::deny("Method not allowed.", 405);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param ProbeAssignment $probeAssignment
     * @return Response
     */
    public function forceDelete(User $user, ProbeAssignment $probeAssignment)
    {
        return $user->id === $probeAssignment->probe()->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this probe.", 403);
    }
}
