<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\CodeInterface;
use MfZmInfo\Model\RegionInterface;

interface CodeRepositoryInterface
{
    /**
     * @return CodeInterface[]
     */
    public function findAll(string $region = RegionInterface::REGION_USA): array;
}