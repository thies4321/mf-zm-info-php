<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Exception\InvalidObjectException;
use MfZmInfo\Model\Struct;
use MfZmInfo\Model\StructInterface;

final class StructRepository extends AbstractStructRepository implements StructRepositoryInterface
{
    /**
     * @return StructInterface[]
     *
     * @throws InvalidObjectException
     */
    public function findByType(string $type): array
    {
        $result = [];

        foreach ($this->collection as $structType => $structs) {
            if ($structType !== $type) {
                continue;
            }

            foreach ($structs['vars'] as $var) {
                if (isset($var['enum'])) {
                    $enums = $this->enumRepository->findByType($var['enum']);
                }

                $result[] = Struct::fromArray([
                    'type' => $structType,
                    'size' => $structs['size'],
                    'description' => $var['desc'],
                    'structType' => $var['type'] ?? '',
                    'offset' => $var['offset'],
                    'enums' => $enums ?? [],
                ]);
            }
        }

        return $result;
    }

    /**
     * @return StructInterface[]
     *
     * @throws InvalidObjectException
     */
    public function findAll(): array
    {
        $result = [];

        foreach ($this->collection as $structType => $structs) {
            foreach ($structs['vars'] as $var) {
                if (isset($var['enum'])) {
                    $enums = $this->enumRepository->findByType($var['enum']);
                }

                $result[] = Struct::fromArray([
                    'type' => $structType,
                    'size' => $structs['size'],
                    'description' => $var['desc'],
                    'structType' => $var['type'] ?? '',
                    'offset' => $var['offset'],
                    'enums' => $enums ?? [],
                ]);
            }
        }

        return $result;
    }
}