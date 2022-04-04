<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Enum;

use MfZmInfo\Model\EnumInterface;

abstract class AbstractEnum implements EnumInterface
{
    protected string $type;

    protected string $description;

    protected string $value;

    public function getType(): string
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
