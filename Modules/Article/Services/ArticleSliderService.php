<?php

namespace Modules\Article\Services;

use Modules\Article\Repositories\ArticleSliderRepository;
use Illuminate\Support\Facades\DB;

class ArticleSliderService
{
    public function __construct(protected ArticleSliderRepository $repository){}

    public function list(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->repository->index();
    }

    public function store(array $data): bool
    {
        return (bool) $this->repository->newItem($data);
    }

    public function delete(string $id): bool
    {
        return $this->repository->remove($id);
    }

    public function changeOrder(string $id, string $substituteId): bool
    {
        $substituteOrder = ArticleSliderRepository::FindByField('id', $substituteId)->order;
        $itemOrder = ArticleSliderRepository::FindByField('id', $id)->order;
        try {
            DB::beginTransaction();
            ArticleSliderRepository::UpdateItem([
                'order' => $itemOrder
            ], $substituteId);

            ArticleSliderRepository::UpdateItem([
                'order' => $substituteOrder,
            ], $id);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
}
