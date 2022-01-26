<?php

namespace App\Policies;

use App\Models\StyleCategory;
use App\Models\User;
use App\Policies\Filters\AdminFilter;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StyleCategoryPolicy extends AdminFilter
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
     * @param StyleCategory $styleCategory
     * @return Response
     */
    public function view(?User $user, StyleCategory $styleCategory)
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
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param StyleCategory $styleCategory
     * @return Response
     */
    public function update(User $user, StyleCategory $styleCategory)
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param StyleCategory $styleCategory
     * @return Response
     */
    public function delete(User $user, StyleCategory $styleCategory)
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param StyleCategory $styleCategory
     * @return Response
     */
    public function restore(User $user, StyleCategory $styleCategory)
    {
        return Response::deny("Action denied.");
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param StyleCategory $styleCategory
     * @return Response
     */
    public function forceDelete(User $user, StyleCategory $styleCategory)
    {
        return Response::deny("Action denied.");
    }
}
