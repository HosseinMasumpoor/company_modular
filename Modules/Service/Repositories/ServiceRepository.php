<?php

namespace Modules\Service\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;
use Modules\Service\Models\Service;

class ServiceRepository extends Repository
{
    public string|Model $model = Service::class;

    public function newItem($data): Model
    {
        $data["order"] = (int) Service::lastOrder() + 1;
        return parent::newItem($data);
    }

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
