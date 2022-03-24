<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\DataInterface;
use MfZmInfo\Model\RegionInterface;

interface DataRepositoryInterface
{
    public function getByLabel(string $label, string $region = RegionInterface::REGION_USA): ?DataInterface;

    /**
     * @return DataInterface[]
     */
    public function findAll(string $region = RegionInterface::REGION_USA): array;
}