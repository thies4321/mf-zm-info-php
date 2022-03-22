<?php

declare(strict_types=1);

namespace MfZmInfo\Exception;

use function sprintf;

final class ResourceNotFoundException extends \Exception
{
    public static function forEnums(string $path): self
    {
        return new self(sprintf('Tried to fetch enums.json but was not found for path [%s]', $path));
    }
}