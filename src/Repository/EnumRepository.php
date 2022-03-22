<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Model\Enum;
use MfZmInfo\Model\EnumInterface;

final class EnumRepository extends AbstractEnumRepository implements EnumRepositoryInterface
{
    /**
     * @return EnumInterface[]
     */
    public function findByName(string $name): array
    {
        $result = [];

        foreach ($this->collection as $enumName => $enums) {
            if ($name !== $enumName) {
                continue;
            }

            foreach ($enums as $enum) {
                $result[] = Enum::fromArray([
                    'type' => $enumName,
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

        foreach ($this->collection as $enumName => $enums) {
            foreach ($enums as $enum) {
                $result[] = Enum::fromArray([
                    'type' => $enumName,
                    'description' => $enum['desc'],
                    'value' => $enum['val']
                ]);
            }
        }

        return $result;
    }
}