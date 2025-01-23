<?php

namespace Modules\Article\Http\Controllers\v1;

use Modules\Article\Http\Requests\v1\Article\StoreArticleRequest;
use Modules\Article\Http\Requests\v1\Article\UpdateArticleRequest;
use Modules\Article\Services\ArticleService;
use Modules\Core\Http\Controllers\CoreController;

class ArticleController extends CoreController
{
    public function __construct(private readonly ArticleService $service) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = $this->service->list()->paginate(config('core.pagination_number'));
        return successResponse($articles);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $result = $this->service->store($request->validated());

        if ($result) {
            return successResponse([], __(self::SUCCESS_MESSAGE));
        }
        return failedResponse(__(self::ERROR_MESSAGE));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, string $id)
    {
        $result = $this->service->update($request->validated(), $id);
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

    public function getImage($id)
    {
        $data = $this->service->getImage($id);
        return fileResponse($data);
    }

    public function getThumbnail($id)
    {
        $data = $this->service->getThumbnail($id);
        return fileResponse($data);
    }

//    public function rate(StoreRateRequest $request, string $articleId)
//    {
//        $userId = $request->cookie('user_id');
//        $userIp = $request->ip();
//
//        if (!$userId) {
//            $userId = (string) Str::uuid();
//            $response = new Response();
//            $response->withCookie(cookie('user_id', $userId, 1440));
//        }
//
//        $result = RateService::store($request->rate, $article, $userId, $userIp);
//        if ($result)
//            return redirect()->back()->with('success', __(self::SUCCESS_MESSAGE));
//        return redirect()->back()->with('error', __(self::ERROR_MESSAGE));
//    }
}
