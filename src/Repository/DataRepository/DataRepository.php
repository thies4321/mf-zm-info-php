<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\DataRepository;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\Data\Data;
use MfZmInfo\Model\DataInterface;
use MfZmInfo\Model\RegionInterface;
use MfZmInfo\Repository\DataRepositoryInterface;
use function is_array;
use function key_exists;

final class DataRepository extends AbstractDataRepository implements DataRepositoryInterface
{
    private const ADDRESS_MAPPING = [
        RegionInterface::REGION_USA => 'U',
        RegionInterface::REGION_EUR => 'E',
        RegionInterface::REGION_JAP => 'J',
    ];

    /**
     * @throws InvalidRegionException
     */
    public function getByLabel(string $label, string $region = RegionInterface::REGION_USA): ?DataInterface
    {
        foreach ($this->collection as $data) {
            if ($data['label'] !== $label) {
                continue;
            }

            if (! key_exists(self::ADDRESS_MAPPING[$region], $data['addr'])) {
                continue;
            }

            $count = $data['count'] ?? null;

            if (is_array($count)) {
                if (! key_exists(self::ADDRESS_MAPPING[$region], $count)) {
                    continue;
                }

                $count = $count[self::ADDRESS_MAPPING[$region]];
            }

            $size = $data['size'] ?? null;

            if (is_array($size)) {
                if (! key_exists(self::ADDRESS_MAPPING[$region], $size)) {
                    continue;
                }

                $size = $size[self::ADDRESS_MAPPING[$region]];
            }

            return Data::fromArray([
                'description' => $data['desc'],
                'label' => $data['label'],
                'type' => $data['type'] ?? null,
                'address' => $data['addr'][self::ADDRESS_MAPPING[$region]],
                'count' => $count,
                'size' => $size,
                'region' => $region,
            ]);
        }

        return null;
    }

    /**
     * @return DataInterface[]
     *
     * @throws InvalidRegionException
     */
    public function findAll(string $region = RegionInterface::REGION_USA): array
    {
        $result = [];

        foreach ($this->collection as $data) {
            if (! key_exists(self::ADDRESS_MAPPING[$region], $data['addr'])) {
                continue;
            }

            $count = $data['count'] ?? null;

            if (is_array($count)) {
                if (! key_exists(self::ADDRESS_MAPPING[$region], $count)) {
                    continue;
                }

                $count = $count[self::ADDRESS_MAPPING[$region]];
            }

            $size = $data['size'] ?? null;

            if (is_array($size)) {
                if (! key_exists(self::ADDRESS_MAPPING[$region], $size)) {
                    continue;
                }

                $size = $size[self::ADDRESS_MAPPING[$region]];
            }

            $result[] = Data::fromArray([
                'description' => $data['desc'],
                'label' => $data['label'],
                'type' => $data['type'] ?? null,
                'address' => $data['addr'][self::ADDRESS_MAPPING[$region]],
                'count' => $count,
                'size' => $size,
                'region' => $region,
            ]);
        }

        return $result;
    }
}
