<?php

namespace Modules\Slider\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slide extends Model
{

    protected $guarded = [];


    /**
     * Relations
     */

    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }


    /**
     * Scopes
     */

    public function scopeLastOrder($query, int $sliderId) : int
    {
        return $query->where('slider_id', $sliderId)->max('order') ?? 0;
    }
}
