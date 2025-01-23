<?php

namespace Modules\Service\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Sluggable;
    protected $appends = ['iconUrl', 'imageUrl'];
    protected $guarded = [];


    /**
     * Accessors
     */

    public function getIconUrlAttribute()
    {
        return  "service/media/icon/" . $this->id;
    }

    public function getImageUrlAttribute()
    {
        return  "service/media/image/" . $this->id;
    }


    /**
     * Scopes
     */

    public function scopeLastOrder($query)
    {
        return $query->orderBy('order', 'desc')->first()->order ?? 0;
    }

    public function scopeLocale($query, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $query->where('locale', $locale);
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
