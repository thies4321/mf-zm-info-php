<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\RamRepository;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\Ram\Ram;
use MfZmInfo\Model\RamInterface;
use MfZmInfo\Model\RegionInterface;
use MfZmInfo\Repository\RamRepositoryInterface;
use function array_key_exists;
use function is_array;

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
    public function findAll(): array
    {
        $result = [];

        foreach ($this->collection as $ram) {
            $address = null;

            if (is_array($ram['addr'])) {
                $address = $ram['addr'][self::ADDRESS_MAPPING[$this->game->getRegion()]] ?? null;

                if ($address === null) {
                    continue;
                }
            }

            if ($address === null) {
                $address = $ram['addr'];
            }

            $result[] = Ram::fromArray([
                'description' => $ram['desc'],
                'label' => $ram['label'],
                'size' => $ram['size'] ?? null,
                'type' => $ram['type'] ?? null,
                'address' => $address,
                'count' => $ram['count'] ?? null,
                'enum' => $ram['enum'] ?? null,
                'region' => $this->game->getRegion(),
            ]);
        }

        return $result;
    }
}
