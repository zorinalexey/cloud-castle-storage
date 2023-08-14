<?php

namespace CloudCastle\Storage;

interface StorageInterface
{
    /**
     * @param array|null $config
     * @return self
     */
    public static function init(array|null $config = null): self;

    /**
     * @param string $file
     * @return string
     */
    public function path(string $file): string;

    /**
     * @param string $dir
     * @return bool
     */
    public function checkDir(string $dir): bool;

    /**
     * @param string $dir
     * @return bool
     */
    public function mkDir(string $dir): bool;

    /**
     * @param string $file
     * @param string $content
     * @return bool
     */
    public function put(string $file, string $content): bool;
}