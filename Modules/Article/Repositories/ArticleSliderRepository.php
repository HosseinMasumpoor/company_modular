<?php

namespace Modules\Article\Repositories;

use Modules\Article\Models\ArticleSlider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;

class ArticleSliderRepository extends Repository
{
    public string|Model $model = ArticleSlider::class;

    public function newItem($data): \Illuminate\Database\Eloquent\Model
    {
        $data["order"] = ArticleSlider::lastOrder() + 1;
        return  ArticleSlider::create($data);
    }

    public function index(): \Illuminate\Database\Eloquent\Builder
    {
        return app(Pipeline::class)
            ->send(
                (new self)->query()
            )
            ->thenReturn()
            ->orderByDesc('created_at');
    }

    public function deleteByArticleId(string $articleId)
    {
        return ArticleSlider::where('article_id', $articleId)->delete();
    }
}
