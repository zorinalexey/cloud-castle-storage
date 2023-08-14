<?php

namespace CloudCastle\Storage\Disks;

use CloudCastle\Storage\Common\AbstractDisk;
use CloudCastle\Storage\Connections\Ftp\Connect;
use CloudCastle\Storage\Exceptions\FtpException;
use CloudCastle\Storage\Storage;
use CloudCastle\Storage\StorageInterface;

final class Ftp extends AbstractDisk implements StorageInterface
{
    /**
     * @var array
     */
    private static array $instance = [];

    /**
     * @var Connect|null
     */
    private Connect|null $connect = null;

    /**
     * @param string $hostname
     * @param string|null $username
     * @param string|null $password
     * @param int $port
     * @param int $timeout
     * @return self
     * @throws FtpException
     */
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
    
    /**
     * @param string $file
     * @return string
     */
    public function path(string $file): string
    {

        return '';
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function checkDir(string $dir): bool
    {
        return false;
    }

    /**
     * @param string $dir
     * @return bool
     */
    public function mkDir(string $dir): bool
    {
        return false;
    }

    /**
     * @param string $file
     * @param string $content
     * @return bool
     */
    public function put(string $file, string $content): bool
    {
        return false;
    }
}