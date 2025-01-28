<?php

namespace Modules\Project\Observers;


use Modules\Article\Cache\ArticleCache;
use Modules\Project\Cache\ProjectCache;

class ProjectObserver
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
        ProjectCache::setTopProjects();
        ProjectCache::setAllProjects();
    }
}
