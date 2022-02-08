<?php /** @noinspection PhpInconsistentReturnPointsInspection */

namespace App\Policies\Filters;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

trait AdminFilter
{
    use HandlesAuthorization;

    /***
     * @param User $user
     * @param $ability
     * @return Response
     */
    public function before(User $user, $ability)
    {
        if ($user->role == UserRole::Admin()) {
            return Response::allow();
        }
    }
}
