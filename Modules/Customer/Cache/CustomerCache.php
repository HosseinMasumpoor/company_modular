<?php

namespace Modules\Customer\Cache;

use Illuminate\Support\Facades\Cache;
use Modules\Customer\Repositories\CustomerRepository;
use Modules\Experience\Repositories\ExperienceRepository;

class CustomerCache
{
    const LIST_CACHE_KEY = 'customers:list';

    public static function getAllCustomers()
    {
        if(!Cache::has(self::LIST_CACHE_KEY)){
            self::setAllCustomers();
        }
        return Cache::get(self::LIST_CACHE_KEY);
    }

    public static function setAllCustomers(): bool
    {
        $repository = app(CustomerRepository::class);
        $data = $repository->index()->get();
        return Cache::put(self::LIST_CACHE_KEY, $data);
    }

}
