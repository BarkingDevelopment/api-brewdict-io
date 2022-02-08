<?php

namespace App\Policies;

use App\Models\Style;
use App\Models\User;
use App\Policies\Filters\AdminFilter;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StylePolicy
{
    use HandlesAuthorization, AdminFilter;

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @return Response
     */
    public function viewAny(?User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param Style $style
     * @return Response
     */
    public function view(?User $user, Style $style)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user)
    {
        return Response::deny("Method not allowed.", 405);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Style $style
     * @return Response
     */
    public function update(User $user, Style $style)
    {
        return Response::deny("Method not allowed.", 405);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Style $style
     * @return Response
     */
    public function delete(User $user, Style $style)
    {
        return Response::deny("Method not allowed.", 405);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Style $style
     * @return Response
     */
    public function restore(User $user, Style $style)
    {
        return Response::deny("Method not allowed.", 405);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Style $style
     * @return Response
     */
    public function forceDelete(User $user, Style $style)
    {
        return Response::deny("Method not allowed.", 405);
    }
}
