<?php

declare(strict_types=1);

namespace MfZmInfo\Repository\StructRepository;

use MfZmInfo\Exception\MissingVariableException;
use MfZmInfo\Model\Struct\Struct;
use MfZmInfo\Model\StructInterface;
use MfZmInfo\Repository\StructRepositoryInterface;

use function array_key_exists;
use function print_r;

final class StructRepository extends AbstractStructRepository implements StructRepositoryInterface
{
    /**
     * @throws MissingVariableException
     */
    public function getByType(string $type): ?StructInterface
    {
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

            return Struct::fromArray([
                'type' => $structType,
                'size' => $structs['size'],
                'variables' => $variables,
            ]);
        }

        return null;
    }

    /**
     * @return StructInterface[]
     *
     * @throws MissingVariableException
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