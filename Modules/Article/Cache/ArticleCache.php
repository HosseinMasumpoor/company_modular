<?php

namespace Modules\Article\Cache;

use Illuminate\Support\Facades\Cache;
use Modules\Article\Repositories\ArticleRepository;

class ArticleCache
{
    const LIST_CACHE_KEY = 'articles:list';
    const TOP_CACHE_KEY = 'articles:top';
    public static function getAllArticles()
    {
        if(!Cache::has(self::LIST_CACHE_KEY)){
            self::setAllArticles();
        }
        return Cache::get(self::LIST_CACHE_KEY);
    }

    public static function setAllArticles(): bool
    {
        $repository = app(ArticleRepository::class);
        $data = $repository->index()->get();
        return Cache::put(self::LIST_CACHE_KEY, $data);
    }

    public static function getTopArticles()
    {
        if(!Cache::has(self::TOP_CACHE_KEY)){
            self::setTopArticles();
        }
        return Cache::get(self::TOP_CACHE_KEY);
    }

    public static function setTopArticles(): bool
    {
        $repository = app(ArticleRepository::class);
        $data = $repository->index()->latest()->take(8)->get();
        return Cache::put(self::TOP_CACHE_KEY, $data);
    }

}
