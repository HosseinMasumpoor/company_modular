<?php

namespace Modules\Slider\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\Media;
use Modules\Slider\Enums\Type;
use Modules\Slider\Repositories\SlideRepository;
use Modules\Slider\Repositories\SliderRepository;


class SliderService
{
    use Media;

    private string $imageFolder = 'sliders';

    public function __construct(protected SliderRepository $repository, protected SlideRepository $slideRepository)
    {
    }

    public function list(): Builder
    {
        return $this->repository->index();
    }

    public function getByLocation(string $location, $limit = null, string $locale = null)
    {
        return $this->repository->getSlidesByLocation($location, $limit, $locale);
    }

    public function getItem(string $id): ?Model
    {
        return $this->repository->findByField('id', $id);
    }

    public function listSlides(string $sliderId)
    {
        return $this->repository->getSlides($sliderId)->orderBy('order');
    }

    public function storeSlide(string $sliderId, array $data): Model
    {
        $slider = $this->repository->findByField('id', $sliderId);
        if($slider->type == Type::IMAGE){
            $data["image"] = $this->storeFile($data["image"], $this->imageFolder);
        }

        $data["slider_id"] = $sliderId;
        return $this->slideRepository->newItem($data);
    }

    public function updateSlide(array $data, $id): bool
    {
        if(isset($data["image"])){
            $data["image"] = $this->storeFile($data["image"], $this->imageFolder);
            $this->removeFile($this->slideRepository, $id, 'image', $this->imageFolder);
        }
        return $this->slideRepository->updateItem($data, $id);
    }

    public function deleteSlide(string $id): bool
    {
        $slider = $this->slideRepository->getSlider($id);
        if($slider->type == Type::IMAGE){
            $this->removeFile($this->slideRepository, $id, 'image', $this->imageFolder);
        }
        return $this->slideRepository->remove($id);
    }


    public function changeOrder(int $slideId, int $substituteId): bool
    {
        $slideOrder = $this->slideRepository->findByField('id', $slideId)->order;
        $substituteOrder = $this->slideRepository->findByField('id', $substituteId)->order;
        try {
            DB::beginTransaction();
            $this->slideRepository->updateItem([
                'order' => $substituteOrder
            ], $slideId);

            $this->slideRepository->updateItem([
                'order' => $slideOrder
            ], $substituteId);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function getImage($id): array
    {
        return $this->getMedia($this->slideRepository, $id, 'image', $this->imageFolder);
    }
}
