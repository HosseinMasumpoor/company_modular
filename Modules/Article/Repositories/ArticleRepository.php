<?php

namespace Modules\Article\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Article\Models\Article;
use Modules\Core\Repositories\Repository;

class ArticleRepository extends Repository
{
    public string|Model $model = Article::class;

    public function index(): Builder
    {
        return app(Pipeline::class)
            ->send(
                (new self)->query()
            )
            ->thenReturn()
            ->orderByDesc('created_at');
    }

    public function storeSections($id, $data, $hasSections = false): bool
    {
        $record = $this->findByField('id', $id);
        $result = true;
        if (!$hasSections) {
            $result &= $record->sections()->delete();
        }

        foreach ($data as $item) {
            $result &= (bool) $record->sections()->create($item);
        }

        return $result;
    }
}
