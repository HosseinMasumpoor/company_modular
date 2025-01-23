<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectTechnology extends Pivot
{
    protected $table = 'project_technology';
    protected $fillable = [
        'project_id',
        'technology_id',
        'order',
    ];
}
