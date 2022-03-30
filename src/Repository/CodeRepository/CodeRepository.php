<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\CodeRepository;

use MfZmInfo\Model\Code\Code;
use MfZmInfo\Model\RegionInterface;
use MfZmInfo\Repository\CodeRepositoryInterface;
use function array_key_exists;
use function is_array;
use function key_exists;

final class CodeRepository extends AbstractCodeRepository implements CodeRepositoryInterface
{
    private const ADDRESS_MAPPING = [
        RegionInterface::REGION_USA => 'U',
        RegionInterface::REGION_EUR => 'E',
        RegionInterface::REGION_JAP => 'J',
    ];

    public function findAll($region = RegionInterface::REGION_USA): array
    {
        $result = [];

        foreach ($this->collection as $code) {
            $parameters = [];

            foreach ($code['params'] ?? [] as $params) {
                $parameters[] = [
                    'description' => $params['desc'],
                    'type' => $params['type'],
                ];
            }

            $return = [];

            if ($code['return'] !== null) {
                if (array_key_exists('desc', $code['return'])) {
                    $return['description'] = $code['return']['desc'];
                }

                if (array_key_exists('type', $code['return'])) {
                    $return['type'] = $code['return']['type'];
                }

                if (array_key_exists('enum', $code['return'])) {
                    $return['enum'] = $code['return']['enum'];
                }
            }

            $size = $code['size'] ?? null;

            if (is_array($size)) {
                if (! key_exists(self::ADDRESS_MAPPING[$region], $size)) {
                    continue;
                }

                $size = $size[self::ADDRESS_MAPPING[$region]];
            }

            $result[] = Code::fromArray([
                'description' => $code['desc'],
                'label' => $code['label'],
                'address' => $code['addr'][self::ADDRESS_MAPPING[$region]],
                'size' => $size,
                'mode' => $code['mode'],
                'parameters' => $parameters,
                'return' => $return,
                'notes' => $code['notes'] ?? null,
                'region' => $region,
            ]);
        }

        return $result;
    }
}