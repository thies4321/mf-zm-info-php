<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\CodeInterface;

interface CodeRepositoryInterface
{
    /**
     * @return CodeInterface[]
     */
    public function findAll(): array;
}