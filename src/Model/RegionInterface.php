<?php

namespace MfZmInfo\Model;

interface RegionInterface
{
    public const REGION_USA = 'USA';
    public const REGION_EUR = 'EUR';
    public const REGION_JAP = 'JAP';

    public const REGIONS = [
        self::REGION_USA,
        self::REGION_EUR,
        self::REGION_JAP,
    ];

    public function getRegion(): string;
}