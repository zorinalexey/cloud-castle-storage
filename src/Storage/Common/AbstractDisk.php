<?php

namespace CloudCastle\Storage\Common;

use CloudCastle\Storage\Storage;
use CloudCastle\Storage\StorageInterface;

abstract class AbstractDisk
{
    /**
     * @var array|null
     */
    private static array|null $instance = null;

    /**
     * @param array|null $config
     * @return StorageInterface
     */
    public static function init(array|null $config = null): StorageInterface
    {
        if($config === null){
            $config = [];
        }

        $instanceMd5 = Storage::getMd5Name(static::class, $config);

        if (isset(self::$instance[$instanceMd5]) && self::$instance[$instanceMd5]) {
            return self::$instance[$instanceMd5];
        }

        self::$instance[$instanceMd5] = new static(...$config);

        return self::$instance[$instanceMd5];
    }
}