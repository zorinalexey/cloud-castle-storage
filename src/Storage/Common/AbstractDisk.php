<?php

namespace CloudCastle\Storage\Common;

use CloudCastle\Storage\Storage;
use CloudCastle\Storage\StorageInterface;

/**
 * @method static getInstance
 */
abstract class AbstractDisk
{
    protected static array $instance = [];

    public static function init(array|null $config = null): StorageInterface
    {
        if ($config === null) {
            $config = [];
        }

        $instanceMd5 = Storage::getMd5Name(static::class, $config);

        if (isset(self::$instance[$instanceMd5]) && self::$instance[$instanceMd5] instanceof StorageInterface) {
            return self::$instance[$instanceMd5];
        }

        self::$instance[$instanceMd5] = static::getInstance(...$config);

        return self::$instance[$instanceMd5];
    }

}
