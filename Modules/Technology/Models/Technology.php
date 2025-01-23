<?php

namespace Modules\Technology\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $table = 'technologies';
    protected $appends = ['iconUrl'];
    protected $fillable = [
        'name',
        'icon'
    ];


    /**
     * Relations
     */

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * Accessors
     */

    public function getIconUrlAttribute()
    {
        return  "technology/media/icon/" . $this->id;
    }
}
