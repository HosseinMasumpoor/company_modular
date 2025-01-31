<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTech extends Model
{
    protected $appends = ['iconUrl'];
    protected $table = 'project_teches';
    protected $fillable = [
        'icon',
        'name',
        'order',
        'project_id',
    ];


    /**
     * Realtions
     */

    public function project()
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


    /**
     * Accessors
     */

    public function getIconUrlAttribute()
    {
        return asset('storage/' . env('PROJECT_TECH_ICON_PATH') . '/' . $this->attributes["icon"]);
    }
}
