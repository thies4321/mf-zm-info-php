<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\StructInterface;

final class StructRepository extends AbstractStructRepository implements StructRepositoryInterface
{
    public function getByType(): ?StructInterface
    {

    }

    /**
     * @return StructInterface[]
     */
    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }
}