<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

final class Enum extends AbstractEnum implements EnumInterface
{
    public function __construct(string $type, string $description, string $value)
    {
        $this->type = $type;
        $this->description = $description;
        $this->value = $value;
    }

    public static function fromArray(array $enum): self
    {
        return new self(
            $enum['type'],
            $enum['description'],
            $enum['value']
        );
    }
}