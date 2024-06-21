<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UploadsFile
{
    use systemLog;

    protected $baseDisk = 'public';

    protected $baseFolder = 'uploads';

    protected $imagePath = 'images';

    protected function StorageDisk()
    {
        return Storage::disk($this->baseDisk);
    }

    protected function uploadFile($file, $folder = null, $disk = null)
    {
        $disk = $disk ?? $this->baseDisk;
        $folder = $folder ?? $this->baseFolder;

        $path = $file->store($folder, $disk);

        return $path;
    }

    protected function uploadImage($file, $folder = null, $disk = null)
    {
        $disk = $disk ?? $this->baseDisk;
        $folder = $folder ?? $this->baseFolder;

        $path = $file->store($folder, $disk);

        return $path;
    }

    protected function deleteFile($path, $disk = null)
    {
        $disk = $disk ?? $this->baseDisk;

        if ($this->StorageDisk()->exists($path)) {
            $this->StorageDisk()->delete($path);
        }
    }

    protected function deleteImage($path, $disk = null)
    {
        $disk = $disk ?? $this->baseDisk;

        if ($this->StorageDisk()->exists($path)) {
            $this->StorageDisk()->delete($path);
        }
    }

    protected function putFile($path, $content, $disk = null)
    {
        $disk = $disk ?? $this->baseDisk;

        $this->StorageDisk()->put($path, $content);
    }

    protected function putImage($path, $content, $disk = null)
    {
        $disk = $disk ?? $this->baseDisk;

        $this->StorageDisk()->put($path, $content);
    }
}