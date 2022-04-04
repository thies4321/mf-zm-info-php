<?php

declare(strict_types=1);

namespace MfZmInfo\Exception;

use MfZmInfo\Model\EnumInterface;

use function sprintf;

final class InvalidObjectException extends \Exception
{
    public static function forEnum(string $provided): self
    {
        return new self(sprintf('Expected [%s] but reveived [%s]', EnumInterface::class, $provided));
    }
}
