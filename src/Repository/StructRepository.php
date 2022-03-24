<?php

declare(strict_types=1);

namespace MfZmInfo\Repository;

use MfZmInfo\Exception\InvalidObjectException;
use MfZmInfo\Model\Struct;
use MfZmInfo\Model\StructInterface;
use function array_key_exists;

final class StructRepository extends AbstractStructRepository implements StructRepositoryInterface
{
    /**
     * @return StructInterface[]
     */
    public function findByType(string $type): array
    {
        $result = [];

        foreach ($this->collection as $structType => $structs) {
            if ($structType !== $type) {
                continue;
            }

            $variables = [];

            foreach ($structs['vars'] as $var) {
                $varStruct = [
                    'description' => $var['desc'],
                    'type' => $var['type'],
                    'offset' => $var['offset'],
                ];

                if (array_key_exists('enum', $var)) {
                    $varStruct['enum'] = $var['enum'];
                }

                $variables[] = $varStruct;
            }

            $result[] = Struct::fromArray([
                'type' => $structType,
                'size' => $structs['size'],
                'variables' => $variables,
            ]);
        }

        return $result;
    }

    /**
     * @return StructInterface[]
     */
    public function findAll(): array
    {
        $result = [];

        foreach ($this->collection as $structType => $structs) {
            $variables = [];

            foreach ($structs['vars'] as $var) {
                $varStruct = [
                    'description' => $var['desc'],
                    'offset' => $var['offset'],
                ];

                if (array_key_exists('type', $var)) {
                    $varStruct['type'] = $var['type'];
                }

                if (array_key_exists('enum', $var)) {
                    $varStruct['enum'] = $var['enum'];
                }

                $variables[] = $varStruct;
            }

            $result[] = Struct::fromArray([
                'type' => $structType,
                'size' => $structs['size'],
                'variables' => $variables,
            ]);
        }

        return $result;
    }
}