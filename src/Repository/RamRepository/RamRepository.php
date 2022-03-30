<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\RamRepository;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\Ram\Ram;
use MfZmInfo\Model\RamInterface;
use MfZmInfo\Model\RegionInterface;
use MfZmInfo\Repository\RamRepositoryInterface;

final class RamRepository extends AbstractRamRepository implements RamRepositoryInterface
{
    private const ADDRESS_MAPPING = [
        RegionInterface::REGION_USA => 'U',
        RegionInterface::REGION_EUR => 'E',
        RegionInterface::REGION_JAP => 'J',
    ];

    /**
     * @return RamInterface[]
     *
     * @throws InvalidRegionException
     */
    public function findAll($region = RegionInterface::REGION_USA): array
    {
        $result = [];

        foreach ($this->collection as $ram) {
            $address = $ram['addr'][self::ADDRESS_MAPPING[$region]] ?? null;

            if ($address === null) {
                continue;
            }

            $result[] = Ram::fromArray([
                'description' => $ram['desc'],
                'label' => $ram['label'],
                'size' => $ram['size'] ?? null,
                'type' => $ram['type'] ?? null,
                'address' => $address,
                'count' => $ram['count'] ?? null,
                'enum' => $ram['enum'] ?? null,
                'region' => $region,
            ]);
        }

        return $result;
    }
}
