<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'equipment';

    /**
     * Gets all the readings the probes have recording over the fermentation duration.
     *
     * @return HasMany
     */
    public function readings()
    {
        return $this->hasMany(Fermentation::class);
    }
}
