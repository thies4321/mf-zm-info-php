<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\EnumRepository;

use MfZmInfo\Model\Enum\Enum;
use MfZmInfo\Model\EnumInterface;
use MfZmInfo\Repository\EnumRepositoryInterface;

final class EnumRepository extends AbstractEnumRepository implements EnumRepositoryInterface
{
    /**
     * @return EnumInterface[]
     */
    public function findByType(string $type): array
    {
        $result = [];

        foreach ($this->collection as $enumType => $enums) {
            if ($type !== $enumType) {
                continue;
            }

            foreach ($enums as $enum) {
                $result[] = Enum::fromArray([
                    'type' => $enumType,
                    'description' => $enum['desc'],
                    'value' => $enum['val']
                ]);
            }
        }

        return $result;
    }

    /**
     * @return EnumInterface[]
     */
    public function findAll(): array
    {
        $result = [];

        foreach ($this->collection as $enumType => $enums) {
            foreach ($enums as $enum) {
                $result[] = Enum::fromArray([
                    'type' => $enumType,
                    'description' => $enum['desc'],
                    'value' => $enum['val']
                ]);
            }
        }

        return $result;
    }
}
