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
        return self::$instance[self::class] ?? (self::$instance[self::class] = new self());
    }

    public function path(string $file): string
    {
        if (file_exists($file)) {
            return realpath($file);
        }

        return dirname($file) . DIRECTORY_SEPARATOR . basename($file);
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
        $dir = $this->path($dir);

        if($this->isDir($dir)){
            return true;
        }

        if(mkdir($dir, 0777, true) && $this->isDir($dir)){
            return true;
        }

        return false;
    }

    public function isDir(string $dir): bool
    {
        return is_dir($this->path($dir));
    }

    public function isFile(string $path): bool
    {
        return is_file($this->path($path));
    }

    public function get(string $path): array|string|false
    {
        $path = $this->path($path);

        if ($this->isFile($path)) {
            return file_get_contents($path);
        }

        if ($this->isDir($path)) {
            return $this->scanDir($path);
        }

        return false;
    }

    public function scanDir(string $path): array
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

        if ($this->isFile($realPath)) {
            return unlink($realPath);
        }

        if ($this->isDir($realPath)) {
            return rmdir($realPath);
        }

        return false;
    }
}