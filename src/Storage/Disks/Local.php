<?php

namespace CloudCastle\Storage\Disks;

use CloudCastle\Storage\Common\AbstractDisk;
use CloudCastle\Storage\StorageInterface;

/**
 *
 */
final class Local extends AbstractDisk implements StorageInterface
{
    /**
     * @param string $file
     * @return string
     */
    public function path(string $file): string
    {
        return realpath($file);
    }

    /**
     * @param string $file
     * @param string $content
     * @return bool
     */
    public function put(string $file, string $content): bool
    {
        if ($this->mkDir(dirname($file))) {
            return file_put_contents($file, $content);
        }

        return false;
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function mkDir(string $dir): bool
    {
        if ($this->checkDir($dir) || mkdir($dir, 0777, true)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function checkDir(string $dir): bool
    {
        return is_dir($dir);
    }
}