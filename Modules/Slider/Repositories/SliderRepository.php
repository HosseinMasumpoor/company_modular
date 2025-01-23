<?php

namespace Modules\Slider\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;
use Modules\Slider\Models\Slider;

class SliderRepository extends Repository
{
    public string|Model $model = Slider::class;

    public function getSlidesByLocation(string $location, $limit = null, string $locale = null)
    {
        $sliderQuery = $this->query();
        if ($locale) {
            $sliderQuery->where('locale', $locale);
        }
        $slider =  $sliderQuery->where('location', $location)->first();
        if ($slider) {
            $slides = $limit ? $slider->slides()->take($limit)->get() : $slider->slides;
        } else {
            $slides = null;
        }
        return $slides;
    }

    public function getSlides(string $sliderId)
    {
        $slider = $this->findByField('id', $sliderId);
        return $slider->slides();
    }


    public function index(): Builder
    {
        return app(Pipeline::class)
            ->send(
                $this->query()
            )
            ->thenReturn()
            ->orderByDesc('created_at');
    }
}
