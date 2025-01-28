<?php

namespace Modules\Experience\Observers;


use Modules\Experience\Cache\ExperienceCache;

class ExperienceObserver
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
        ExperienceCache::setAllExperiences();
    }
}
