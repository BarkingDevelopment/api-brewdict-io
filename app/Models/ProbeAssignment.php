<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProbeAssignment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'probe_assignment';

    /*
     * Physical relationships.
     */

    public function ferment()
    {
        return $this->hasOne(Fermentation::class);
    }

    public function probe()
    {
        return $this->hasOne(Probe::class);
    }
}
