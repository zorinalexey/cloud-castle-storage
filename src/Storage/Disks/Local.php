<?php

namespace CloudCastle\Storage\Disks;

use CloudCastle\Storage\Common\AbstractDisk;
use CloudCastle\Storage\StorageInterface;

/**
 *
 */
final class Local extends AbstractDisk implements StorageInterface
{
    public function path(string $file): string
    {
        return realpath($file);
    }

    public function put(string $file, string $content): bool
    {
        if ($this->mkDir(dirname($file))) {
            return file_put_contents($file, $content);
        }

        return false;
    }

    public function mkDir(string $dir): bool
    {
        return $this->dirExist($dir) || mkdir($dir, 0777, true) || is_dir($dir);
    }

    public function dirExist(string $dir): bool
    {
        return is_dir($dir);
    }

    public function fileExist(string $path): bool
    {
        return file_exists($path);
    }

    public function get(string $path): array|string|false
    {
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
        return [];
    }
}