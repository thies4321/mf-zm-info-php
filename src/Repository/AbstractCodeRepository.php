<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Exception\ResourceNotFoundException;

use function file_exists;
use function file_get_contents;
use function json_decode;

abstract class AbstractCodeRepository implements CodeRepositoryInterface
{
    protected array $collection;

    public function __construct()
    {
        $path = __DIR__ . '/../../resources/mf/code.json';

        if (! file_exists($path)) {
            throw ResourceNotFoundException::forData($path);
        }

        $this->collection = json_decode(file_get_contents($path), true);
    }
}