<?php

declare(strict_types=1);

namespace MfZmInfo\Model\Data;

use MfZmInfo\Exception\InvalidRegionException;
use MfZmInfo\Model\DataInterface;
use MfZmInfo\Model\RegionInterface;

use function in_array;

abstract class AbstractData implements DataInterface
{
    protected string $region;

    protected string $description;

    protected string $label;

    protected ?string $type;

    protected string $address;

    protected ?string $count;

    protected ?string $size;

    /**
     * @throws InvalidRegionException
     */
    public function __construct(string $region)
    {
        if (! in_array($region, self::REGIONS)) {
            throw InvalidRegionException::forRegion($region);
        }

        $this->region = $region;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCount(): ?string
    {
        return $this->count;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }
}
