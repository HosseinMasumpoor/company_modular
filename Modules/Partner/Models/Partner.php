<?php

namespace Modules\Partner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{

    protected $appends = ['imageUrl'];
    protected $guarded = [];


    /**
     * Accessors
     */
    public function getImageUrlAttribute(): string
    {
        return  "partner/media/image/" . $this->id;
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
}
