<?php

namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSlider extends Model
{
    protected $appends = [
        'article'
    ];
    protected $table = 'article_sliders';
    protected $guarded = [];


    /**
     * Relations
     */

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function articleWithLocale()
    {

        return $this->article()->where('locale', app()->getLocale());
    }

    /**
     * Accessors
     */
    public function getArticleAttribute()
    {
        return $this->article()->first();
    }

    /**
     * Scopes
     */

    public function scopeLastOrder($query)
    {
        return $query->orderBy('order', 'desc')->first()->order ?? 0;
    }
}
