<?php

namespace App\Models;

use App\Enums\RecipeState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recipe extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recipes';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'owner_id',
        'inspiration_id',
        'style_id',
        'og',
        'fg',
        'ibu',
        'srm',
    ];

    /*
     * Physical relationships.
     */

    /**
     * Gets the recipe this recipe is based off of.
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Recipe::class, "inspiration_id");
    }

    /**
     * Gets the style of the recipe.
     *
     * @return BelongsTo
     */
    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    /**
     * Gets the owner of the recipe.
     *
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    /**
     * Gets the fermentations created from this recipe.
     *
     * @return HasMany
     */
    public function fermentations()
    {
        return $this->hasMany(Fermentation::class);
    }

    /*
     * Functions
     */

    /**
     * Returns true if the recipe is private or not.
     *
     * @return bool
     */
    public function isPrivate()
    {
        return $this->state == RecipeState::Draft || $this->state == RecipeState::Private;
    }
}
