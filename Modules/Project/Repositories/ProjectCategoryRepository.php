<?php

namespace Modules\Project\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Repositories\Repository;
use Modules\Project\Models\ProjectCategory;
use Illuminate\Pipeline\Pipeline;

class ProjectCategoryRepository extends Repository
{
    public string|Model $model = ProjectCategory::class;

    public function index(): Builder
    {
        return app(Pipeline::class)
            ->send(
                (new self)->query()

            )
            ->thenReturn()
            ->orderByDesc('created_at');
    }
}
