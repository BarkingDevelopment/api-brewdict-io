<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class StyleCategory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'style_categories';

    /*
     * Physical relationships.
     */

    /**
     * Gets the styles belonging to the category.
     *
     * @return BelongsTo
     */
    public function styles()
    {
        return $this->belongsTo(Style::class);
    }

    /**
     * Gets all the recipes belonging to the style category.
     *
     * @return HasManyThrough
     */
    public function recipes()
    {
        return $this->hasManyThrough(Recipe::class, Style::class);
    }
}
