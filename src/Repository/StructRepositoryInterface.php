<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\StructInterface;

interface StructRepositoryInterface
{
    public function getByType(): ?StructInterface;

    /**
     * @return StructInterface[]
     */
    public function findAll(): array;
}