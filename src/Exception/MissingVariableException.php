<?php

declare(strict_types=1);

namespace MfZmInfo\Exception;

final class MissingVariableException extends \Exception
{
    public static function forDescription(): self
    {
        return new self('Variable [description] is missing');
    }

    public static function forOffset(): self
    {
        return new self('Variable [offset] is missing');
    }

    public static function forType(): self
    {
        return new self('Variable [type] is missing');
    }
}
