<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

abstract class AbstractStructRepository implements StructRepositoryInterface
{
    protected EnumRepositoryInterface $enumRepository;

    protected array $collection;

    public function __construct(EnumRepositoryInterface $enumRepository = null)
    {

    }
}