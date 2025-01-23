<?php

namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSection extends Model
{
    protected $table = 'article_sections';
    protected $fillable = [
        'title',
        'article_id',
        'body',
    ];

    /**
     * Relations
     */

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
