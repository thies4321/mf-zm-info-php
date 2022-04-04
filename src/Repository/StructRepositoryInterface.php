<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\StructInterface;

interface StructRepositoryInterface
{
    public function getByType(string $type): ?StructInterface;

    /**
     * @return StructInterface[]
     */
    public function findByType(string $type): array;

    /**
     * @return StructInterface[]
     */
    public function findAll(): array;
}
