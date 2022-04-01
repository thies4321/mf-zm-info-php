<?php

declare(strict_types=1);

namespace MfZmInfo\Exception;

use function sprintf;

final class InvalidVariableTypeException extends \InvalidArgumentException
{
    public static function forDescription(string $expected, string $received): self
    {
        return new self(sprintf('Variable [description] should be a [%s] received [%s]', $expected, $received));
    }

    public static function forType(string $expected, string $received): self
    {
        return new self(sprintf('Variable [type] should be a [%s] received [%s]', $expected, $received));
    }

    public static function forOffset(string $expected, string $received): self
    {
        return new self(sprintf('Variable [offset] should be a [%s] received [%s]', $expected, $received));
    }

    public static function forEnum(string $expected, string $received): self
    {
        return new self(sprintf('Variable [Enum] should be a [%s] received [%s]', $expected, $received));
    }
}