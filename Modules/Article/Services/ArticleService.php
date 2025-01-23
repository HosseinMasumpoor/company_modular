<?php

namespace Modules\Article\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Article\Repositories\ArticleSliderRepository;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\Media;
use Throwable;

class ArticleService
{
    use Media;
    protected string $imageFolder = 'articles';
    protected string $thumbnailFolder = 'articles/thumbnails';

    public function __construct(protected ArticleRepository $repository){}

    public function list(): Builder
    {
        return $this->repository->index();
    }

    public function store(array $data): bool
    {
        $sections = $data["sections"];
        unset($data["sections"]);

        $data["image"] = $this->storeFile($data["image"], $this->imageFolder);

        if (isset($data["thumbnail"])) {
            $data["thumbnail"] = $this->storeFile($data["thumbnail"], $this->thumbnailFolder);
        }

        try {
            DB::beginTransaction();
            $article = $this->repository->newItem($data);
            $this->repository->storeSections($article->id, $sections);
            DB::commit();
        } catch (Throwable) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function update(array $data, string $id): bool
    {
        if(isset($data["sections"])) {
            $sections = $data["sections"];
            unset($data["sections"]);
        }

        if (isset($data["image"])) {
            $data["image"] = $this->storeFile($data["image"], $this->imageFolder);
        }

        if (isset($data["thumbnail"])) {
            $data["thumbnail"] = $this->storeFile($data["thumbnail"], $this->thumbnailFolder);
            $this->removeFile($this->repository, $id, 'thumbnail', $this->thumbnailFolder);
        }

        try {
            DB::beginTransaction();
            $this->repository->updateItem($data, $id);
            if(isset($sections)){
                $this->repository->storeSections($id, $sections, true);
            }
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function delete(string $id): bool
    {
        $this->removeFile($this->repository, $id, 'image', $this->imageFolder);
        $this->removeFile($this->repository, $id, 'thumbnail', $this->thumbnailFolder);

        try {
            DB::beginTransaction();
            $sliderRepo = new ArticleSliderRepository();
            $sliderRepo->deleteByArticleId($id);
            $this->repository->remove($id);
            DB::commit();
        } catch (Throwable) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function getImage($id): array
    {
        return $this->getMedia($this->repository, $id, 'image', $this->imageFolder);
    }

    public function getThumbnail($id): array
    {
        return $this->getMedia($this->repository, $id, 'thumbnail', $this->imageFolder);
    }
}
