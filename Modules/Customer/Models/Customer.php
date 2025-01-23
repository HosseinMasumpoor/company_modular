<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    protected $appends = ['imageUrl'];
    protected $table = 'customers';

    /**
     * Accessors
     */
    public function getImageUrlAttribute(): string
    {
        return "customer/media/image/" . $this->id;
    }
}
