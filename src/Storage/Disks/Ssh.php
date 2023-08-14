<?php

namespace CloudCastle\Storage\Disks;

use CloudCastle\Storage\Common\AbstractDisk;
use CloudCastle\Storage\StorageInterface;

final class Ssh extends AbstractDisk implements StorageInterface
{
    /**
     * @param string $file
     * @return string
     */
    public function path(string $file): string
    {
        // TODO: Implement path() method.
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function checkDir(string $dir): bool
    {
        // TODO: Implement checkDir() method.
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function mkDir(string $dir): bool
    {
        // TODO: Implement mkDir() method.
    }

    /**
     * @param string $file
     * @param string $content
     * @return bool
     */
    public function put(string $file, string $content): bool
    {
        // TODO: Implement put() method.
    }
}