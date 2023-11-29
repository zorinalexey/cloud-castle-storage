<?php

namespace CloudCastle\Storage\Disks;

use CloudCastle\Storage\Common\AbstractDisk;
use CloudCastle\Storage\Connections\Ftp\Connect;
use CloudCastle\Storage\Storage;
use CloudCastle\Storage\StorageInterface;

final class Ftp extends AbstractDisk implements StorageInterface
{
    private static array $instance = [];

    private Connect|null $connect = null;

    public static function getInstance(
        string $hostname,
        string|null $username = null,
        string|null $password = null,
        int $port = 21,
        int $timeout = 90
    ): self
    {
        $initName = Storage::getMd5Name(Ftp::class, func_get_args());

        if(isset(self::$instance[$initName]) && self::$instance[$initName]->connect){
            return self::$instance[$initName];
        }

        self::$instance[$initName] = new self();
        self::$instance[$initName]->connect = Connect::getInstance($hostname, $username, $password, $port, $timeout);

        return self::$instance[$initName];
    }

    public function path(string $file): string
    {
        return '';
    }

    public function isDir(string $dir): bool
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

    public function isFile(string $path): bool
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