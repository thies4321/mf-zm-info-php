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
    public function getByLabel(string $label): ?DataInterface
    {
        foreach ($this->collection as $data) {
            if ($data['label'] !== $label) {
                continue;
            }

            if (! key_exists(self::ADDRESS_MAPPING[$this->game->getRegion()], $data['addr'])) {
                continue;
            }

            $count = $data['count'] ?? null;

            if (is_array($count)) {
                if (! key_exists(self::ADDRESS_MAPPING[$this->game->getRegion()], $count)) {
                    continue;
                }

                $count = $count[self::ADDRESS_MAPPING[$this->game->getRegion()]];
            }

            $size = $data['size'] ?? null;

            if (is_array($size)) {
                if (! key_exists(self::ADDRESS_MAPPING[$this->game->getRegion()], $size)) {
                    continue;
                }

                $size = $size[self::ADDRESS_MAPPING[$this->game->getRegion()]];
            }

            return Data::fromArray([
                'description' => $data['desc'],
                'label' => $data['label'],
                'type' => $data['type'] ?? null,
                'address' => $data['addr'][self::ADDRESS_MAPPING[$this->game->getRegion()]],
                'count' => $count,
                'size' => $size,
                'region' => $this->game->getRegion(),
            ]);
        }

        return null;
    }

    /**
     * @return DataInterface[]
     *
     * @throws InvalidRegionException
     */
    public function findAll(): array
    {
        $result = [];

        foreach ($this->collection as $data) {
            if (! key_exists(self::ADDRESS_MAPPING[$this->game->getRegion()], $data['addr'])) {
                continue;
            }

            $count = $data['count'] ?? null;

            if (is_array($count)) {
                if (! key_exists(self::ADDRESS_MAPPING[$this->game->getRegion()], $count)) {
                    continue;
                }

                $count = $count[self::ADDRESS_MAPPING[$this->game->getRegion()]];
            }

            $size = $data['size'] ?? null;

            if (is_array($size)) {
                if (! key_exists(self::ADDRESS_MAPPING[$this->game->getRegion()], $size)) {
                    continue;
                }

                $size = $size[self::ADDRESS_MAPPING[$this->game->getRegion()]];
            }

            $result[] = Data::fromArray([
                'description' => $data['desc'],
                'label' => $data['label'],
                'type' => $data['type'] ?? null,
                'address' => $data['addr'][self::ADDRESS_MAPPING[$this->game->getRegion()]],
                'count' => $count,
                'size' => $size,
                'region' => $this->game->getRegion(),
            ]);
        }

        return $result;
    }
}
