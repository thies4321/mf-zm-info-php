<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\RamInterface;
use MfZmInfo\Model\RegionInterface;

interface RamRepositoryInterface
{
    /**
     * @return RamInterface[]
     */
    public function findAll(string $region = RegionInterface::REGION_USA): array;
}