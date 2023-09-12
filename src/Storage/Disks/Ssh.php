<?php

namespace CloudCastle\Storage\Disks;

use CloudCastle\Storage\Common\AbstractDisk;
use CloudCastle\Storage\StorageInterface;

final class Ssh extends AbstractDisk implements StorageInterface
{
    public static function getInstance(): self
    {
        return new self();
    }

    public function path(string $file): string
    {
        return '';
    }

    public function dirExist(string $dir): bool
    {
        return false;
    }

    public function mkDir(string $dir): bool
    {
        return false;
    }

    public function put(string $file, string $content): bool
    {
        return false;
    }

    public function fileExist(string $path): bool
    {
        return false;
    }

    public function get(string $path): array|string|false
    {
        return false;
    }

    public function rm(string $path): bool
    {
        return false;
    }
}