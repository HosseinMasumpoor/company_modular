<?php

namespace Modules\Partner\Cache;

use Illuminate\Support\Facades\Cache;
use Modules\Partner\Repositories\PartnerRepository;

class PartnerCache
{
    const LIST_CACHE_KEY = 'partners:list';

    public static function getAllPartners()
    {
        if(!Cache::has(self::LIST_CACHE_KEY)){
            self::setAllPartners();
        }
        return Cache::get(self::LIST_CACHE_KEY);
    }

    public static function setAllPartners(): bool
    {
        $repository = app(PartnerRepository::class);
        $data = $repository->index()->get();
        return Cache::put(self::LIST_CACHE_KEY, $data);
    }

}
