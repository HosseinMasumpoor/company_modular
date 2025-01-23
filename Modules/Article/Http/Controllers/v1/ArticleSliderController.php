<?php

namespace Modules\Article\Http\Controllers\v1;

use Modules\Article\Http\Requests\v1\ArticleSlider\StoreArticleSlideRequest;
use Modules\Article\Services\ArticleSliderService;
use Modules\Core\Http\Controllers\CoreController;

class ArticleSliderController extends CoreController
{
    public function __construct(private readonly ArticleSliderService $service) {}

    public function index()
    {
        $slides = $this->service->list()->paginate(config('core.pagination_number'));
        return successResponse($slides);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleSlideRequest $request)
    {
        $data = $request->validated();

        $result = $this->service->store($data);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }
        return failedResponse(__(self::ERROR_MESSAGE));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }
        return failedResponse(__(self::ERROR_MESSAGE));
    }

    public function changeOrder(string $id, string $substitute)
    {
        $result = $this->service->changeOrder($id, $substitute);
        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }
        return failedResponse(__(self::ERROR_MESSAGE));
    }
}
