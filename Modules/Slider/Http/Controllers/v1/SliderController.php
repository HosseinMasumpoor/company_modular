<?php

namespace Modules\Slider\Http\Controllers\v1;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Slider\Enums\Type;
use Modules\Slider\Http\Requests\v1\StoreSlideRequest;
use Modules\Slider\Repositories\SlideRepository;
use Modules\Slider\Services\SliderService;

class SliderController extends CoreController
{
    public function __construct(private readonly SliderService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->service->list()->paginate(config('core.pagination_number'));
        return successResponse($data);
    }

    public function manageSlides(string $slider)
    {
        $slides = $this->service->listSlides($slider)->get();
        return successResponse(compact('slides', 'slider'));
    }

    public function storeSlide(StoreSlideRequest $request, string $id)
    {
        $slider = $this->service->getItem($id);
        if ($slider->type == Type::IMAGE) {
            $data = $request->validate([
                'title' => 'required|string|min:2|max:200',
                'image' => 'required|image|mimes:png,jpg,svg,webp|max:4000',
                'link' => 'nullable|url',
                'alt' => 'nullable|string',
            ]);
        } else {
            $data = $request->validate([
                'title' => 'required|string|min:2|max:200',
                'description' => 'required|string|min:2|max:300',
                'link' => 'nullable|url',
            ]);
        }

        $result = $this->service->storeSlide($id, $data);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    public function updateSlide(Request $request, string $id, SlideRepository $slideRepository)
    {
        $slider = $slideRepository->getSlider($id);

        if ($slider->type == Type::IMAGE) {
            $data = $request->validate([
                'title' => 'required|string|min:2|max:200',
                'image' => 'nullable|image|mimes:png,jpg,svg,webp|max:4000',
                'link' => 'nullable|url',
                'alt' => 'nullable|string',
            ]);
        } else {
            $data = $request->validate([
                'title' => 'required|string|min:2|max:200',
                'description' => 'required|string|min:2|max:300',
                'link' => 'nullable|url',
            ]);
        }

        $result = $this->service->updateSlide($data, $id);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }

        return failedResponse(__(self::ERROR_MESSAGE));
    }

    public function deleteSlide(string $id)
    {
        $result = $this->service->deleteSlide($id);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    public function changeSlideOrder(int $slideId, int $substituteId)
    {
        $result = $this->service->changeOrder($slideId, $substituteId);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        } else {
            return failedResponse(__(self::ERROR_MESSAGE));
        }
    }

    public function getImage(string $slideId)
    {
        $data = $this->service->getImage($slideId);
        return fileResponse($data);
    }
}
