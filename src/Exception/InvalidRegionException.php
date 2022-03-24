<?php

declare(strict_types=1);

namespace MfZmInfo\Exception;

use function sprintf;

final class InvalidRegionException extends \Exception
{
    public static function forRegion(string $region): self
    {
        return new self(sprintf('[%s] is not a valid region', $region));
    }
}