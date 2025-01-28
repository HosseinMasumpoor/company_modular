<?php

namespace Modules\Partner\Observers;


use Modules\Article\Cache\ArticleCache;
use Modules\Partner\Cache\PartnerCache;

class PartnerObserver
{
    public function created (): void
    {
        $this->cacheData();
    }

    public function updated (): void
    {
        $this->cacheData();
    }

    public function deleted (): void
    {
        $this->cacheData();
    }

    /**
     * @return void
     */
    private function cacheData(): void
    {
        PartnerCache::setAllPartners();
    }
}
