<?php

namespace Modules\Project\Cache;

use Illuminate\Support\Facades\Cache;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Project\Repositories\ProjectRepository;

class ProjectCache
{
    const LIST_CACHE_KEY = 'projects:list';
    const TOP_CACHE_KEY = 'projects:top';

    public static function getAllProjects()
    {
        if(!Cache::has(self::LIST_CACHE_KEY)){
            self::setAllProjects();
        }
        return Cache::get(self::LIST_CACHE_KEY);
    }

    public static function setAllProjects(): bool
    {
        $repository = app(ArticleRepository::class);
        $data = $repository->index()->get();
        return Cache::put(self::LIST_CACHE_KEY, $data);
    }

    public static function getTopProjects()
    {
        if(!Cache::has(self::TOP_CACHE_KEY)){
            self::setTopProjects();
        }
        return Cache::get(self::TOP_CACHE_KEY);
    }

    public static function setTopProjects(): bool
    {
        $repository = app(ProjectRepository::class);
        $data = $repository->index()->latest()->take(8)->get();
        return Cache::put(self::TOP_CACHE_KEY, $data);
    }

}
