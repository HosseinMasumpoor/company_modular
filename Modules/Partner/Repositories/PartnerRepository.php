<?php

namespace Modules\Partner\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;
use Modules\Partner\Models\Partner;

class PartnerRepository extends Repository
{
    public string|Model $model = Partner::class;

    public function newItem($data): Model
    {
        $data["order"] = Partner::lastOrder() + 1;
        return parent::newItem($data);
    }

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
