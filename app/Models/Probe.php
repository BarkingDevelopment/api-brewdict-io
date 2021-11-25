<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Probe extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'probes';

    /*
     * Physical relationships.
     */

    /**
     * Gets the owner of the probe.
     *
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    /**
     * Gets all the readings of the probe.
     *
     * @return HasMany
     */
    public function readings()
    {
        return $this->hasMany(Reading::class);
    }

    /**
     * Gets all the fermentaitons the probe has recorded readings for.
     *
     * @return HasManyThrough
     */
    public function fermentations()
    {
        return $this->hasManyThrough(Fermentation::class, ProbeAssignment::class);
    }

    /**
     * Gets all the status readings of the probe.
     *
     * @return HasMany
     */
    public function statistics()
    {
        return $this->hasMany(ProbeState::class);
    }

    /*
     * Virtual relationships.
     */

    /**
     * Gets the current fermentation the probe is assigned to.
     *
     * @return HasOne
     */
    public function currentFermentation()
    {
        return $this->hasOne(Fermentation::class)->latestOfMany();
    }

    /**
     * Gets the current status reading of the probe.
     *
     * @return HasOne
     */
    public function status()
    {
        return $this->hasOne(ProbeState::class)->latestOfMany("recorded_at", "max");
    }
}
