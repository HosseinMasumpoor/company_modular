<?php

namespace Modules\Project\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectCategory extends Pivot
{
    protected $table = 'project_category';
}
