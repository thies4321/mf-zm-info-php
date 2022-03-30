<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\StructRepository;

use MfZmInfo\Exception\ResourceNotFoundException;
use MfZmInfo\Repository\EnumRepository\EnumRepository;
use MfZmInfo\Repository\EnumRepositoryInterface;
use MfZmInfo\Repository\StructRepositoryInterface;
use function file_exists;
use function file_get_contents;
use function json_decode;

abstract class AbstractStructRepository implements StructRepositoryInterface
{
    protected EnumRepositoryInterface $enumRepository;

    protected array $collection;

    /**
     * @throws ResourceNotFoundException
     */
    public function __construct(EnumRepositoryInterface $enumRepository = null)
    {
        $this->enumRepository = $enumRepository ?? new EnumRepository();

        $path = __DIR__ . '/../../../resources/mf/structs.json';

        if (! file_exists($path)) {
            throw ResourceNotFoundException::forStructs($path);
        }

        $this->collection = json_decode(file_get_contents($path), true);
    }
}