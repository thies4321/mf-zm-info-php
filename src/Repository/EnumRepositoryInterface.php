<?php

namespace MfZmInfo\Repository;

use MfZmInfo\Model\EnumInterface;

interface EnumRepositoryInterface
{
    /**
     * @return EnumInterface[]
     */
    public function findByName(string $name): array;

    /**
     * @return EnumInterface[]
     */
    public function findAll(): array;
}