<?php

namespace Modules\Experience\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;
use Modules\Experience\Models\Experience;

class ExperienceRepository extends Repository
{
    public string|Model $model = Experience::class;

    public function index(): Builder
    {
        return app(Pipeline::class)
            ->send(
                $this->query()
            )
            ->thenReturn()
            ->orderByDesc('created_at');
    }
}
