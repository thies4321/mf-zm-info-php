<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\EnumInterface;

interface EnumRepositoryInterface
{
    /**
     * @return EnumInterface[]
     */
    public function findByType(string $type): array;

    /**
     * @return EnumInterface[]
     */
    public function findAll(): array;
}
