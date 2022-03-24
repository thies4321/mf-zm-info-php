<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

abstract class AbstractStruct implements StructInterface
{
    protected string $type;

    protected string $size;

    protected string $description;

    protected string $structType;

    protected string $offset;

    /**
     * @var EnumInterface[]
     */
    protected array $enums;

    public function getType(): string
    {
        return $this->type;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStructType(): string
    {
        return $this->structType;
    }

    public function offset(): string
    {
        return $this->offset;
    }

    /**
     * @return EnumInterface[]
     */
    public function getEnums(): array
    {
        return $this->enums;
    }
}