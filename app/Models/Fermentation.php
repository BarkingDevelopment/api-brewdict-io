<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Fermentation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fermentations';

    /*
     * Physical relationships.
     */

    /**
     * Gets the recipe of the fermentation.
     *
     * @return BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Gets the user brewing the fermentation.
     *
     * @return BelongsTo
     */
    public function brewer()
    {
        return $this->belongsTo(User::class, "brewed_by");
    }

    /**
     * Gets the recipe of the fermentation.
     *
     * @return BelongsTo
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Gets the probes involved in recording data for the fermentation.
     *
     * @return HasManyThrough
     */
    public function probes()
    {
        return $this->hasManyThrough(Probe::class, ProbeAssignment::class);
    }

    /**
     * Gets all the readings the probes have recording over the fermentation duration.
     *
     * @return HasMany
     */
    public function readings()
    {
        return $this->hasMany(Reading::class);
    }
}
