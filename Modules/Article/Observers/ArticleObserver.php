<?php

namespace Modules\Article\Observers;


use Modules\Article\Cache\ArticleCache;

class ArticleObserver
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
        ArticleCache::setTopArticles();
        ArticleCache::setAllArticles();
    }
}
