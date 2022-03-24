<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

use MfZmInfo\Exception\InvalidObjectException;

final class Struct extends AbstractStruct implements StructInterface
{
    /**
     * @param EnumInterface[] $enums
     */
    public function __construct(
        string $type,
        string $size,
        string $description,
        string $structType,
        string $offset,
        array $enums
    ) {
        $this->type = $type;
        $this->size = $size;
        $this->description = $description;
        $this->structType = $structType;
        $this->offset = $offset;
        $this->enums = $enums;
    }

    /**
     * @throws InvalidObjectException
     */
    public static function fromArray(array $struct): self
    {
        foreach ($struct['enums'] as $enum) {
            if (! $enum instanceof EnumInterface) {
                throw InvalidObjectException::forEnum((string) $enum);
            }
        }

        return new self(
            $struct['type'],
            $struct['size'],
            $struct['description'],
            $struct['structType'],
            $struct['offset'],
            $struct['enums'],
        );
    }
}