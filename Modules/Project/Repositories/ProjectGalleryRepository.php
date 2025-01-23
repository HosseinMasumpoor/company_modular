<?php

namespace Modules\Project\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Repositories\Repository;
use Modules\Project\Models\ProjectImage;
use Illuminate\Pipeline\Pipeline;

class ProjectGalleryRepository extends Repository
{
    public string|Model $model = ProjectImage::class;

    public function index(): Builder
    {
        return app(Pipeline::class)
            ->send(
                $this->query()
            )
            ->thenReturn()
            ->orderByDesc('created_at');
    }

    public static function getLastOrder($projectId)
    {
        return ProjectImage::lastOrder($projectId) + 1;
    }
}
