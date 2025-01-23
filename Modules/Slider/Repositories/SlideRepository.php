<?php

namespace Modules\Slider\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Modules\Core\Repositories\Repository;
use Modules\Slider\Models\Slide;

class SlideRepository extends Repository
{
    public string|Model $model = Slide::class;


    public function newItem($data): Model
    {
        $data["order"] = Slide::lastOrder($data["slider_id"]) + 1;

        return  $this->model::create($data);
    }

    public function Index(): Builder
    {
        return app(Pipeline::class)
            ->send(
                (new self)->query()
            )
            ->thenReturn()
            ->orderByDesc('created_at');
    }

    public function getSlider($id){
        $slide = $this->findByField('id', $id);
        return $slide->slider;
    }
}
