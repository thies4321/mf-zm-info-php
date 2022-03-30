<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\RamRepository;

use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Repository\RamRepositoryInterface;
use function file_exists;
use function file_get_contents;
use function json_decode;

abstract class AbstractRamRepository implements RamRepositoryInterface
{
    protected array $collection;

    /**
     * @throws ResourceNotFoundException
     */
    public function __construct()
    {
        $path = __DIR__ . '/../../../resources/mf/ram.json';

        if (! file_exists($path)) {
            throw ResourceNotFoundException::forData($path);
        }

        $this->collection = json_decode(file_get_contents($path), true);
    }
}