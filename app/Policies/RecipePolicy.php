<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use App\Policies\Filters\AdminFilter;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RecipePolicy extends AdminFilter
{
    use HandlesAuthorization;

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
     * @param Recipe $recipe
     * @return Response
     */
    public function view(?User $user, Recipe $recipe)
    {
        return optional($user)->id === $recipe->owner()->id || !$recipe->isPrivate()
            ? Response::allow()
            : Response::deny("You cannot view this recipe.", 403);
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
     * @param Recipe $recipe
     * @return Response
     */
    public function update(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this recipe.", 403);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Recipe $recipe
     * @return Response
     */
    public function delete(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this recipe.", 403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Recipe $recipe
     * @return Response
     */
    public function restore(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this recipe.", 403);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Recipe $recipe
     * @return Response
     */
    public function forceDelete(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->owner()->id
            ? Response::allow()
            : Response::deny("You do not own this recipe.", 403);
    }
}
