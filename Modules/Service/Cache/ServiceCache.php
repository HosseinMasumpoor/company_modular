<?php

namespace Modules\Service\Cache;

use Illuminate\Support\Facades\Cache;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Project\Repositories\ProjectRepository;

class ServiceCache
{
    const LIST_CACHE_KEY = 'services:list';

    public static function getAllServices()
    {
        if(!Cache::has(self::LIST_CACHE_KEY)){
            self::setAllServices();
        }
        return Cache::get(self::LIST_CACHE_KEY);
    }

    public static function setAllServices(): bool
    {
        $repository = app(ArticleRepository::class);
        $data = $repository->index()->get();
        return Cache::put(self::LIST_CACHE_KEY, $data);
    }

}
