<?php

namespace Modules\Project\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Models\Category;
use Modules\Technology\Models\Technology;

class Project extends Model
{
    use Sluggable, SoftDeletes;
    protected $appends = ['imageUrl'];

    protected $guarded = [];


    /**
     * Relations
     */

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'project_category');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProjectFeature::class);
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }


    /**
     * Scopes
     */

    public function scopeLocale($query, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $query->where('locale', $locale);
    }


    /**
     * Accessors
     */

    public function getImageUrlAttribute(): string
    {
        return 'project/media/image/' . $this->id;
    }

    public function getPresentationFileUrlAttribute(): string
    {
        return 'project/media/presentation/' . $this->id;
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
