<?php

namespace CloudCastle\Storage\Disks;

use CloudCastle\Storage\Common\AbstractDisk;
use CloudCastle\Storage\StorageInterface;

class GoogleDrive extends AbstractDisk implements StorageInterface
{

    /**
     * @inheritDoc
     */
    public function path(string $file): string
    {
        // TODO: Implement path() method.
    }

    /**
     * @inheritDoc
     */
    public function checkDir(string $dir): bool
    {
        // TODO: Implement checkDir() method.
    }

    /**
     * @inheritDoc
     */
    public function mkDir(string $dir): bool
    {
        // TODO: Implement mkDir() method.
    }

    /**
     * @inheritDoc
     */
    public function put(string $file, string $content): bool
    {
        // TODO: Implement put() method.
    }
}