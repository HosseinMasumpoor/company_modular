<?php

namespace Modules\Technology\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;
use Modules\Technology\Models\Technology;

class TechnologyRepository extends Repository
{
    public string|Model $model = Technology::class;
}
