<?php

namespace Modules\Article\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use  Sluggable;
    protected $appends = ['imageUrl', 'thumbnailUrl'];
    protected $guarded = [];

    /**
     * Relations
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function sections()
    {
        return $this->hasMany(ArticleSection::class);
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function articleSlider()
    {
        return $this->hasOne(ArticleSlider::class);
    }

    public function rootComments()
    {
        return $this->comments()->whereNull('parent_id');
    }


    /**
     * Scopes
     */

    public function scopeLocale($query, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $query->where('locale', $locale);
    }



    /**
     * Accessors
     */
    public function getAltAttribute()
    {
        return $this->attributes["alt"] ?? $this->attributes["title"];
    }

    public function getImageUrlAttribute()
    {
        return  "article/media/image/" . $this->id;
    }

    public function getThumbnailUrlAttribute()
    {
        return  "article/media/thumbnail/" . $this->id;
    }


    public function getRateAttribute()
    {
        return $this->rates()->average('rate');
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
