<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

final class Struct extends AbstractStruct implements StructInterface
{
    /**
     * @param EnumInterface[] $enums
     */
    public function __construct(
        string $type,
        string $description,
        string $structType,
        string $offset,
        array $enums
    ) {
        $this->type = $type;
        $this->description = $description;
        $this->structType = $structType;
        $this->offset = $offset;
        $this->enums = $enums;
    }

    public static function fromArray(array $struct): self
    {
        return new self(
            $struct['type'],
            $struct['description'],
            $struct['structType'],
            $struct['offset'],
            $struct['enums'],
        );
    }
}