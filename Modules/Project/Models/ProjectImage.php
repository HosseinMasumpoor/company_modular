<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    protected $table = 'project_images';
    protected $appends = ['srcUrl'];
    protected $fillable = [
        'project_id',
        'src',
        'order'
    ];


    /**
     * Relations
     */

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }


    /**
     * Accessors
     */

    public function getSrcUrlAttribute(): string
    {
        return  "project/media/gallery/image/" . $this->id;
    }

    /**
     * Scopes
     */

    public function scopeLastOrder($query, $projectId)
    {
        return $query->where('project_id', $projectId)->orderBy('order', 'desc')->first()->order ?? 0;
    }
}
