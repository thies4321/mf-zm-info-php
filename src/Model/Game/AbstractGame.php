<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Game;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\GameInterface;
use MfZmInfo\Model\RegionInterface;

use function in_array;

abstract class AbstractGame implements GameInterface
{
    protected string $name;

    protected string $shortName;

    protected string $sha1;

    protected string $md5;

    protected string $crc;

    protected string $region;

    public function __construct(
        string $name,
        string $shortName,
        string $sha1,
        string $md5,
        string $crc,
        string $region
    ) {
        $this->name = $name;
        $this->shortName = $shortName;
        $this->sha1 = $sha1;
        $this->md5 = $md5;
        $this->crc = $crc;

        if (! in_array($region, self::REGIONS)) {
            throw InvalidRegionException::forRegion($region);
        }

        $this->region = $region;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function getSha1(): string
    {
        return $this->sha1;
    }

    public function getMd5(): string
    {
        return $this->md5;
    }

    public function getCrc(): string
    {
        return $this->crc;
    }

    public function getRegion(): string
    {
        return $this->region;
    }
}
