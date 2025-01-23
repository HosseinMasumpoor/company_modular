<?php

namespace Modules\Project\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Core\Traits\Media;
use Modules\Project\Repositories\ProjectRepository;
use Throwable;

class ProjectService
{
    use Media;
    private string $presentationFolder = 'projects/presentation';
    private string $imageFolder = 'projects';

    public function __construct(protected ProjectRepository $repository)
    {
    }

    public function list(): Builder
    {
        return $this->repository->index();
    }

    public function add(array $data): bool
    {
        if (isset($data["presentation_file"])) {
            $presentationFile = $data["presentation_file"];
            $data['presentation_file'] = $this->storeFile($presentationFile, $this->presentationFolder);
        }

        if (isset($data["image"])) {
            $image = $data["image"];
            $data['image'] = $this->storeFile($image, $this->imageFolder);
        }

        $data["meta_tags"] = metaTagStructure($data["meta_tags"]);
        $categories = $data["categories"];
        unset($data["categories"]);

        $technologies = $data["technologies"];
        unset($data["technologies"]);

        try {
            DB::beginTransaction();
            $project = $this->repository->newItem($data);
            $this->repository->syncCategories($project->id, $categories);
            $this->repository->syncTechnologies($project->id, $technologies);
            DB::commit();
            return true;
        } catch (Throwable $th) {
            DB::rollBack();
            dd($th->getMessage(), $th->getFile(), $th->getLine());
            return false;
        }
    }

    public function update(array $data, int $id): bool
    {
        $data["meta_tags"] = metaTagStructure($data["meta_tags"]);

        if (isset($data["image"])) {
            $this->removeFile($this->repository, $id, 'image', $this->imageFolder);
            $data["image"] = $this->storeFile($data["image"], $this->imageFolder);
        }

        if (isset($data["presentation_file"])) {
            $this->removeFile($this->repository, $id, 'presentation_file', $this->presentationFolder);
            $data["presentation_file"] = $this->storeFile($data["presentation_file"], $this->presentationFolder);
        }

        $categories = $data["categories"];
        unset($data["categories"]);

        $technologies = $data["technologies"];
        unset($data["technologies"]);

        try {
            DB::beginTransaction();
            $this->repository->updateItem($data, $id);
            $this->repository->syncCategories($id, $categories);
            $this->repository->syncTechnologies($id, $technologies);
            DB::commit();
            return true;
        } catch (Throwable) {
            DB::rollBack();
            return false;
        }
    }

     public function related(string $id, int $limit = 6): Builder
     {
        $project = $this->repository->findByField('id', $id);
         request()->merge([
             'category' => $project->category_id,
             'title' => $project->title,
             'summary' => $project->summary,
             'random' => 'random',
         ]);

         return $this->repository->related($id, $limit);
     }

    public function delete(string $id): bool
    {
        $this->removeFile($this->repository, $id, 'image', $this->imageFolder);
        $this->removeFile($this->repository, $id, 'presentation_file', $this->presentationFolder);
        return $this->repository->remove($id);
    }

    public function getImage($id): array
    {
        return $this->getMedia($this->repository, $id, 'image', $this->imageFolder);
    }

    public function getPresentationFile($id): array
    {
        return $this->getMedia($this->repository, $id, 'presentation_file', $this->imageFolder);
    }
}
