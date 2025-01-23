<?php

namespace Modules\Core\Traits;

use Illuminate\Support\Facades\Storage;
use Modules\Core\Interfaces\RepositoryInterface;
use Modules\Core\Services\StorageService;

trait Media
{
    private function storeFile($img, $folder): string
    {
        $fileName = $img->hashName();
        $full_path = $folder . '/' . $fileName;
        StorageService::AddFileStorage($full_path, $img);
        return $fileName;
    }

    private function removeFile(RepositoryInterface $repository, $id, $fieldName, $folder): void
    {
        $data = $repository->findByField("id", $id);
        if ($data->$fieldName) {
            StorageService::RemoveFileStorage($folder . "/" . $data->$fieldName);
        }
    }
    private function getMedia(RepositoryInterface $repository, $id, $fieldName, $folder): array
    {
        $data = $repository->findByField("id", $id);
        $path = $folder . "/" . $data->$fieldName . "/" . $data->$fieldName;
        return $this->getStoreFileAndType($path);
    }

    private function getStoreFileAndType($path): array
    {
        $file = StorageService::GetFileStorage($path);
        $type = Storage::mimeType($path);
        return ["file" => $file, "type" => $type];
    }
}
