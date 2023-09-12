<?php

namespace CloudCastle\Storage\Disks;

use CloudCastle\Storage\Common\AbstractDisk;
use CloudCastle\Storage\StorageInterface;

/**
 *
 */
final class Local extends AbstractDisk implements StorageInterface
{
    public static function getInstance(): self
    {
        return new self();
    }

    public function path(string $file): string
    {
        return realpath($file);
    }

    public function put(string $file, string $content): bool
    {
        $realPath = $this->path($file);

        if ($this->mkDir(dirname($realPath))) {
            return file_put_contents($realPath, $content);
        }

        return false;
    }

    public function mkDir(string $dir): bool
    {
        return $this->dirExist($dir) || mkdir($dir, 0777, true) || is_dir($dir);
    }

    public function dirExist(string $dir): bool
    {
        return is_dir($this->path($dir));
    }

    public function fileExist(string $path): bool
    {
        return file_exists($this->path($path));
    }

    public function get(string $path): array|string|false
    {
        $path = $this->path($path);

        if (is_file($path)) {
            return file_get_contents($path);
        }

        if (is_dir($path)) {
            return $this->getDirContent($path);
        }

        return false;
    }

    private function getDirContent(string $path): array
    {
        $data = [];
        $files = scandir($this->path($path));

        foreach ($files as $file){
            if(!in_array($file, ['.', '..'])){
                $data[] = $this->path($path . DIRECTORY_SEPARATOR. $file);
            }
        }

        return $data;
    }

    public function rm(string $path): bool
    {
        $realPath = $this->path($path);

        if($this->fileExist($realPath)){
            return unlink($realPath);
        }

        if($this->dirExist($realPath)){
            return rmdir($realPath);
        }

        return false;
    }
}