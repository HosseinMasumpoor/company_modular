<?php

namespace Modules\Core\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{

    public static function AddFileStorage($path, $file): bool
    {
        return  Storage::put($path, $file);
    }

    public static function RemoveFileStorage($path): bool
    {
        return   Storage::delete($path);
    }

    public static function GetFileStorage($path): ?string
    {
        return  Storage::get($path);
    }


    public static function DownloadFileStorage($path): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        return Storage::download($path);
    }
}
