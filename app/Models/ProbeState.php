<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProbeState extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'probe_states';

    /*
     * Physical relationships.
     */

    /**
     * Gets the probe of the probe state.
     *
     * @return BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Probe::class);
    }
}
