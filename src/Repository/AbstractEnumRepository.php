<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Exception\ResourceNotFoundException;

use function file_exists;
use function file_get_contents;
use function json_decode;

abstract class AbstractEnumRepository implements EnumRepositoryInterface
{
    protected array $collection;

    /**
     * @throws ResourceNotFoundException
     */
    public function __construct()
    {
        $path = __DIR__ . '/../../resources/mf/enums.json';

        if (! file_exists($path)) {
            throw ResourceNotFoundException::forEnums($path);
        }

        $this->collection = json_decode(file_get_contents($path), true);
    }
}