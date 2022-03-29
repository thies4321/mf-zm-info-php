<?php

declare(strict_types=1);

namespace MfZmInfo\Model;

use MfZmInfo\Exception\InvalidRegionException;

use function in_array;

abstract class AbstractRam implements RamInterface, RegionInterface
{
    protected string $description;

    protected string $label;

    protected string $address;

    protected ?string $size;

    protected ?string $type;

    protected ?string $count;

    protected ?string $enum;

    protected string $region;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getCount(): ?string
    {
        return $this->count;
    }

    public function getEnum(): ?string
    {
        return $this->enum;
    }

    public function getRegion(): string
    {
        return $this->region;
    }
}