<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reading extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'readings';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fermentation_id',
        'type',
        'recorded_at',
        'probe_id',
        'value',
        'units',
    ];


    /*
     * Physical relationships.
     */

    /**
     * Gets the fermentation the reading belongs to.
     *
     * @return BelongsTo
     */
    public function fermentation()
    {
        return $this->belongsTo(Fermentation::class);
    }

    /**
     * Gets the probe that recorded the reading.
     *
     * @return BelongsTo
     */
    public function probe()
    {
        return $this->belongsTo(Probe::class);
    }
}
