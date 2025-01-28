<?php

namespace Modules\Experience\Cache;

use Illuminate\Support\Facades\Cache;
use Modules\Experience\Repositories\ExperienceRepository;

class ExperienceCache
{
    const LIST_CACHE_KEY = 'experiences:list';

    public static function getAllExperiences()
    {
        if(!Cache::has(self::LIST_CACHE_KEY)){
            self::setAllExperiences();
        }
        return Cache::get(self::LIST_CACHE_KEY);
    }

    public static function setAllExperiences(): bool
    {
        $repository = app(ExperienceRepository::class);
        $data = $repository->index()->get();
        return Cache::put(self::LIST_CACHE_KEY, $data);
    }

}
