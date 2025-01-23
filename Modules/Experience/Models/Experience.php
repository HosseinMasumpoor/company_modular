<?php

namespace Modules\Experience\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $appends = ['imageUrl'];
    protected $guarded = [];



    /**
     * Accessors
     */

    public function getImageUrlAttribute()
    {
        return 'experience/media/image/' . $this->id;
    }


    /**
     * Scopes
     */

    public function scopeLocale($query, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $query->where('locale', $locale);
    }
}
