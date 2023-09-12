<?php

namespace CloudCastle\Storage;

interface StorageInterface
{
    public static function init(array|null $config = null): self;

    public function path(string $file): string;

    public function isDir(string $dir): bool;

    public function mkDir(string $dir): bool;

    public function put(string $file, string $content): bool;

    public function isFile(string $path): bool;

    public function get(string $path): array|string|false;

    public function rm(string $path):bool;
}
