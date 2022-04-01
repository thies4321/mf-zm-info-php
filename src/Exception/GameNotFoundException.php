<?php

declare(strict_types=1);

namespace MfZmInfo\Exception;

final class GameNotFoundException extends \Exception
{
    public static function forCommand(): self
    {
        return new self('Game object was not provided for command');
    }
}