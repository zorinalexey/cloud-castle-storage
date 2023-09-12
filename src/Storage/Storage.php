<?php

namespace CloudCastle\Storage;

use CloudCastle\Storage\Disks\Local;

/**
 *
 */
final class Storage
{
    private static array|null $storage = null;

    public static function disk(EDisks|null $disk = null, array|null $config = null): StorageInterface
    {
        if ($disk === null) {
            $disk = EDisks::LOCAL;
        }

        $diskMd5 = self::getMd5Name($disk->value, $config);

        if (isset(self::$storage[$diskMd5]) && self::$storage[$diskMd5] instanceof StorageInterface) {
            return self::$storage[$diskMd5];
        }

        self::$storage[$diskMd5] = $disk->value::init($config);

        return self::$storage[$diskMd5];
    }

    public static function getMd5Name(string $diskName, array|null $config): string
    {
        if ($diskName === Local::class) {
            $config = null;
        }

        return md5($diskName . print_r($config, true));
    }
}
