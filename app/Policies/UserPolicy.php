<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Filters\AdminFilter;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy extends AdminFilter
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
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function view(User $user, User $model): Response
    {
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny("You cannot view this user's details.");
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User|null $user
     * @return Response
     */
    public function create(?User $user): Response
    {
        return is_null($user)
            ? Response::allow()
            : Response::deny("You already have an account.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function update(User $user, User $model): Response
    {
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny("You cannot update this user.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function delete(User $user, User $model): Response
    {
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny("You cannot delete this user.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function restore(User $user, User $model): Response
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     * I'd like to make this return false, but it goes against GDPR.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function forceDelete(User $user, User $model): Response
    {
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny("You cannot delete this user.");
    }
}