<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\DataInterface;

interface DataRepositoryInterface
{
    public function getByLabel(string $label): ?DataInterface;

    /**
     * @return DataInterface[]
     */
    public function findAll(): array;
}
