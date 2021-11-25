<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Style extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'styles';

    /*
     * Physical relationships.
     */

    /**
     * Gets the style category of the style.
     *
     * @return BelongsTo
     */
    public function styleCategory(): BelongsTo
    {
        return $this->belongsTo(StyleCategory::class);
    }

    /**
     * Gets the recipes belonging to the style.
     *
     * @return HasMany
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

}
