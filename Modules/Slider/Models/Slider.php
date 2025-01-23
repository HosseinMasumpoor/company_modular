<?php

namespace Modules\Slider\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slider extends Model
{
    protected $guarded = [];


    /**
     * Relations
     */

    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class);
    }
}
