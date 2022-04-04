<?php

declare(strict_types=1);

namespace MfZmInfo\Service;

final class PrimitiveTypesService
{
    public const U8 = 'u8';
    public const S8 = 's8';
    public const FLAGS8 = 'flags8';
    public const BOOL = 'bool';
    public const U16 = 'u16';
    public const S16 = 's16';
    public const FLAGS16 = 'flags16';
    public const U32 = 'u32';
    public const S32 = 's32';
    public const PTR = 'ptr';
    public const ASCII = 'ascii';
    public const CHAR = 'char';
    public const LZ = 'lz';
    public const GFX = 'gfx';
    public const TILEMAP = 'tilemap';
    public const PALETTE = 'palette';
    public const THUMB = 'thumb';
    public const ARM = 'arm';

    public static function getSize(string $primitiveType): ?int
    {
        return match ($primitiveType) {
            self::U8, self::S8, self::FLAGS8, self::BOOL => 1,
            self::U16, self::S16, self::FLAGS16, self::CHAR => 2,
            self::U32, self::S32, self::PTR => 4,
            self::PALETTE => 32,
            default => null,
        };
    }
}
