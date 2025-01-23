<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFeature extends Model
{
    protected $table = 'project_features';
    protected $fillable = [
        'name',
        'order',
        'project_id',
    ];


    /**
     * Relations
     */

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }


    /**
     * Scopes
     */

    public function scopeLastOrder($query, $projectId)
    {
        return $query->where('project_id', $projectId)->orderBy('order', 'desc')->first()->order ?? 0;
    }
}
