<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'is_admin',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the recipes created by the user.
     *
     * @return HasMany
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class, "owner_id");
    }

    /**
     * Get the fermentations created by the user.
     *
     * @return HasMany
     */
    public function fermentations()
    {
        return $this->hasMany(Fermentation::class, "brewed_by");
    }

    /**
     * Get the probes the user has registered.
     *
     * @return HasMany
     */
    public function probes()
    {
        return $this->hasMany(Probe::class, "owner_id");
    }
}
