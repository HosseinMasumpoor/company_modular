<?php

namespace Modules\Project\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;
use Modules\Project\Models\ProjectTechnology;

class ProjectTechnologyRepository extends Repository
{
    public string|Model $model = ProjectTechnology::class;

    public function index(): Builder
    {
        return app(Pipeline::class)
            ->send(
                $this->query()

            )
            ->through()
            ->thenReturn()
            ->orderByDesc('created_at');
    }
}
